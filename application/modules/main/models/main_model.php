<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model{

	function __construct(){
		parent::__construct();

	}

	function cek_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$sql = "SELECT * FROM ms_login WHERE username = ? AND password = ?";
		$sql = $this->db->query($sql, array($username, $password));
		$sql = $sql->row_array();

		$ct_sql = '';

		if($sql){

			if($sql['type'] == "user"){

				$ct_sql = "SELECT * FROM ms_vendor WHERE id=?";
				$ct_sql = $this->db->query($ct_sql, $sql['id_user']);
				$data = $ct_sql->row_array();
				
				$set_session = array(
					'id_user' 		=> 	$data['id'],
					'name'			=>	$data['name'],
					'id_sbu'		=>	$data['id_sbu'],
					'vendor_status'	=>	$data['vendor_status'],
					'is_active'		=>	$data['is_active'],
					'app'			=>	'vms'
				);
				
				$this->session->set_userdata('user',$set_session);

				return true;
			}else if($sql['type'] == "admin"){
				$ct_sql = "SELECT *,tb_role.name role_name FROM ms_admin JOIN tb_role ON ms_admin.id_role = tb_role.id WHERE ms_admin.id=?";
				$ct_sql = $this->db->query($ct_sql, $sql['id_user']);
				$data = $ct_sql->row_array();
				
				$set_session = array(
					'id_user' 		=> 	$data['id'],
					'name'			=>	$data['name'],
					'id_sbu'		=>	$data['id_sbu'],
					'id_role'		=>	$data['id_role'],
					'role_name'		=>	$data['role_name'],
					'sbu_name'		=>	$data['sbu_name'],
					'app'			=>	'vms'
				);
				
				$this->session->set_userdata('admin',$set_session);

				return true;
			}

		}else{
			return false;
		}
	}
	function set_admin_queue(){
		
	}
}