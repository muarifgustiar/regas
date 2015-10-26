<?php defined('BASEPATH') OR exit('No direct script access allowed');

class K3 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('user')&&!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('K3_model','km');
		$this->load->library('utility');
		
	}
	public function index(){
		$user = $this->session->userdata('user');
		
		if($this->input->post('next')){
			$vld = 	array(
			array(
				'field'=>'csms',
				'label'=>'csms_radio',
				'rules'=>'required'
				)
			);
			if($this->input->post('csms')==1){
				$vld 	= 	array(
								array(
									'field'=>'csms_file',
									'label'=>'Lampiran CSMS',
									'rules'=>'callback_do_upload_single[csms_file]'
								),
								array(
									'field'=>'expiry_date',
									'label'=>'Masa Berlaku',
									'rules'=>'required'
								)
							);

				$this->form_validation->set_rules($vld);
				if($this->form_validation->run()==TRUE){

					$_POST['entry_stamp'] = date("Y-m-d H:i:s");
					// unset($_POST['next']);

					$res = $this->km->save_csms_data($this->input->post(),$user['id_user']);

					if($res){
						$this->dpt->non_iu_change($user['id_user']);
						redirect(site_url('k3'));
					}
				}
				// redirect('k3/hse');
			}else{
				redirect(site_url('k3/csms_form'));
			}
		}


		$data_k3['csms_file'] 	= $this->km->get_k3_all_data($user['id_user']);

		if(empty($data_k3['csms_file'])){

			$layout['content']	= $this->load->view('form_csms',NULL,TRUE);
		}else{
			// print_r($data_k3['csms_file']);
			$data_k3['data_k3']			= $this->km->get_k3_data($user['id_user']);
			$data_k3['field_quest'] 	= $this->km->get_field_quest();
			$data_k3['ms_quest']		= $this->km->get_header_list();
			$data_k3['sub_quest']		= $this->km->get_sub_quest_list();
			$data_k3['data_quest']		= $this->km->get_quest_list();
			$data_k3['data_field']		= $this->km->get_data_field();
			$data_k3['quest_all']		= array();

			foreach($data_k3['ms_quest'] as $key_ms => $row_ms){
				$data_k3['quest_all'][$key_ms]['label'] 	= $row_ms;
			}

			foreach($data_k3['sub_quest'] as $key_sub_quest => $val_sub_quest){
				foreach($val_sub_quest as $k_sub_quest => $v_sub_quest){
					$data_k3['quest_all'][$key_sub_quest]['data'][$k_sub_quest] = $v_sub_quest;
				}
			}

			foreach($data_k3['data_quest'] as $key_quest => $val_quest){
				$data_k3['quest_all'][$val_quest['id_ms_header']]['data'][$val_quest['id_sub_header']]['data'][$val_quest['id']] = array();
			}

			foreach ($data_k3['data_field'] as $key_data => $value_data) {
				$data_k3['quest_all'][$value_data['id_ms_header']]['data'][$value_data['id_sub_header']]['data'][$value_data['id_question']][$value_data['id']] = $value_data;	
			}

			$layout['content']	= $this->load->view('form_view',$data_k3,TRUE);
		}

		
		$layout['script']	= $this->load->view('form_k3_js',NULL,TRUE);
		
		

		$item['header'] = $this->load->view('dashboard/header',$this->session->userdata('user'),TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}


	public function csms_form(){	
		$user = $this->session->userdata('user');
		/*$data['ms_quest']		= $this->km->get_master_header();$data['sub_quest']		= $this->km->get_sub_header();$data['quest']			= $this->km->get_quest();$data['field_quest'] 	= $this->km->get_field_quest();*/
		$data['data_k3']		= $this->km->get_k3_data($user['id_user']);
		$data['csms_file'] 		= $this->km->get_k3_all_data($user['id_user']);
		$data['field_quest'] 	= $this->km->get_field_quest();
		$data['ms_quest']		= $this->km->get_header_list();
		$data['sub_quest']		= $this->km->get_sub_quest_list();
		$data['data_quest']		= $this->km->get_quest_list();
		$data['data_field']		= $this->km->get_data_field();
		$data['quest_all']		= array();

		foreach($data['ms_quest'] as $key_ms => $row_ms){
			$data['quest_all'][$key_ms]['label'] 	= $row_ms;
		}

		foreach($data['sub_quest'] as $key_sub_quest => $val_sub_quest){
			foreach($val_sub_quest as $k_sub_quest => $v_sub_quest){
				$data['quest_all'][$key_sub_quest]['data'][$k_sub_quest] = $v_sub_quest;
			}
		}

		foreach($data['data_quest'] as $key_quest => $val_quest){
			$data['quest_all'][$val_quest['id_ms_header']]['data'][$val_quest['id_sub_header']]['data'][$val_quest['id']] = array();
		}

		foreach ($data['data_field'] as $key_data => $value_data) {
			$data['quest_all'][$value_data['id_ms_header']]['data'][$value_data['id_sub_header']]['data'][$value_data['id_question']][$value_data['id']] = $value_data;	
		}
		// echo print_r($data['quest_all']);

		if($this->input->post('simpan')){
			$this->do_upload($_FILES['quest'],$data['field_quest']);
			$res = $this->km->save_k3_data($this->input->post('quest'),$user['id_user']);
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');
				redirect('k3');
			}
		}
		// echo print_r($this->km->get_k3_data($user['id_user']));
		if(count($this->km->get_k3_data($user['id_user']))>0){
			$layout['content']= $this->load->view('form_view',$data,TRUE);
		}else{
			$layout['content']= $this->load->view('form',$data,TRUE);
		}

		$item['header'] 	= $this->load->view('dashboard/header',$this->session->userdata('user'),TRUE);
		$item['content'] 	= $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	/*public function hse(){	
		$user = $this->session->userdata('user');
		
		if($this->input->post('next')){
			
			$vld[] = array(
				'field'=>'hse_file',
				'label'=>'Lampiran HSE',
				'rules'=>'callback_do_upload[hse_file]'
				);
			$this->form_validation->set_rules($vld);
			if($this->form_validation->run()==TRUE){
				$_POST['entry_stamp'] = date("Y-m-d H:i:s");
				unset($_POST['Update']);

				$res = $this->km->save_hse_data($this->input->post(),$user['id_user']);
				if($res){
					$this->dpt->non_iu_change($user['id_user']);
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');
					redirect(site_url('k3'));
				}
			}
		}

		$layout['content']= $this->load->view('form_hse',NULL,TRUE);
		$layout['script']= $this->load->view('form_k3_js',NULL,TRUE);
		
		

		$item['header'] = $this->load->view('dashboard/header',$this->session->userdata('user'),TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}*/

	public function edit(){
		$user = $this->session->userdata('user');
		$data['ms_quest']		= $this->km->get_master_header();
		$data['sub_quest']		= $this->km->get_sub_header();
		$data['quest']			= $this->km->get_quest();
		$data['field_quest'] 	= $this->km->get_field_quest();
		$data['data_k3']		= $this->km->get_k3_data($user['id_user']);
		
		if($this->input->post('simpan')){

			$this->do_upload($_FILES['quest'],$data['field_quest']);
			$res = $this->km->update_k3_data($this->input->post('quest'),$user['id_user'],'edit');
			if($res){
				$this->dpt->set_email_blast($res,'ms_csms','Lampiran CSMS',$_POST['expire_date']);
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');
				redirect('k3');
			}
			
		}

		$layout['content']= $this->load->view('form_edit',$data,TRUE);		

		$item['header'] = $this->load->view('dashboard/header',$this->session->userdata('user'),TRUE);
		$item['content'] = $this->load->view('user/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	
	public function do_upload($files,$quest){
		// echo print_r($files);
		$this->load->library('upload');	
		$config['allowed_types'] = 'pdf|jpeg|jpg|png|gif';
		$config['max_size'] = '2096';

		foreach($files['name'] as $key => $file){
			if($file!=''){
				$folder = $quest[$key]['label'];
				$file_name = $folder.'_'.$this->utility->name_generator($files['name'][$key]);
				$_FILES['quest']['name'] = $file_name;  
				$_FILES['quest']['size'] = $files['size'][$key];  
				$_FILES['quest']['tmp_name'] = $files['tmp_name'][$key];  
				$_FILES['quest']['type'] = $files['type'][$key];
				$_FILES['quest']['error'] = $files['error'][$key];

				$config['upload_path'] = './lampiran/'.$folder.'/';

				if(!is_dir($config['upload_path'])){
					mkdir($config['upload_path']);
				}  

				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('quest')){
					$_POST['quest'][$key] = $file_name;
					// echo $this->upload->display_errors('','');
					$this->session->userdata('msgSuccess',$this->upload->display_errors('',''));
					return false;
				}else{
					$_POST['quest'][$key] = $file_name;
					return true;
				}
			}
		}
	}
	public function do_upload_single($field, $db_name = ''){	
		
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
	public function get_vendor_group(){
		$this->load->library('form');
		$search = $this->input->get('q');
		$page = '';
		// unset($_POST);

		$per_page=10;

		$sort = $this->utility->generateSort(array('name','npwp_code','nppkp_code','id'));
		
		$data['vendor_list']=$this->km->get_k3_vendor($search, $sort, $page, $per_page,TRUE);

		// $data['filter_list'] = $this->form->group_filter_post($this->get_field());

		$data['pagination'] = $this->utility->generate_page('admin/admin_dpt',$sort, $per_page, $this->km->get_k3_vendor($search, $sort, '','',FALSE));
		$data['sort'] = $sort;
		$layout['content']= $this->load->view('k3/content_dpt',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function penilaian_k3($id_vendor){
		
		$data['vendor'] = $this->vm->get_data($id_vendor);
		$data['ms_quest']=$this->km->get_master_header();
		
		$data['quest']=$this->km->get_quest();
		$data['field_quest'] = $this->km->get_field_quest();
		$data['evaluasi_list'] = $this->km->get_evaluasi_list();
		$data['evaluasi'] = $this->km->get_evaluasi();
		$data['data_k3']=$this->km->get_k3_data($id_vendor);
		$data['get_csms'] = $this->km->get_csms($id_vendor);
		$data['get_hse'] = $this->km->get_hse($id_vendor);
		$data['value_k3']=$this->km->get_penilaian_value($id_vendor);
		
		// echo print_r($data['data']);
		if($this->input->post('simpan')){
			$res = $this->km->save_evaluasi_poin($this->input->post('evaluasi'),$id_vendor);
			
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');
				redirect('k3/penilaian_view/'.$id_vendor);
			}
		}
		$layout['content']= $this->load->view('k3/penilaian_k3',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function penilaian_view($id_vendor){
		$data['id'] = $id_vendor;
		$data['vendor'] = $this->vm->get_data($id_vendor);
		$user = $this->session->userdata('user');
		$data['ms_quest']=$this->km->get_master_header();
		$data['quest']=$this->km->get_quest();
		$data['field_quest'] = $this->km->get_field_quest();
		$data['evaluasi_list'] = $this->km->get_evaluasi_list();
		$data['evaluasi'] = $this->km->get_evaluasi();
		$data['data_k3']=$this->km->get_k3_data($id_vendor);
		$data['csms_limit']=$this->km->get_csms_limit($id_vendor);



		$data['data_poin']=$this->km->get_poin($id_vendor);
		$data['value_k3']=$this->km->get_csms_limit();
		
		$layout['content']= $this->load->view('k3/penilaian_view',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
}
