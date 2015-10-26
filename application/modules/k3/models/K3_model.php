<?php defined('BASEPATH') OR exit('No direct script access allowed');

class K3_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->header = array(
								'question',
								'entry_stamp',
							);
		$this->sub_quest = array(
								'id_header',
								'question',
								'entry_stamp',
							);
		$this->group_quest = array(
								'id_ms_header',
								'id_sub_header',
								'id_evaluasi',
								'entry_stamp',
							);
		$this->pertanyaan = array(
								'id_question',
								'type',
								'value',
								'label',
								'entry_stamp',
							);
	}


	function get_master_header(){
		$result = array();
		$res = $this->db->where('del',0)->get('tb_ms_quest_k3')->result_array();
		foreach($res as $key_sub => $value_sub){
			$result[$value_sub['id']] = $value_sub['question'];
		}
		return $result;
	}
	function get_sub_header(){
		$result = array();
		$res = $this->db->where('del',0)->get('tb_sub_quest_k3')->result_array();
		foreach($res as $key_sub => $value_sub){
			$result[$value_sub['id']] = $value_sub;
		}
		return $result;
	}
	function get_quest(){
		$res = $this->db->where('del',0)->get('tb_quest')->result_array();
		$result = array();

		foreach($res as $key =>$row){
			$quest = $this->db->select('*')->where('id_question',$row['id'])->get('ms_answer_hse')->result_array();
			foreach($quest as $id => $quest){
				$result[$row['id_ms_header']][$row['id_sub_header']][$row['id']][$quest['id']] = $quest;
			}
		}


		return $result;
	}
	function get_field_quest(){
		$quest = $this->db->select('*,ms_answer_hse.id id,')->where('ms_answer_hse.del',0)->where('tb_quest.del',0)->join('tb_quest','tb_quest.id=ms_answer_hse.id_question')->get('ms_answer_hse')->result_array();
		foreach($quest as $id => $quest){
			$result[$quest['id']] = $quest;
		}
		
		return $result;
	}
	function get_k3_data($id_vendor){
		$get = $this->db->where('id_vendor',$id_vendor)->get('tr_answer_hse')->result_array();
		$result = array();
		foreach ($get as $key => $value) {
			$result[$value['id_answer']] = $value;
		}

		return $result;
	}
	public function get_csms($id_vendor){
		return $this->db->where('id_vendor',$id_vendor)->get('ms_csms')->row_array();
	}
	function get_k3_all_data($id){
		$result = array();
		if(!empty($this->get_csms($id))){
			$result['csms_file'] = $this->get_csms($id);
		}
		if(!empty($this->get_k3_data($id))){
			$result['answer'] = $this->get_k3_data($id);
		}
		return $result;
	}
	function get_penilaian_value($id_vendor){
		$get = $this->db->select('id_evaluasi,poin')->where('id_vendor',$id_vendor)->get('tr_evaluasi_poin')->result_array();
		$result = array();
		foreach ($get as $key => $value) {
			$result[$value['id_evaluasi']] = $value['poin'];
		}

		return $result;
	}
	function save_k3_data($post,$id_user){
		$this->db->delete('tr_answer_hse',array('id_vendor'=>$id_user,''));
		foreach($post as $id_question => $data){
			$res = $this->db->insert('tr_answer_hse',array('id_answer'=>$id_question,'value'=>$data,'id_vendor'=>$id_user));
			if(!$res){
				return false;
			}
		}
	}
	function update_k3_data($post,$id_user){
		foreach($post as $id_question => $data){
			$nr = $this->db->select('*')->where(array('id_answer'=>$id_question,'id_vendor'=>$id_user))->get('tr_answer_hse')->num_rows();
			if($nr>0){
				$res = $this->db->where(array('id_answer'=>$id_question,'id_vendor'=>$id_user))->update('tr_answer_hse',array('value'=>$data));
			}else{
				$res = $this->db->insert('tr_answer_hse',array('id_answer'=>$id_question,'value'=>$data,'id_vendor'=>$id_user));
			}
			// echo $this->db->last_query();
		}
		return $res;
	}
	function save_csms_data($post,$id){
		$res = $this->db->insert('ms_csms',array(
										'id_vendor'=>$id,
										'expiry_date'=>$post['expiry_date'],
										'csms_file'=>$post['csms_file'],
										'entry_stamp'=>$post['entry_stamp']	
										)
						);
		return $res;
	}
	// function save_hse_data($post,$id){
	// 	$res = $this->db->insert('ms_hse',array(
	// 									'id_vendor'=>$id,
	// 									'hse_file'=>$post['hse_file'],
	// 									'entry_stamp'=>$post['entry_stamp']
	// 									)
	// 						);
	// 	return $res;
	// }
	function get_k3_vendor($search='', $sort='', $page='', $per_page='',$is_page=FALSE){
	
		$this->db->select('ms_vendor.id as id ,ms_vendor.name name, mva.npwp_code npwp_code,mva.nppkp_code nppkp_code')
		->where('ms_vendor.vendor_status',1)
		->join('ms_vendor_admistrasi as mva','mva.id_vendor=ms_vendor.id','LEFT')
		->group_by('id');
		// if(isset($_POST['filter'])){
		// 	foreach($_POST['filter'] as $key => $row){
		// 		$field = explode('|',$key);
		// 		foreach($row as $value){
		// 			if($value!=''){
		// 				if($field[1] =='start_date'){
		// 					$this->db->where('`'.$field[0].'`.`'.$field[1].'` > "'.$value.'"',NULL,FALSE);
		// 				}elseif($field[1] =='end_date'){
		// 					$this->db->where('`'.$field[0].'`.`start_date` < "'.$value.'"',NULL,FALSE);
		// 				}
		// 				else{
		// 					$this->db->like($field[0].'.'.$field[1],$value,'both');
		// 					if(isset($field[2])){
		// 						$this->db->where($field[0].'.type',$field[2]);
		// 					}
		// 				}
		// 				$this->db->group_by(`'.$field[0].'`.`'.$field[1].'`);
		// 			}
		// 		}
				
		// 	}
		// }

		if($this->input->get('sort')&&$this->input->get('by')){
			$this->db->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$this->db->limit($per_page, $per_page*($cur_page - 1));
		}

		$query = $this->db->get('ms_vendor');
		// echo $this->db->last_query();
		return $query->result_array();
	}
	function get_evaluasi_list(){
		$result = array();
		$res = $this->db->get('tb_evaluasi')->result_array();
		foreach($res as $key_sub => $value_sub){
			$result[$value_sub['id']] = $value_sub;
		}
		return $result;
	}
	function get_evaluasi_edit($id){
		$result = $this->db ->select('tb_sub_quest_k3.question as sub_quest, tb_ms_quest_k3.question as quest, tb_evaluasi.id as id_evaluasi, tb_ms_quest_k3.id as id_ms_quest, tb_sub_quest_k3.id as id_sub_quest')
							->where('tb_quest.id',$id)
							->join('tb_ms_quest_k3', 'tb_ms_quest_k3.id = tb_quest.id_ms_header')
							->join('tb_sub_quest_k3', 'tb_sub_quest_k3.id = tb_quest.id_sub_header')
							->join('tb_evaluasi', 'tb_evaluasi.id = tb_quest.id_evaluasi')
							->get('tb_quest')->result_array();
    	
    	return $result;
	}
	function get_evaluasi_data_list(){
		$get = $this->db->where('del',0)->select('id,name')->get('tb_evaluasi');
		$raw = $get->result_array();
		$res = array();
		$res[''] = 'Pilih Evaluasi Untuk Penilaian';
		foreach($raw as $key => $val){
			$res[$val['id']] = $val['name'];
		}
		return $res;
	}
	function get_evaluasi(){
		$result = array();
		
		foreach($this->get_master_header() as $key_ms => $value_ms){

			$evaluasi = $this->db->where('id_ms_quest',$key_ms)->get('tb_evaluasi')->result_array();
			foreach($evaluasi as $key_ev => $data_ev){

				$quests = $this->db->where('id_evaluasi',$data_ev['id'])->get('tb_quest')->result_array();
				// echo print_r($evaluasi);
				foreach($quests as $key_quest => $quest){

					$answer = $this->db->where('id_question',$quest['id'])->get('ms_answer_hse')->result_array();
					$result[$quest['id_ms_header']][$quest['id_evaluasi']][$quest['id']] = $answer;
				}

			}
		}
		// echo print_r($result);
		return $result;
		
	}
	function save_evaluasi_poin($post, $id){
		$base_total = array();
		$vendor_id = $id;
		$this->db->delete('tr_evaluasi_poin',array('id_vendor'=>$id));
		foreach($post as $key => $row){
			$res = $this->db->insert('tr_evaluasi_poin',array(
									'id_evaluasi'=>$key,
									'poin'=>$row,
									'id_vendor'=>$id,
									'entry_stamp'=>date('Y-m-d H:i:s')
									)
					);
			$base_total[$this->get_evaluasi_list()[$key]['id_ms_quest']][] = $row;
			if(!$res){
				return false;
			}
		}
		$sum_value = 0;

		foreach($base_total as $id => $evaluasi){
			$total_row = count($evaluasi);
			$total_value = 0;
			foreach($evaluasi as $value){
				$total_value += $value;
			}

			$sum_value +=($total_value/$total_row);
		}

		$nr = $this->db->select('*')->where(array('id_vendor'=>$vendor_id))->get('ms_score_k3')->num_rows();
		$id_csms_limit = $this->get_k3_limit($sum_value);
		// print_r($id_csms_limit);
		if($nr>0){
			$res = $this->db->where('id_vendor',$vendor_id)->update('ms_score_k3',array(
									'score'=>$sum_value,
									'id_csms_limit'=>$id_csms_limit,
									'edit_stamp'=>date('Y-m-d H:i:s')
									));
		}else{
			$res = $this->db->insert('ms_score_k3',array(
									'score'=>$sum_value,
									'data_status'=>0,
									'id_vendor'=>$vendor_id,
									'id_csms_limit'=>$id_csms_limit,
									'entry_stamp'=>date('Y-m-d H:i:s')
									));
		}
		
		
		// echo $this->db->last_query();
		return true;
	}
	public function get_k3_limit($poin){
		$query = 	$this->db->select('id')
					->where('start_score <=',$poin)
					->where('end_score >=',$poin)
					->get('tb_csms_limit')->row_array();
		return $query['id'];
	}
	public function get_csms_limit(){
		$query = 	$this->db->get('tb_csms_limit')->result_array();
		$data = array();
		foreach($query as $key => $value){
			$data[$value['id']] = $value['value'];
		}
		return $data;
	}
	public function get_poin($vendor_id){
		return $this->db->select('*')->where(array('id_vendor'=>$vendor_id))->get('ms_score_k3')->row_array();

	}
	public function get_hse($id_vendor){
		return  $this->db->where('id_vendor',$id_vendor)->get('ms_hse')->row_array();

	}



	###################################################
	###################################################
	/*function get_data_ms_quest_k3_list(){
		$ms_quest = $this->db->select('id, question')->where('del',0)->get('tb_ms_quest_k3')->result_array();

		#get sub header for the question
		foreach($ms_quest as $key => $value){

			$sub_quest 			 = $this->db->select('*')
											->where('del',0)
											->where('id_header',$value['id'])
											->get('tb_sub_quest_k3')
											->result_array();
			$ms_quest[$key]['sub_quest']	= $sub_quest;

			#get the number list of question
			foreach ($sub_quest as $keyqno => $valueqno){
				$quest_no 		 = $this->db->select('*')
											->where('id_sub_header',$valueqno['id'])
											->get('tb_quest')
											->result_array();
				$ms_quest[$key]['sub_quest'][$keyqno]['quest_no'] = $quest_no;
		

				#get the detail question for each list number

				foreach ($quest_no as $keyq => $valueq){
					$data_quest 	 = $this->db->select('*')
												->where('ms_answer_hse.del',0)
												->where('id_question',$valueq['id'])
												->join('tb_quest','tb_quest.id=ms_answer_hse.id_question')
												->get('ms_answer_hse')
												->result_array();
					$ms_quest[$key]['sub_quest'][$keyqno]['quest_no'][$keyq]['data_quest'] = $data_quest;
				}

			}
		}
		$akhir = 
		return $ms_quest;
    }*/

    function get_header_list(){
		$result 	= array();
		$ms_quest 	= $this->db->where('del',0)->get('tb_ms_quest_k3')->result_array();
		foreach($ms_quest as $key => $value){
			$result[$value['id']] = $value['question'];
		}
		return $result;
	}

	function get_header($id){
		$result = $this->db->select('*')->where('id',$id)->get('tb_ms_quest_k3')->result_array();
    	$arr = array();
    	foreach($result as $key => $val){
    		$arr[$val['id']] = $val['question'];
    	}
    	return $arr;
	}

	function get_header_dropdown($id){
		$get = $this->db->where('del',0)->select('id,question')->get('tb_ms_quest_k3');
		$raw = $get->result_array();
		$res = array();
		$res[''] = 'Pilih salah satu';
		foreach($raw as $key => $val){
			$res[$val['id']] = $val['question'];
		}
		return $res;
	}

	function get_sub_header_dropdown($id){
		$get = $this->db->where('del',0)->select('id,question')->get('tb_sub_quest_k3');
		$raw = $get->result_array();
		$res = array();
		$res[''] = 'Pilih salah satu';
		foreach($raw as $key => $val){
			$res[$val['id']] = $val['question'];
		}
		return $res;
	}


	function get_quest_edit($id){
		$result = $this->db->select('*')->where('id',$id)->get('tb_quest')->result_array();
    	
    	return $result;
	}

	function save_edit_header($data, $id){
    	$this->db->where('id',$id);
		$res = $this->db->update('tb_ms_quest_k3',$data);
		
		return $res;
    }

    function save_edit_sub_quest($data, $id){
    	$this->db->where('id',$id);
		$res = $this->db->update('tb_sub_quest_k3',$data);
		
		return $res;
    }

    function save_edit_quest($data, $id){
    	$this->db->where('id',$id);
		$res = $this->db->update('ms_answer_hse',$data);
		
		return $res;
    }

    function save_edit_group($data, $id){
    	$this->db->where('id',$id);
		$res = $this->db->update('tb_quest',$data);
		
		return $res;
    }




	function get_sub_quest_list(){
		$result 	= array();
		$sub_quest 	= $this->db->select('id,id_header,question,')->where('del',0)->get('tb_sub_quest_k3')->result_array();
		foreach($sub_quest as $keysq => $valuesq){
			$result[$valuesq['id_header']][$valuesq['id']] = $valuesq;
		}
		return $result;
	}

	function get_edit_sub_quest($id){
		$result = $this->db->select('*')->where('id',$id)->where('del',0)->get('tb_sub_quest_k3')->result_array();
    	$arr = array();
    	foreach($result as $key => $val){
    		$arr[$val['id']] = $val['question'];
    	}
    	return $arr;
	}

	function get_edit_quest($id){
		/*$result = $this->db->select('*')->where('id_question',$id)->get('ms_answer_hse')->result_array();
    	$arr = array();
    	foreach($result as $key => $val){
    		$arr[$val['id']] = $val['value'];
    	}
    	return $arr;*/
		$result = $this->db->select('*')->where('id',$id)->get('ms_answer_hse')->result_array();
    	return $result;
	}

	function get_quest_list(){
		$res = $this->db->select('id,id_ms_header,id_sub_header')->where('del',0)->get('tb_quest')->result_array();
		$result = array();

		foreach($res as $key =>$row){
			$result [$row['id']] = $row;
		}
		return $result;
	}

	function get_data_field(){
		$quest = $this->db->select('*,ms_answer_hse.id id,')->where('tb_quest.del',0)->where('ms_answer_hse.del',0)->join('tb_quest','tb_quest.id=ms_answer_hse.id_question')->get('ms_answer_hse')->result_array();
		foreach($quest as $id => $quest){
			$result[$quest['id']] = $quest;
		}		
		return $result;
	}




	function hapus_header($id){
		$this->db->where('id',$id);
		
		return $this->db->update('tb_ms_quest_k3',array('del'=>1));
	}

	function hapus_sub_quest($id){
		$this->db->where('id',$id);
		
		return $this->db->update('tb_sub_quest_k3',array('del'=>1));
	}

	function hapus_quest($id){
		$this->db->where('id',$id);
		
		return $this->db->update('ms_answer_hse',array('del'=>1));
	}


	function save_header($data){
		$_param = array();
		
		$sql = "INSERT INTO tb_ms_quest_k3 (
							`question`,
							`entry_stamp`
							) 
				VALUES (?,?) ";
		
		
		foreach($this->header as $_param) $param[$_param] = $data[$_param];
		
		return $this->db->query($sql, $param);
		
	}

	function save_sub_quest($data){
		$_param = array();
		
		$sql = "INSERT INTO tb_sub_quest_k3 (
							`id_header`,
							`question`,
							`entry_stamp`
							) 
				VALUES (?,?,?) ";
		
		
		foreach($this->sub_quest as $_param) $param[$_param] = $data[$_param];
		
		return $this->db->query($sql, $param);
		
	}
	function save_quest($data){
		$_param = array();
		
		$sql = "INSERT INTO ms_answer_hse (
							`id_question`,
							`type`,
							`value`,
							`label`,
							`entry_stamp`
							) 
				VALUES (?,?,?,?,?) ";
		
		
		foreach($this->pertanyaan as $_param) $param[$_param] = $data[$_param];
		
		return $this->db->query($sql, $param);
		
	}
	function save_group_quest($data){
		$_param = array();
		$sql = "INSERT INTO tb_quest (
							`id_ms_header`,
							`id_sub_header`,
							`id_evaluasi`,
							`entry_stamp`
							) 
				VALUES (?,?,?,?) ";
		
		
		foreach($this->group_quest as $_param) $param[$_param] = $data[$_param];
		
		return $this->db->query($sql, $param);
	}

	function hapus_group_quest($id){
		$this->db->where('id',$id);
		
		return $this->db->update('tb_quest',array('del'=>1));
	}
}