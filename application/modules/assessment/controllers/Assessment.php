<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends CI_Controller {

	public $id_pengadaan;
	public $tabNav;

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}

		$this->load->model('assessment_model','am');
				
	}

	public function index()
	{	
		$this->load->library('form');
		$search = '';
		$page = '';
		$post = $this->input->post();

		$per_page=10;

		$sort = $this->utility->generateSort(array('name', 'pemenang', 'pemenang_kontrak', 'nppkp_code','id'));
		
		$data['pengadaan_list']=$this->am->get_pengadaan_list($search, $sort, $page, $per_page,TRUE);

		$data['filter_list'] = $this->form->group_filter_post($this->get_field());

		$data['pagination'] = $this->utility->generate_page('assessment',$sort, $per_page, $this->am->get_pengadaan_list($search, $sort, '','',FALSE));
		$data['sort'] = $sort;

		$layout['content']= $this->load->view('assessment/content',$data,TRUE);
		$layout['script']= $this->load->view('assessment/content_js',$data,TRUE);
		$layout['script']= $this->load->view('assessment/form_filter',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function view_vendor($id_pengadaan)
	{	
		$post = $this->input->post();

		$per_page=10;

		$data['sort'] = $this->utility->generateSort(array('peserta_name','point'));
	
		$data['list'] = $this->am->get_assessment_vendor_list($id_pengadaan);

		// $data['filter_list'] = $this->form->group_filter_post($this->get_field());
		$page = 'peserta';
		$data['pagination'] = $this->utility->generate_page('assessment/view_vendor/'.$id_pengadaan, NULL,  $this->am->get_procurement_peserta($id_pengadaan,NULL, $data['sort'], '','',FALSE));
		
		$data['id']	= $id_pengadaan;
		$layout['content']= $this->load->view('assessment/content_vendor',$data,TRUE);
		$layout['script']= $this->load->view('assessment/content_js',$data,TRUE);
		$layout['script']= $this->load->view('assessment/form_filter',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function form_assessment($id,$id_vendor){
		$this->load->model('blacklist/blacklist_model','blm');
		$data = $this->am->get_pengadaan($id);
		// $data_kontrak = $this->am->get_kontrak($id);

		$data['assessment_question'] = $this->am->get_question_assessment();
		$data['tabNav'] = $this->tabNav;
		$data['data_assessment'] = $this->am->get_assessment($id,$id_vendor);
		
		if($this->input->post('simpan')){
			unset($_POST['simpan']);
			$_POST['id_vendor'] = $id_vendor;
			$_POST['id_procurement'] = $id;
			$poin = $this->am->save_assessment($id,$this->input->post());
			
			$cb = $this->blm->check_blacklist($poin,$opt,site_url('assessment/view_vendor/'.$id));
			
			if($cb){
				
				if($this->session->userdata('admin')['id_role']==3){
					$this->session->set_userdata('blacklist',$cb);
					$this->session->set_flashdata('msgSuccess','<p class="errorMsg">Data vendor masuk dalam blacklist</p>');
					redirect('blacklist/tambah/');
				}else{
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Data Penilaian telah terkirim</p>');
					redirect(site_url('assessment/view_vendor/'.$id));
				}

			}else{
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Data Penilaian telah terkirim</p>');
				redirect(site_url('assessment/view_vendor/'.$id));
			}

		}
		$layout['content']= $this->load->view('assessment/form_assessment',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function get_field(){
		return array(
			array(
				'label'	=>	'Administrasi',
				'filter'=>	array(
								array('table'=>'ms_vendor|name' ,'type'=>'text','label'=> 'Nama Vendor'),
								array('table'=>'tb_legal|name' ,'type'=>'text','label'=> 'Badan Hukum'),
								array('table'=>'ms_vendor_admistrasi|vendor_website' ,'type'=>'text','label'=> 'Website'),
								array('table'=>'ms_vendor_admistrasi|npwp_code' ,'type'=>'text','label'=> 'NPWP'),
								array('table'=>'ms_vendor_admistrasi|nppkp_code' ,'type'=>'text','label'=> 'NPPKP'),
								array('table'=>'ms_vendor_admistrasi|vendor_address' ,'type'=>'text','label'=> 'Alamat'),
								array('table'=>'ms_vendor_admistrasi|vendor_city' ,'type'=>'text','label'=> 'Kota'),
								array('table'=>'ms_vendor_admistrasi|vendor_email' ,'type'=>'text','label'=> 'Email'),
							)
			),
			array(
				'label'	=>	'Akta Perusahaan',
				'filter'=>	array(
								array('table'=>'ms_akta|no' ,'type'=>'text','label'=> 'No Akta')
							)
			),
			array(
				'label'	=>	'Pengurus',
				'filter'=>	array(
								array('table'=>'ms_pengurus|name' 	,'type'=>'text','label'=> 'Nama'),
								array('table'=>'ms_pengurus|no' 	,'type'=>'text','label'=> 'No')
							)
			),
			array(
				'label'	=>	'Kepemilikan Modal',
				'filter'=>	array(
								array('table'=>'ms_pemilik|name' 	,'type'=>'text','label'=> 'Nama')
							)
			),
			array(
				'label'	=>	'SITU/SKPD',
				'filter'=>	array(
								array('table'=>'ms_situ|no' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_situ|address' 	,'type'=>'text','label'=> 'Alamat')
							)
			),
			array(
				'label'	=>	'Bidang / Sub Bidang',
				'filter'=>	array(
								array('table'=>'tb_bidang|name|get_bidang' 	,'type'=>'dropdown','label'=> 'Bidang')
							)
			),
			array(
				'label'	=>	'Tanggal Diangkat DPT',
				'filter'=>	array(
								array('table'=>'tr_dpt|start_date' 	,'type'=>'date_range','label'=> array('Dari tanggal :','Hingga Tanggal'))
							)
			),
			array(
				'label'	=>	'TDP',
				'filter'=>	array(
								array('table'=>'tr_tdp|no' 	,'type'=>'text','label'=> 'No'),
							)
			),
			array(
				'label'	=>	'SIUP',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|no|siup' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_ijin_usaha|qualification|siup' 	,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'tb_bidang|name|siup' 	,'type'=>'text','label'=> 'Bidang / Sub bidang'),
							)
			),array(
				'label'	=>	'Surat Ijin Usaha Lainnya',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|no|ijin_lain' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_ijin_usaha|qualification|ijin_lain' 	,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_ijin_usaha|authorize_by|ijin_lain' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'tb_bidang|name|ijin_lain' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'Sertifikat Asosiasi/Lainnya',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|authorize_by|asosiasi' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'ms_ijin_usaha|no|asosiasi' 	,'type'=>'text','label'=> 'no'),
								array('table'=>'tb_name|name|asosiasi' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'SIUJK',
				'filter'=>	array(
								
								array('table'=>'ms_ijin_usaha|qualification|siujk' ,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_ijin_usaha|authorize_by|siujk' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'ms_ijin_usaha|no|siujk' 	,'type'=>'text','label'=> 'no'),
								array('table'=>'tb_name|name|siujk' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'Keagenan',
				'filter'=>	array(
								
								array('table'=>'ms_agen_produk|type' ,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_agen_produk|name' 	,'type'=>'text','label'=> 'Nama Produk'),
								array('table'=>'ms_agen_produk|merk' 	,'type'=>'text','label'=> 'Nama Merk'),
							)
						
			),array(
				'label'	=>	'Pengalaman',
				'filter'=>	array(
								array('table'=>'ms_pengalaman|job_name' 	,'type'=>'text','label'=> 'Nama Paket Pengadaan'),
								array('table'=>'tb_name|name' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
								array('table'=>'ms_pengalaman|job_location' 	,'type'=>'text','label'=> 'Lokasi'),
								array('table'=>'ms_agen_produk|merk' 	,'type'=>'text','label'=> 'Nama Merk'),
							)
						)
			
		);
	}
}