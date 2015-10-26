<?php defined('BASEPATH') OR exit('No direct script access allowed');

class admin_k3 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('k3/k3_model','km');
	}
	public function index(){	
		$search 	= $this->input->get('q');
		$page 		= '';
		$per_page	= 10;
		$sort 		= $this->utility->generateSort(array('id_bidang','name'));

		// $data = $this->pm->get_pengadaan($id);
		// $data_kontrak = $this->pm->get_kontrak($id);

		

		// $data['ms_quest']	= $this->km->get_data_ms_quest_k3_list($search, $sort, $page, $per_page,TRUE);

		$data['ms_quest']		= $this->km->get_master_header();
		$data['sub_quest']		= $this->km->get_sub_header();
		$data['quest']			= $this->km->get_quest();
		$data['field_quest'] 	= $this->km->get_field_quest();
		$data['pagination'] 	= $this->utility->generate_page('admin/admin_sub_bidang/',$sort, $per_page, $this->km->get_data_ms_quest_k3_list($search, $sort, '','',FALSE));
		$data['sort'] 			= $sort;
		$layout['content']	= $this->load->view('k3/content',$data,TRUE);

		$item['header'] 	= $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	###################################################
	################  		K3		 	###############
	###################################################



	public function edit_header($id){
		// $data 			= $this->km->get_data_assessment($id);
		$data	= $this->km->get_header($id);
		
		$_POST 			= $this->securities->clean_input($_POST,'save');
		$admin 			= $this->session->userdata('admin');
		$vld 			= array(
				array(
					'field'=>'question',
					'label'=>'Nama Header',
					'rules'=>'required'
					),
			);

		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Update']);

			$res = $this->km->save_edit_header($this->input->post(),$id);

			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}
		}

		$layout['content']	= $this->load->view('k3/edit_header',$data,TRUE);

		$admin 				= $this->session->userdata('admin');
		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function edit_sub_quest($id){
		// $data 			= $this->km->get_data_assessment($id);
		$data	= $this->km->get_sub_quest($id);
		
		$_POST 			= $this->securities->clean_input($_POST,'save');
		$admin 			= $this->session->userdata('admin');
		$vld 			= array(
				array(
					'field'=>'question',
					'label'=>'Nama Sub Quest',
					'rules'=>'required'
					),
			);

		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Update']);

			$res = $this->km->save_edit_sub_quest($this->input->post(),$id);

			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}
		}

		$layout['content']	= $this->load->view('k3/edit_sub_quest',$data,TRUE);

		$admin 				= $this->session->userdata('admin');
		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function edit_quest($id){
		// $data 			= $this->km->get_data_assessment($id);
		$data	= $this->km->get_quest_edit($id);
		
		$_POST 			= $this->securities->clean_input($_POST,'save');
		$admin 			= $this->session->userdata('admin');
		$vld 			= array(
				array(
					'field'=>'value',
					'label'=>'Nama Sub Quest',
					'rules'=>'required'
					),
			);

		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Update']);

			$res = $this->km->save_edit_quest($this->input->post(),$id);

			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}
		}

		$layout['content']	= $this->load->view('k3/edit_quest',$data,TRUE);

		$admin 				= $this->session->userdata('admin');
		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function hapus_header($id){
		if($this->km->hapus_header($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}
	}

	public function hapus_sub_quest($id){
		if($this->km->hapus_sub_quest($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}
	}
	public function hapus_quest($id){
		if($this->km->hapus_quest($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('admin/admin_k3'));
		}
	}


	public function tambah_header(){
		
		$_POST	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		$vld 	= array(
			array(
				'field'=>'question',
				'label'=>'Nama Header',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			unset($_POST['Simpan']);
			$_POST['entry_stamp'] 	= date("Y-m-d H:i:s");
			$res = $this->km->save_header($this->input->post());
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}
			
		}

		$layout['content']	= $this->load->view('k3/tambah_header',NULL,TRUE);

		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function tambah_sub_quest($key){
		
		$_POST	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		$vld 	= array(
			array(
				'field'=>'question',
				'label'=>'Nama Sub Quest',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			unset($_POST['Simpan']);
			$_POST['entry_stamp'] 	= date("Y-m-d H:i:s");
			$_POST['id_header']		= $key;
			$res = $this->km->save_sub_quest($this->input->post());
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}else{
				$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menambah data!</p>');
			}
			
		}

		$layout['content']	= $this->load->view('k3/tambah_sub_quest',NULL,TRUE);

		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function tambah_quest($id){
		
		$_POST	= $this->securities->clean_input($_POST,'save');
		$admin 	= $this->session->userdata('admin');
		$vld 	= array(
			array(
				'field'=>'value',
				'label'=>'Pertanyaan',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			unset($_POST['Simpan']);
			$_POST['entry_stamp'] 	= date("Y-m-d H:i:s");
			$_POST['id_group']		= $id;
			$res = $this->km->save_quest($this->input->post());
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data!</p>');
				redirect(site_url('admin/admin_k3'));
			}
			
		}

		$layout['content']	= $this->load->view('k3/tambah_quest',NULL,TRUE);
		$item['header'] 	= $this->load->view('admin/header',$admin,TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
}