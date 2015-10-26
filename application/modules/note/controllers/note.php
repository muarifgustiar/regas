<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Note extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Note_model','nm');
		
	}
	public function index($id){
		$_POST['id_vendor'] = $id;
		$_POST['entry_stamp']=date('Y-m-d H:i:s');
		$res = $this->nm->save_note($this->input->post());
		$url = $this->input->post('url');
		// if($res){
			unset($_POST);
			redirect($url);
		// }
	}
}
