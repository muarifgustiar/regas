<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}

	}
	public function index()
	{
		$this->load->library('datatables');
		$this->load->model('vendor/vendor_model','vm');
		$data['daftar_tunggu']	= $this->vm->get_total_daftar_tunggu();
		$data['total_dpt'] 		= $this->vm->get_total_dpt();

		$layout['content'] 		= $this->load->view('admin/admin/dashboard_content',$data,TRUE);
		$layout['script'] 		= $this->load->view('admin/admin/dashboard_content_js',$data,TRUE);

		$item['header'] 		= $this->load->view('header',$this->session->userdata('admin'),TRUE);
		$item['content'] 		= $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	
	

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url());
	}


	function get_dpt_list(){
		$this->load->library('datatables');

		$this->datatables	->select('tb_legal.name as legal_name, ms_vendor.name as vendor_name, ms_vendor.edit_stamp as last_activity')
							->join('ms_vendor','ms_vendor.id=ms_vendor_admistrasi.id_vendor')
							->join('tb_legal','tb_legal.id=ms_vendor_admistrasi.id_legal')
							->where('ms_vendor.vendor_status',1)
							->from('ms_vendor_admistrasi');

		echo $this->datatables->generate();
	}
}
