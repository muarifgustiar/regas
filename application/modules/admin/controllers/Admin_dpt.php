<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dpt extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('user/admin_user_model','aum');
		$this->load->model('vendor/vendor_model','vm');
		
	}
	public function index(){
		$this->load->library('form');
		$this->load->library('datatables');
		$search = $this->input->get('q');
		$page = '';
		// unset($_POST);

		$per_page=10;

		$sort = $this->utility->generateSort(array('name','point','npwp_code','nppkp_code','id'));
		
		$data['vendor_list']=$this->vm->get_dpt_list($search, $sort, $page, $per_page,TRUE);

		$data['filter_list'] = $this->form->group_filter_post($this->get_field());

		$data['pagination'] = $this->utility->generate_page('admin/admin_dpt',$sort, $per_page, $this->vm->get_dpt_list($search, $sort, '','',FALSE,$this->get_field()));
		$data['sort'] = $sort;
		$layout['content']= $this->load->view('dpt/content_dpt',$data,TRUE);
		$layout['script']= $this->load->view('dpt/content_dpt_js',$data,TRUE);
		$layout['script']= $this->load->view('dpt/form_filter',$data,TRUE);
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
			// array(
				// 'label'	=>	'Tanggal Diangkat DPT',
				// 'filter'=>	array(
								// array('table'=>'tr_dpt|start_date' 	,'type'=>'date_range','label'=> array('Dari tanggal :','Hingga Tanggal'))
							// )
			// ),
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