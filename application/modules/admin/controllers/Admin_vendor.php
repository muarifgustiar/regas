<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_vendor extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}
		$this->load->model('user/admin_user_model','aum');
		
	}
	
	public function waiting_list(){
		$this->load->model('vendor/vendor_model','vm');
		$sort = $this->utility->generateSort(array('legal_name', 'name', 'last_update'));
		$per_page=10;
		$search = $this->input->get('q');
		$page = '';
		
		$data['pagination'] = $this->utility->generate_page('vendor/waiting_list',$sort, $per_page, $this->vm->get_waiting_list($search, $sort, '','',FALSE));
		$data['sort'] = $sort;
		$data['list'] = $this->vm->get_waiting_list();

		$layout['content'] =  $this->load->view('vendor/waiting_list',$data,TRUE);
		// $layout['content'] = $this->load->view('admin/admin/dashboard_content',$data,TRUE);

		$item['header'] = $this->load->view('header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function daftar(){
		$search = $this->input->get('q');
		$page = '';
		$per_page=10;

		$sort = $this->utility->generateSort(array('name', 'legal_name', 'sbu_name', 'username', 'password'));
		$filter = $this->input->post('filter');

		$data['filter_list'] = $this->form->get_filter_post(array(
																'ms_vendor.name'=>'Nama Vendor',
																'tb_legal.name'=>'Badan Usaha',
																'username'=>'Username',
																'password'=>'Password'
															));
		$data['vendor_list']=$this->vm->get_vendor_list($search, $sort, $page, $per_page,TRUE,$filter);

		$data['pagination'] = $this->utility->generate_page('admin/admin_vendor/daftar',$sort, $per_page, $this->vm->get_vendor_list($search, $sort, '','',FALSE,$filter));
		$data['sort'] = $sort;

		$layout['content']= $this->load->view('vendor/content',$data,TRUE);
		$layout['script']= $this->load->view('dpt/content_dpt_js',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);

		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
}