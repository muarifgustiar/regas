<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('vendor/vendor_model','apprm');
		$this->load->library('data_process');
	}

	public function administrasi($id){
		$this->load->model('vendor/vendor_model','vm');
		
		$data = $this->vm->get_data($id);
		$vld = 	array(
					array(
						'field'=>'status',
						'label'=>'Status',
						'rules'=>'required'
					)
				);
		
		$this->form_validation->set_rules($vld);

		if($this->input->post('simpan')){
			if($this->form_validation->run()==TRUE){
				$result = $this->data_process->check($this->input->post(),$data['id'],'ms_vendor_admistrasi');
				if($result){
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
					redirect(site_url('approval/administrasi/'.$id));
				}
			}
		}
		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('administrasi',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	
	public function akta($id,$akta_type='pendirian'){
		$this->load->model('akta/akta_model','am');
		
		$data['akta_list'] = $this->am->get_akta_admin_list($id,$akta_type);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('akta') as $key => $value){
				$this->data_process->check($value,$key,'ms_akta');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/akta/'.$id.'/'.$akta_type));
				
		}
		$data['id_data'] = $id;

		if($akta_type=='pendirian'){
			$view = 'akta/akta_pendirian';
		}else{
			$view = 'akta/akta_perubahan';
		}
		$layout['content'] =  $this->load->view($view,$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function situ($id){
		$this->load->model('situ/situ_model','sm');
		
		$data['situ_list'] = $this->sm->get_situ_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('situ') as $key => $value){
				$this->data_process->check($value,$key,'ms_situ');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/situ/'.$id));
				
		}
		$data['id_data'] = $id;

		
		$layout['content'] =  $this->load->view('situ',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function tdp($id){
		$this->load->model('tdp/tdp_model','sm');
		
		$data['tdp_list'] = $this->sm->get_tdp_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('tdp') as $key => $value){
				$this->data_process->check($value,$key,'ms_tdp');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/tdp/'.$id));
				
		}
		$data['id_data'] = $id;

		
		$layout['content'] =  $this->load->view('tdp',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function pengurus($id){
		$this->load->model('pengurus/pengurus_model','pm');
		
		$data['pengurus_list'] = $this->pm->get_pengurus_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('pengurus') as $key => $value){
				$this->data_process->check($value,$key,'ms_pengurus');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/pengurus/'.$id));
			
		}
		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('pengurus',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function pemilik($id){
		$this->load->model('pemilik/pemilik_model','pm');
		
		$data['pemilik_list'] = $this->pm->get_pemilik_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('pemilik') as $key => $value){
				$this->data_process->check($value,$key,'ms_pemilik');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/pemilik/'.$id));
			
		}
		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('pemilik',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function badan_usaha($id,$surat='siup'){
		$this->load->model('izin/izin_model','im');
		$this->load->model('approval_model','am');

		$data['dt_siu'] = array('siup'=>'SIUP','ijin_lain'=>'Surat Izin Usaha Lainnya','asosiasi'=>'Sertifikat Asosiasi/Lainnya','siujk'=>'SIUJK','sbu'=>'SBU');
		$data['dt_dpt'] = $this->am->get_dpt_type();
		$data['surat'] = $surat;


		$table = array(
					'siup' => array(
						'dpt'	=>	'DPT Tipe',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'ijin_lain' => array(
						'dpt'	=>	'DPT Tipe',
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'asosiasi' => array(
						'dpt'	=>	'DPT Tipe',
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),	
					'sbu'=>array(
						'dpt'	=>	'DPT Tipe',
						'authorize_by'	=>	'Anggota Asosiasi',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'siujk'=>array(
						'dpt'	=>	'DPT Tipe',
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					)
				);
		
		if($this->input->post('simpan')){

			foreach($this->input->post('ijin_usaha') as $key => $value){
				$a = $this->data_process->check($value,$key,'ms_ijin_usaha');
				if($a){
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
				}
			}
			redirect(site_url('approval/badan_usaha/'.$id.'/'.$surat));
			
		}
		$data['table'] = $table;
		$data['id_data'] = $id;
		$data['izin_list'] = $this->im->get_izin_admin_list($id,$surat);

		$layout['content'] =  $this->load->view('izin',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function bsb($id_data,$id){
		$this->load->model('izin/izin_model','im');
		
		$data['bsb_list'] = $this->im->get_bsb_admin_list($id);
		$data['get_data'] = $this->im->get_data($id);
		$data['dt_siu'] = array('siup'=>'SIUP','ijin_lain'=>'Surat Izin Usaha Lainnya','asosiasi'=>'Sertifikat Asosiasi/Lainnya','siujk'=>'SIUJK','sbu'=>'SBU');
		
		$table = array(
					'siup' => array(
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'ijin_lain' => array(
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'asosiasi' => array(
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),	
					'sbu'=>array(
						'authorize_by'	=>	'Anggota Asosiasi',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					),
					'siujk'=>array(
						'authorize_by'	=>	'Lembaga Penerbit',
						'no'	=>	'No.',
						'issue_date'=> 'Tanggal',
						'qualification'=>'Kualifikasi',
						'expire_date'=>'Masa Berlaku',
						'izin_file'=>'Lampiran',
					)
				);

		if($this->input->post('simpan')){
			foreach($this->input->post('bsb') as $key => $value){
				$this->data_process->check($value,$key,'ms_iu_bsb');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/bsb/'.$id_data.'/'.$id));
			
		}
		$data['id_data'] = $id_data;
		$data['table'] = $table;
		$layout['content'] =  $this->load->view('bsb',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function agen($id){
		$this->load->model('agen/agen_model','am');
		
		$data['agen_list'] = $this->am->get_agen_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('agen') as $key => $value){
				$this->data_process->check($value,$key,'ms_agen');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/agen/'.$id));
			
		}
		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('agen',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function produk($id_data,$id){
		$this->load->model('agen/agen_model','am');
		$data = $this->am->get_data($id);
		$data['produk_list'] = $this->am->get_produk_admin_list($id_data,$id);
		
		
		if($this->input->post('simpan')){
			foreach($this->input->post('produk') as $key => $value){
				$this->data_process->check($value,$key,'ms_agen_produk');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/produk/'.$id_data.'/'.$id));
			
		}
		$data['id_data'] = $id_data;
		$layout['content'] =  $this->load->view('produk',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function pengalaman($id){
		$this->load->model('pengalaman/pengalaman_model','pm');
		
		$data['pengalaman_list'] = $this->pm->get_pengalaman_admin_list($id);
		
		if($this->input->post('simpan')){
			foreach($this->input->post('pengalaman') as $key => $value){
				$this->data_process->check($value,$key,'ms_pengalaman');
			}
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
			redirect(site_url('approval/pengalaman/'.$id));
			
		}
		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('pengalaman',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function pengalaman_detail($id_data,$id){
		$this->load->model('pengalaman/pengalaman_model','pm');
		
		$data = $this->pm->get_data_full($id_data,$id);

		$data['id_data'] = $id;
		$data['id_pengalaman'] = $id_data;
		$layout['content'] =  $this->load->view('pengalaman_detail',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function k3($id){
		$this->load->model('k3/k3_model','km');
		$data = $this->vm->get_data($id);
		$data['id_data'] = $id;

		$data['ms_quest']=$this->km->get_master_header();
		$data['quest']=$this->km->get_quest();
		$data['field_quest'] = $this->km->get_field_quest();
		$data['evaluasi_list'] = $this->km->get_evaluasi_list();
		$data['evaluasi'] = $this->km->get_evaluasi();
		$data['data_k3']=$this->km->get_k3_data($id);
		$data['get_csms'] = $this->km->get_csms($id);
		$data['get_hse'] = $this->km->get_hse($id);
		$data['value_k3']=$this->km->get_penilaian_value($id);
		$data['score_k3'] = $this->km->get_poin($id);
		$layout['content']= $this->load->view('k3',$data,TRUE);
		$vld = 	array(
					array(
						'field'=>'status',
						'label'=>'Status',
						'rules'=>'required'
					)
				);
		
		$this->form_validation->set_rules($vld);
		if($this->input->post('simpan')){
			if($this->form_validation->run()==TRUE){
				$_POST['mandatory'] = 1;
				$result = $this->data_process->check($this->input->post(),$data['score_k3']['id'],'ms_score_k3');
				if($result){
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menyimpan data!</p>');	
					redirect(site_url('approval/k3/'.$id));
				}
			}
		}

		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function verification($id){
		$this->load->model('approval_model','am');
		
		$data['approval_data'] = $this->am->get_total_data($id);
		$data['graphBar'] = array(
									0=>
										array('val'=>(count($data['approval_data'][0]))/$data['approval_data']['total']*100,
											'color'=>'#f39c12'
										),
									1=>
										array('val'=>(count($data['approval_data'][1])+count($data['approval_data'][2]))/$data['approval_data']['total']*100,
											'color'=>'#2cc36b'
										),
									3=>array('val'=>(count($data['approval_data'][3])+count($data['approval_data'][4]))/$data['approval_data']['total']*100,
											'color'=>'#c0392b'
										),
								);

		if($this->input->post('simpan')){
			if(count($data['approval_data'][0])>0||count($data['approval_data'][3])>0){
				$this->session->set_flashdata('msgError','<p class="errorMsg">Tidak Bisa diangkat menjadi vendor. Ada beberapa data yang harus diperbaiki</p>');	
			}else{
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengangkat vendor!</p>');	

				$data['approval_data'] = $this->am->angkat_vendor($id);
				
				redirect(site_url('approval/verification/'.$id));
			}

		}

		$data['id_data'] = $id;
		$layout['content'] =  $this->load->view('verifikasi',$data,TRUE);
		$layout['script'] =  $this->load->view('verifikasi_js',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
}
