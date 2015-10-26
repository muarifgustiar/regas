<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment_model extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	function get_pengadaan_list($search='', $sort='', $page='', $per_page='',$is_page=FALSE) 
    {
    	$user = $this->session->userdata('user');
		$this->db->select('*, ms_procurement.id id, ms_procurement.name name, ms_vendor.name pemenang, "-" as pemenang_kontrak , "-" as user_kontrak , proc_date, ms_procurement.del del');
		$this->db->group_by('ms_procurement.id');
		$this->db->where('ms_procurement.del',0);
		$this->db->where('ms_vendor.is_active',1);
		$this->db->where('ms_procurement.id_mekanisme!=',1);
		if($this->session->userdata('admin')['id_role']==4){
			$this->db->where('ms_procurement.status_procurement=',1);
		}
		$this->db->join('ms_procurement_peserta','ms_procurement_peserta.id_proc=ms_procurement.id','LEFT');
		$this->db->join('ms_vendor','ms_procurement_peserta.is_winner=ms_vendor.id','LEFT');
		if($this->input->get('sort')&&$this->input->get('by')){
			$this->db->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$this->db->limit($per_page, $per_page*($cur_page - 1));
		}
		
		$query = $this->db->get('ms_procurement');		
		return $query->result_array();
		
    }

   	function get_pengadaan($id){
   		$arr = $this->db->select('*,ms_procurement.name name, tb_budget_holder.name budget_holder_name, tb_budget_spender.name budget_spender_name, tb_pejabat_pengadaan.name pejabat_pengadaan_name,tb_mekanisme.name mekanisme_name')
   		->where('ms_procurement.id',$id)
   		->join('tb_pejabat_pengadaan','tb_pejabat_pengadaan.id=ms_procurement.id_pejabat_pengadaan','LEFT')
		->join('tb_budget_holder','tb_budget_holder.id=ms_procurement.budget_holder','LEFT')
		->join('tb_budget_spender','tb_budget_spender.id=ms_procurement.budget_spender','LEFT')
		->join('tb_mekanisme','tb_mekanisme.id=ms_procurement.id_mekanisme','LEFT')
   		->get('ms_procurement')->row_array();
		
		return $arr;
   	}


   	function get_assessment_vendor_list($id){
   		$result = $this->db->select('mpp.id id,ms_vendor.name peserta_name, 
   			(SELECT point FROM tr_ass_point where id_vendor = ms_vendor.id AND id_procurement = '.$id.') point ,
   			mpp.id_vendor id_vendor')

   		->where('mpp.id_proc',$id)
   		->where('ms_vendor.is_active',1)
   		->join('ms_vendor','ms_vendor.id=mpp.id_vendor')
   		->group_by('mpp.id')
   		// ->where('tr_ass_point.id_procurement',$id)
   		->where('mpp.del',0);
   		
		$res = $this->db->get('ms_procurement_peserta mpp')->result_array();
		
   		return $res;
   	}
   	
   	function get_assessment_vendor($id,$search='', $sort='', $page='', $per_page='',$is_page=FALSE){

   		$result = $this->db->select('ms_vendor.name peserta_name,tr_ass_point.point point,ms_vendor.id id_vendor')
   		->where('id_procurement',$id)
   		->join('ms_vendor','ms_vendor.id=tr_ass_point.id_vendor');
		
		if($this->input->get('sort')&&$this->input->get('by')){
			$this->db->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$this->db->limit($per_page, $per_page*($cur_page - 1));
		}

   		$query = $this->db->get('tr_ass_point')->result_array();

		return $query;
   	}

   	function get_procurement_peserta($id,$search='', $sort='', $page='', $per_page='',$is_page=FALSE){

   		$result = $this->db->select('ms_procurement_peserta.id id,ms_vendor.name peserta_name,ms_procurement_peserta.id_vendor id_vendor')->where('ms_procurement_peserta.id_proc',$id)
   		->join('ms_vendor','ms_vendor.id=ms_procurement_peserta.id_vendor')
   		->where('ms_procurement_peserta.del',0);
		
		if($this->input->get('sort')&&$this->input->get('by')){
			$this->db->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$this->db->limit($per_page, $per_page*($cur_page - 1));
		}
   		return $this->db->get('ms_procurement_peserta')->result_array();

   	}
  


	public function get_question_assessment(){
		$result = array();
		$group_ass = $this->db->select('*')->get('ms_ass_group')->result_array();

		
		foreach($group_ass as $key => $value){
			$result[$value['id']]['name'] = $value['name'];
			$assessment = $this->db->select('*')->where('id_group',$value['id'])->get('ms_ass')->result_array();
			
			foreach($assessment as $ass){
				$result[$value['id']]['quest'][] = $ass;
			}
		}

		return $result;
	}
	public function get_assessment($id_pengadaan,$id_vendor){
		$result = array();
		$data_list = $this->db->select('id_ass, value')
		->where(
				array('id_vendor'=>$id_vendor,'id_procurement'=>$id_pengadaan)
				)
		->get('tr_ass_result')->result_array();
		foreach($data_list as $key=>$row){
			$result[$row['id_ass']] = $row['value'];
		}
		return $result;
	}

	public function save_assessment($id, $post){
		$poin = 0;
		foreach($post['ass'] as $key=>$row){
			$this->db->delete('tr_ass_result',array(
				'id_vendor' 		=>$post['id_vendor'],
				'id_procurement' 	=>$post['id_procurement'],
				'id_ass'			=>$key,
			));

			$insert = $this->db->insert('tr_ass_result',array(
				'id_vendor' 		=>$post['id_vendor'],
				'id_procurement' 	=>$post['id_procurement'],
				'id_ass'			=>$key,
				'value'				=>$row,
				'entry_stamp'		=>date("Y-m-d H:i:s")
			));

			if(!$insert){

				return false;

			}

			$poin += $row;

			
		}
		$this->db->delete('tr_ass_point',array(
				'id_vendor' 		=>$post['id_vendor'],
				'id_procurement' 	=>$post['id_procurement']
			));
		$this->db->insert('tr_ass_point',array('id_vendor'=>$post['id_vendor'],'id_procurement'=>$post['id_procurement'],'point'=>$poin,'entry_stamp'=>date("Y-m-d H:i:s")));
		
		return $poin;
	}

}