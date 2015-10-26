<?php defined('BASEPATH') OR exit('No direct script access allowed');

class admin_reporting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('report/admin_report_model','arm');
		$this->load->helper('form');
	}

	public function index(){

		$vld = 	array(
			array(
				'field'=>'report[]',
				// 'field'=>'report',
				'label'=>'Pilih Report',
				'rules'=>'required'
				)
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			unset($_POST['print']);
			// $_POST['entry_stamp'] = date("Y-m-d H:i:s");
			// foreach ($this->input->post('report') as $key => $value) {
				
			// 	if($value=='name'){
			// 		// $data['name'] = $this->arm->get_name();
			// 	}
			// 	// echo $value;

			// }
			// $this->aum->save_data($this->input->post());

			redirect(site_url('admin/admin_reporting/content'));
		}

		// $data['sbu'] = $this->vm->get_sbu();
		// $data['role'] = $this->aum->get_role();


		$layout['content']	= $this->load->view('report/custom',$data,TRUE);

		$item['header'] 	= $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] 	= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}



	function filter_parameter(){
		return array( 
			'administrasi' =>
			array(
				'label' => 'Administrasi',	
				'field' => array(
					'administrasi_nama'	=> array('name' => 'Nama Badan Usaha', 'header' => 'administrasi_nama', 'field' => 'a.nama','type' => 'text'),
					'badan_usaha' => array('name' => 'Badan Hukum', 'header' => 'badan_usaha', 'field' => 'bg.name','type' => 'text'),
					'website' => array('name' => 'Website', 'header' => 'website', 'field' => 'a.website','type' => 'text'),
					'administrasi_sbu' => array('name' => 'Satuan Unit/Kerja', 'header' => 'administrasi_sbu','field' => 'i.name','type' => 'text'),
					'npwp' 	=> array('name' => 'NPWP', 'header' => 'npwp', 'field' => 'a.npwp','type' => 'text'),
					'nppkp' => array('name' => 'NPPKP', 'header' => 'nppkp', 'field' => 'a.nppkp','type' => 'text'),
					'administrasi_kategori' => array('name' => 'Kategori', 'header' => 'administrasi_kategori', 'field' => 'c.name','type' => 'text'),
					'alamat' => array('name' => 'Alamat', 'header' => 'alamat', 'field' => 'a.alamat','type' => 'text'),
					'kota' => array('name' => 'Kota', 'header' => 'kota', 'field' => 'af.name','type' => 'text'),
					'email' => array('name' => 'Email', 'header' => 'email', 'field' => 'a.email','type' => 'text'),
					'website' => array('name' => 'Website', 'header' => 'website', 'field' => 'a.website','type' => 'text'),
				),
			),
			'akta' => 
			array(
				'label' => 'Akta Perusahaan',
				'field' => array(
					'no_akta' => array('name' => 'No. Akta', 'header' => 'no_akta', 'field' => 'k.no_akta','type' => 'text'),
				)
			),
		);
	}


	function content(){
		// $data['pagination'] = $this->utility->generate_page('admin/admin_reporting/content',$sort, $per_page, $this->aum->get_name($search, $sort, '','',FALSE));
		// $data['sort'] 		= $sort;
		$data['name'] 			= $this->arm->get_name();
		// $data['address'] 		= $this->arm->get_address();

		// $layout['content']	= $this->load->view('report/content',$data,TRUE);

		$item['header'] 	= $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] 	= $this->load->view('report/content',$data,TRUE);
		$this->load->view('template',$item);

	}
	
}