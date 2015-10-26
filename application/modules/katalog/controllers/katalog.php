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
		$data['katalog'] = $this->km->get_katalog($search, $sort, '','',FALSE);
		$data['pagination'] = $this->utility->generate_page('blacklist',$sort, $per_page, $this->km->get_katalog($search, $sort, '','',FALSE));
		$data['sort'] 		= $sort;

		$layout['content']	= $this->load->view('content',$data,TRUE);

		$item['header'] 	= $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] 	= $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function view($id){
		$search 	= $this->input->get('q');
		$page 		= '';
		$data = $this->km->get_data_barang($id);
		// print_r($data);
		$per_page=10;
		$data['id'] = $id;
		
		$sort = $this->utility->generateSort(array('price','date', 'vendor_name'));
		$data['sort'] 		= $sort;
		$data['chart'] = $this->get_chart_data($id);

		// print_r($data['chart']);
		$data['list_harga']	= $this->km->get_harga($id);
		$data['pagination'] = $this->utility->generate_page('katalog/view/'.$id,$sort, $per_page, $this->km->get_harga($search, $sort, '', '',TRUE));
		$layout['content']= $this->load->view('view',$data,TRUE);
		$layout['script']= $this->load->view('content_js',$data,TRUE);

		$item['header'] = $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function get_chart_data($id){
		$result = $this->km->data_chart($id);
		// echo print_r($result);
		return $result;
	}
	public function search(){
		$result = $this->km->search_katalog();
		echo json_encode($result);
	}
	public function tambah(){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		// echo [ri]
		
		$vld 	= array(
			
			array(
				'field'=>'nama',
				'label'=>'Nama Barang',
				'rules'=>'required'
				),
			array(
				'field'=>'remark',
				'label'=>'Remark',
				'rules'=>''
				),
			array(
				'field'=>'gambar_barang',
				'label'=>'Lampiran Foto',
				'rules'=>'callback_do_upload[gambar_barang]'
				),
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			$_POST['id_vendor'] = NULL;

			$result = $this->km->save_barang($this->input->post());
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah barang!</p>');
			redirect(site_url('katalog'));
		}

		$layout['content']= $this->load->view('tambah',NULL,TRUE);


		$item['header'] = $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function edit_barang($id){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		$data = $this->km->get_data_barang($id);

		$vld 	= array(
			
			array(
				'field'=>'nama',
				'label'=>'Nama Barang',
				'rules'=>'required'
				),
			array(
				'field'=>'remark',
				'label'=>'Remark',
				'rules'=>''
				),
			);
		if(isset($_FILES['gambar_barang'])){
		$vld[] = array(
				'field'=>'gambar_barang',
				'label'=>'Lampiran Foto',
				'rules'=>'callback_do_upload[gambar_barang]'
				);
		}
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			unset($_POST['Simpan']);
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			

			$result = $this->km->edit_barang($this->input->post(),$id);
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah barang!</p>');
			redirect(site_url('katalog'));
		}

		$layout['content']= $this->load->view('tambah',$data,TRUE);


		$item['header'] = $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function hapus_barang($id){
		if($this->km->delete_barang($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('katalog'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('katalog'));
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

	public function tambah_harga($id){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		
		$vld 	= array(
			
			array(
				'field'=>'date',
				'label'=>'Tanggal',
				'rules'=>'required'
				),
			array(
				'field'=>'price',
				'label'=>'Harga',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['id_material'] = $id;
			$_POST['price'] = preg_replace("/[,]/", "", $this->input->post('price'));;
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");

			$result = $this->km->save_harga_barang($id, $this->input->post());
			if($result){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah harga barang!</p>');
				
				redirect(site_url('katalog/view/'.$id));
			}
		}

		$data['title'] = "Tambah Harga Barang";
		$layout['content']= $this->load->view('tambah_harga',$data,TRUE);


		$item['header'] = $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function edit_harga($id_material,$id){
		$_POST 	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		$data 	= $this->km->get_harga_barang($id);
		$vld 	= array(
			
			array(
				'field'=>'date',
				'label'=>'Tanggal',
				'rules'=>'required'
				),
			array(
				'field'=>'price',
				'label'=>'Harga',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['price'] = preg_replace("/[,]/", "", $this->input->post('price'));;
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Simpan']);
			$result = $this->km->edit_harga_barang($this->input->post(),$id);
			if($result){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah harga barang!</p>');
				
				redirect(site_url('katalog/view/'.$id_material));
			}
		}

		$data['title'] = "Ubah Harga Barang";
		$layout['content']= $this->load->view('tambah_harga',$data,TRUE);


		$item['header'] = $this->load->view('auction/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('auction/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function hapus_harga($id_material,$id){
		if($this->km->delete_harga($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('katalog/view/'.$id_material));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('katalog/view/'.$id_material));
		}
	}
	public function autocomplete(){
		$keyword	= $this->input->post('keyword');
        $data 		= $this->bm->get_autocomplete($keyword);        
        echo json_encode($data);
	}

	


	
	
}
