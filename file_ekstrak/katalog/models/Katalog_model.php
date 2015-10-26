<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog_model extends CI_Model{
	public $CI;
	function __construct(){
		parent::__construct();
		$this->field_master = array(
								'id_vendor',
								'start_date',
								'end_date',
								'remark',
								'blacklist_file',
								'entry_stamp'
							);
		$this->CI =& get_instance();
        $this->CI->load->model('vendor_model','vm');
	}

	function get_katalog($search='', $sort='', $page='', $per_page='',$is_page=FALSE,$filter=array()){
		// $user = $this->session->userdata('user');

	
		$this->db->select('*, ms_material.id as id_materials, (select price from tr_material_price WHERE id_material = id_materials ORDER BY entry_stamp LIMIT 1)as last_price');
		// ->join('ms_procurement','ms_vendor_admistrasi.id_vendor=ms_vendor.id','LEFT');
		
		

		$a = $this->form->generate_query($this->db->group_by('id'),$filter);
		

		if($this->input->get('sort')&&$this->input->get('by')){
			$a->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$a->limit($per_page, $per_page*($cur_page - 1));
		}

		$query = $a->get('ms_material');
		
		return $query->result_array();
	}

	function search_katalog(){
		$result = array();
		$query = $this->db  ->select('id, nama,(SELECT AVG(price) FROM tr_material_price WHERE id_material = ms_material.id) as average')
							->like('nama',$this->input->post('term'),'both')
							->where('del',0)
							->get('ms_material')
							->result_array();
		foreach($query as $key => $value){
			$result[$value['id']]['id'] = $value['id'];
			$result[$value['id']]['name'] = $value['nama'];
			$result[$value['id']]['average'] = $value['average'];
		}
		// echo $this->db->last_query();
		return $result;
	}
}