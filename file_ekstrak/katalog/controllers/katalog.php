<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('katalog_model','km');
		// $this->load->library('encrypt');
		// $this->load->library('utility');
		
	}

	public function index($search='', $sort='', $page='', $per_page='',$is_page=FALSE,$filter=array()){
		$search 	= $this->input->get('q');
		$page 		= '';
		
		$per_page=10;

		$data['katalog']	= $this->km->get_katalog($search, $sort, $page, $per_page,TRUE);
		$data['pagination'] = $this->utility->generate_page('blacklist',$sort, $per_page, $this->km->get_katalog($search, $sort, '','',FALSE));
		$data['sort'] 		= $sort;

		$layout['content']	= $this->load->view('content',$data,TRUE);

		$item['header'] 	= $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] 	= $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function view($id){
		$data['id'] = $id;
		$layout['content']= $this->load->view('view',$data,TRUE);
		$layout['script']= $this->load->view('content_js',$data,TRUE);


		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function search(){
		$result = $this->km->search_katalog();
		echo json_encode($result);
	}
	public function tambah(){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		// echo [ri]
		$data = ($this->session->userdata('blacklist')) ? $this->session->userdata('blacklist') : array();
		$vld 	= array(
			
			array(
				'field'=>'id_vendor',
				'label'=>'Vendor',
				'rules'=>'required'
				),
			array(
				'field'=>'start_date',
				'label'=>'Tanggal Mulai',
				'rules'=>'required'
				),
			array(
				'field'=>'end_date',
				'label'=>'Tanggal Selesai',
				'rules'=>'required'
				),
			array(
				'field'=>'remark',
				'label'=>'Alasan (remark)',
				'rules'=>'required'
				),
			array(
				'field'=>'blacklist_file',
				'label'=>'Lampiran Pengesahan',
				'rules'=>'callback_do_upload[blacklist_file]'
				),
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			// $_POST['edit_stamp'] = date("Y-m-d H:i:s");
			$_POST['data_status'] = 0;

			$result = $this->bm->save_data($this->input->post());
			if($result){
				$this->dpt->non_iu_change($user['id_user']);
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mem-Blacklist vendor!</p>');
			if($admin['id_role']==3){
				redirect($this->session->userdata('blacklist')['site']);
			}
			$this->session->unset_userdata('blacklist');
			redirect(site_url('blacklist'));
		}

		$layout['content']= $this->load->view('tambah',$data,TRUE);


		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function tambah_harga(){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		// echo [ri]
		$data = ($this->session->userdata('blacklist')) ? $this->session->userdata('blacklist') : array();
		$vld 	= array(
			
			array(
				'field'=>'id_vendor',
				'label'=>'Vendor',
				'rules'=>'required'
				),
			array(
				'field'=>'start_date',
				'label'=>'Tanggal Mulai',
				'rules'=>'required'
				),
			array(
				'field'=>'end_date',
				'label'=>'Tanggal Selesai',
				'rules'=>'required'
				),
			array(
				'field'=>'remark',
				'label'=>'Alasan (remark)',
				'rules'=>'required'
				),
			array(
				'field'=>'blacklist_file',
				'label'=>'Lampiran Pengesahan',
				'rules'=>'callback_do_upload[blacklist_file]'
				),
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			// $_POST['edit_stamp'] = date("Y-m-d H:i:s");
			$_POST['data_status'] = 0;

			$result = $this->bm->save_data($this->input->post());
			if($result){
				$this->dpt->non_iu_change($user['id_user']);
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mem-Blacklist vendor!</p>');
			if($admin['id_role']==3){
				redirect($this->session->userdata('blacklist')['site']);
			}
			$this->session->unset_userdata('blacklist');
			redirect(site_url('blacklist'));
		}

		$layout['content']= $this->load->view('tambah_harga',$data,TRUE);


		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function autocomplete(){
		$keyword	= $this->input->post('keyword');
        $data 		= $this->bm->get_autocomplete($keyword);        
        echo json_encode($data);
	}

	public function edit($id){
		$data 	= $this->bm->get_data($id);

		$_POST 	= $this->securities->clean_input($_POST,'save');
		$user 	= $this->session->userdata('user');
		$vld 	= array(
			
			array(
				'field'=>'id_vendor',
				'label'=>'Vendor',
				'rules'=>'required'
				),
			array(
				'field'=>'start_date',
				'label'=>'Tanggal Mulai',
				'rules'=>'required'
				),
			array(
				'field'=>'end_date',
				'label'=>'Tanggal Selesai',
				'rules'=>'required'
				),
			array(
				'field'=>'remark',
				'label'=>'Alasan (remark)',
				'rules'=>'required'
				),
			);

		if(!empty($_FILES['blacklist_file']['name'])){
			$vld[] = array(
					'field'=>'blacklist_file',
					'label'=>'Lampiran blacklist',
					'rules'=>'callback_do_upload[blacklist_file]'
					);
		}

		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Update']);

			$result = $this->bm->edit_data($this->input->post(),$id);
			if($result){
				$this->dpt->non_iu_change($user['id_user']);
			}

			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');

			redirect(site_url('blacklist'));
		}

		

		$layout['content']= $this->load->view('edit',$data,TRUE);

		$item['header'] = $this->load->view('admin/header', $this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}


	public function hapus($id){
		if($this->bm->delete($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('blacklist'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('blacklist'));
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
