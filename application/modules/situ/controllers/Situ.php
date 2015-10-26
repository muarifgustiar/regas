<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Situ extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('user')){
			redirect(site_url());
		}
		$this->load->model('situ_model','sm');
		$this->load->library('encrypt');
		$this->load->library('utility');
		
	}

	public function index()
	{	
		$data = $this->session->userdata('user');
		if($this->vm->check_pic($data['id_user'])==0){
			redirect(site_url('dashboard/pernyataan'));
		}
		$search = $this->input->get('q');
		$page = '';
		
		$per_page=10;

		$sort = $this->utility->generateSort(array('type','issue_by', 'file_extension_situ', 'no', 'notaris', 'issue_date', 'file_photo', 'address','expire_date','situ_file'));

		$data['situ_list']=$this->sm->get_situ_list($search, $sort, $page, $per_page,TRUE);

		$data['pagination'] = $this->utility->generate_page('situ',$sort, $per_page, $this->sm->get_situ_list($search, $sort, '','',FALSE));
		$data['sort'] = $sort;

		$layout['content']= $this->load->view('content',$data,TRUE);

		$item['header'] = $this->load->view('dashboard/header',$this->session->userdata('user'),TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	
	public function tambah()
	{
		$_POST = $this->securities->clean_input($_POST,'save');
		$user = $this->session->userdata('user');
		$vld = 	array(
			array(
				'field'=>'type',
				'label'=>'Nama Surat',
				'rules'=>'required'
				),
			array(
				'field'=>'issue_by',
				'label'=>'Lembaga Penerbit',
				'rules'=>'required'
				),
			array(
				'field'=>'no',
				'label'=>'Nomor',
				'rules'=>'required|integer'
				),
			array(
				'field'=>'issue_date',
				'label'=>'Tanggal',
				'rules'=>'required'
				),
			array(
				'field'=>'file_extension_situ',
				'label'=>'Bukti sedang dalam proses perpanjangan',
				'rules'=>'callback_do_upload[file_extension_situ]'
				),
			array(
				'field'=>'address',
				'label'=>'Alamat',
				'rules'=>'required'
				),
			
			array(
				'field'=>'expire_date',
				'label'=>'Masa Berlaku',
				'rules'=>'required'
				),
			array(
				'field'=>'situ_file',
				'label'=>'Bukti scan dokumen SKDP',
				'rules'=>'callback_do_upload[situ_file]'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['id_vendor'] 	= $user['id_user'];
			$_POST['entry_stamp'] 	= date("Y-m-d H:i:s");
			$_POST['edit_stamp'] 	= date("Y-m-d H:i:s");
			$_POST['data_status'] 	= 0;

			$res = $this->sm->save_data($this->input->post());
			if($res){
				$this->dpt->set_email_blast($res,'ms_situ',$_POST['type'],$_POST['expire_date']);
				$this->dpt->non_iu_change($user['id_user']);
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data!</p>');
				redirect(site_url('situ'));
			}
		}

		$layout['content']= $this->load->view('tambah',NULL,TRUE);

		$item['header'] = $this->load->view('dashboard/header',$user,TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function edit($id){
		$data = $this->sm->get_data($id);
		$_POST = $this->securities->clean_input($_POST,'save');
		$user = $this->session->userdata('user');
		$vld = 	array(
			array(
				'field'=>'type',
				'label'=>'Nama Surat',
				'rules'=>'required'
				),
			array(
				'field'=>'no',
				'label'=>'Nomor',
				'rules'=>'required|integer'
				),
			array(
				'field'=>'issue_date',
				'label'=>'Tanggal',
				'rules'=>'required'
				),
			array(
				'field'=>'address',
				'label'=>'Alamat',
				'rules'=>'required'
				),
			
			array(
				'field'=>'expire_date',
				'label'=>'Masa Berlaku',
				'rules'=>'required'
				)
			);

		if(!empty($_FILES['file_photo']['name'])){
			$vld[] = array(
					'field'=>'file_photo',
					'label'=>'Foto Lokasi',
					'rules'=>'callback_do_upload[file_photo]'
					);
		}

		if(!empty($_FILES['file']['name'])){
			$vld[] = array(
					'field'=>'file',
					'label'=>'Lampiran',
					'rules'=>'callback_do_upload[file]'
					);
		}

		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Update']);

			$res = $this->sm->edit_data($this->input->post(),$id);
			if($res){
				$this->dpt->non_iu_change($user['id_user']);
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');
				redirect(site_url('situ'));
			}
		}



		$layout['content']= $this->load->view('edit',$data,TRUE);

		$user = $this->session->userdata('user');
		$item['header'] = $this->load->view('dashboard/header',$user,TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function hapus($id){
		if($this->sm->delete($id)){
			$this->dpt->non_iu_change($user['id_user']);
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('situ'));
		}else{
			$this->session->set_flashdata('errorMsg','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('situ'));
		}
	}
	public function do_upload($field, $db_name = ''){	
		
		$file_name = $_FILES[$db_name]['name'] = $db_name.'_'.$this->utility->name_generator($_FILES[$db_name]['name']);
		
		$config['upload_path'] = './lampiran/'.$db_name.'/';
		$config['allowed_types'] = 'pdf|jpeg|jpg|png|gif';
		$config['max_size'] = '2096';
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload($db_name)){
			$_POST[$db_name] = $file_name;
			$this->form_validation->set_message('do_upload', $this->upload->display_errors('',''));
			return false;
		}else{
			$_POST[$db_name] = $file_name; 
			return true;
		}
	}
}
