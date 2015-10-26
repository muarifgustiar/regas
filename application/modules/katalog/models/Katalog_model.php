<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog_model extends CI_Model{
	public $CI;
	function __construct(){
		parent::__construct();
		$this->field_master = array(
								'nama',
								'remark',
								'gambar_barang',
								'entry_stamp'
							);
		$this->field_harga = array(
								'id_material',
								'price',
								'date',
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
		$this->db->where('del',0);
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
	function save_barang($data){
		$_param = array();
		$sql = "INSERT INTO ms_material (
							`nama`,
								`remark`,
								`gambar_barang`,
								`entry_stamp`
							) 
				VALUES (?,?,?,?) ";
		
		
		foreach($this->field_master as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);

		$id = $this->db->insert_id();
		
		return $id;
	}
	function get_data_barang($id){
		return $this->db->where('id',$id)->get('ms_material')->row_array();
	}
	function get_harga($id){
		$query = $this->db->select('*,tr_material_price.id id, ms_vendor.name vendor_name')
		->join('ms_vendor','tr_material_price.id_vendor = ms_vendor.id','LEFT')
		->where('tr_material_price.del',0)
		->where('tr_material_price.id_material',$id)
		->get('tr_material_price');
		$return =  $query->result_array();
		
		return $return;
	}
	function get_harga_barang($id){
		return $this->db->where('id',$id)->get('tr_material_price')->row_array();
	}
	function edit_barang($data,$id){
		$this->db->where('id',$id);
		$result = $this->db->update('ms_material',$data);
		if($result)return $id;
	}
	function edit_harga_barang($data,$id){
		$this->db->where('id',$id);
		$result = $this->db->update('tr_material_price',$data);
		if($result)return $id;
	}
	function delete_barang($id){
		$this->db->where('id',$id);
		return $this->db->update('ms_material',array('del'=>1));
	}
	function delete_harga($id){
		$this->db->where('id',$id);
		return $this->db->update('tr_material_price',array('del'=>1));
	}
	function save_harga_barang($id,$data){
		$_param = array();
		$sql = "INSERT INTO tr_material_price (
								`id_material`,
								`price`,
								`date`,
								`entry_stamp`
							) 
				VALUES (?,?,?,?) ";
		
		
		foreach($this->field_harga as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);

		$id = $this->db->insert_id();
		
		return $id;
	}
	function data_chart($id){
		$data_label = $this->get_data_barang($id);
		$raw_data 	= $this->db->select(' YEAR(`date`) as years,(SELECT AVG(`price`) FROM `tr_material_price` WHERE id_material = '.$id.' AND YEAR(`date`)=years) as avg_year')
							->where('id_material',$id)
							->group_by('years')
							->get('tr_material_price');
		
		return $raw_data->result_array();
	}	
}