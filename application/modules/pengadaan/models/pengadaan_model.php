<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->field_master = array(
								'name',
								'budget_source',
								'id_pejabat_pengadaan',
								'budget_year',
								'budget_holder',
								'budget_spender',
								'id_mekanisme',
								'entry_stamp',
								'evaluation_method',
								'idr_value',
								'kurs_value',
								'id_kurs'
							);
		$this->field_contract = array(
							'id_procurement',
							'id_vendor',
							'no_sppbj',
							'sppbj_date',
							'no_spmk',
							'spmk_date',
							'start_work',
							'end_work',
							'no_contract',
							'po_file',
							'contract_price',
							'contract_price_kurs',
							'contract_kurs',
							'start_contract',
							'end_contract',
							'entry_stamp'
							);

		$this->bsb = array('id_proc',
							'id_bidang',
							'id_sub_bidang',
							'entry_stamp');
		$this->peserta = array('id_proc',
							'id_vendor',
							'surat',
							'id_surat',
							// 'id_kurs',
							// 'kurs_value',
							// 'idr_value',
							'entry_stamp');

		$this->progress = array('id_contract',
							'step_name',
							'supposed',
							'realization',
							'entry_stamp');
	}
	function get_pengadaan_list($search='', $sort='', $page='', $per_page='',$is_page=FALSE) 
    {
    	$user = $this->session->userdata('user');
		$this->db->select('*, ms_procurement.id id, ms_procurement.name name, ms_vendor.name pemenang, "-" as pemenang_kontrak , "-" as user_kontrak , proc_date, ms_procurement.del del');
		$this->db->group_by('ms_procurement.id');
		$this->db->where('ms_procurement.del',0);
		$this->db->where('ms_procurement.id_mekanisme!=',1);
		$this->db->order_by('ms_procurement.id','DESC');
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

   	function save_data($data){
   		$_param = array();
		$sql = "INSERT INTO ms_procurement (
								`name`,
								`budget_source`,
								`id_pejabat_pengadaan`,
								`budget_year`,
								`budget_holder`,
								`budget_spender`,
								`id_mekanisme`,
								`entry_stamp`,
								`evaluation_method`,
								`idr_value`,
								`kurs_value`,
								`id_kurs`
								) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ";//`no_bahp`,`bahp_date`,`price_nego`,`nego_kurs`,`price_nego_kurs`,

		foreach($this->field_master as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);
		$id = $this->db->insert_id();
		
		return $id;
   	}

   	function edit_data($data,$id){
		$param = array();
		
		$this->db->where('id',$id);
		$res = $this->db->update('ms_procurement',$data);

		
		return $res;
	}

   	function save_kontrak($data){
   		$_param = array();
		$sql = "INSERT INTO ms_contract (
								`id_procurement`,
								`id_vendor`,
								`no_sppbj`,
								`sppbj_date`,
								`no_spmk`,
								`spmk_date`,
								`start_work`,
								`end_work`,
								`no_contract`,
								`po_file`,
								`contract_price`,
								`contract_price_kurs`,
								`contract_kurs`,
								`start_contract`,
								`end_contract`,
								`entry_stamp`
								) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

		foreach($this->field_contract as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);
		$this->db->where('id',$data['id_procurement'])->update('ms_procurement',array('status_procurement'=>2));
		$id = $this->db->insert_id();
		
		return $id;
   	}

   	function edit_kontrak($data,$id){
		$param = array();
		
		$this->db->where('id_procurement',$id);
		$res = $this->db->update('ms_contract',$data);

		
		return $res;
	}

   	function get_pengadaan($id){
   		$arr = $this->db->select('*,ms_procurement.name name, tb_budget_holder.name budget_holder_name, tb_budget_spender.name budget_spender_name, tb_pejabat_pengadaan.name pejabat_pengadaan_name,tb_mekanisme.name mekanisme_name,evaluation_method,symbol kurs_symbol,idr_value,kurs_value')
   		->where('ms_procurement.id',$id)
   		->join('tb_pejabat_pengadaan','tb_pejabat_pengadaan.id=ms_procurement.id_pejabat_pengadaan','LEFT')
		->join('tb_budget_holder','tb_budget_holder.id=ms_procurement.budget_holder','LEFT')
		->join('tb_budget_spender','tb_budget_spender.id=ms_procurement.budget_spender','LEFT')
		->join('tb_mekanisme','tb_mekanisme.id=ms_procurement.id_mekanisme','LEFT')
		->join('tb_kurs','tb_kurs.id=ms_procurement.id_kurs','LEFT')
   		->get('ms_procurement')->row_array();
		
		return $arr;
   	}

   	function get_progress_pengadaan($id){
   		$query = $this->db->where('id_proc',$id)->get('tr_progress_pengadaan')->result_array();
   		$return = array();
   		foreach ($query as $key => $value) {
   			$return[$value['id_progress']] = $value['value'];
   		}
   		return $return;
   	}

   	function get_paket_progress($id){
   		$query = $this->db->where('id_proc',$id)->where('tr_progress_pengadaan.value',1)->join('tb_progress_pengadaan','tb_progress_pengadaan.id=tr_progress_pengadaan.id_progress')->get('tr_progress_pengadaan')->result_array();
   		return $query;
   	}

   	function save_progress_pengadaan($id){
   		foreach($this->input->post('pengadaan') as $key => $value){
   			$check = $this->db->where('id_proc',$id)->where('id_progress',$key)->get('tr_progress_pengadaan')->num_rows();
   			if($check>0){
   				$res = $this->db->where('id_proc',$id)->where('id_progress',$key)->update('tr_progress_pengadaan',array('value'=>$value));
   				if(!$res) return false;

   			}else{
   				$res = $this->db->insert('tr_progress_pengadaan',array(
																	'value'=>$value,
																	'id_proc'=>$id,
																	'id_progress'=>$key
																));
   				if(!$res) return false;
   			}
   		}
   		return true;
   	}



   	function get_pengadaan_step(){
   		$query 	= $this->db->get('tb_progress_pengadaan')->result_array();
   		$result = array();
   		foreach($query as $value){
   			$result[$value['id']] = $value['value'];
   		}
   		return $result;
   	}

   	function get_contract_progress($id){
   		$arr = $this->db->select('*')->where('id_contract',$id)->get('tr_progress_kontrak')->result_array();
   		return $arr;
   	}

   	function tambah_progress($id,$data){
   		$contract = $this->get_kontrak($id);
   		$contract_length = ceil((abs(strtotime($contract['end_work'])-strtotime($contract['start_work']))+1)/86400) ;

   		$arr = $this->db->select('supposed,realization')->where('id_contract',$contract['id'])->get('tr_progress_kontrak')->result_array();
   		
   		$total_day = 0;
   		foreach($arr as $key => $value){
   			$total_day += $value['supposed'];
   		}
   		
   		if(($this->input->post('supposed')+$total_day)>$contract_length){
   			$this->session->set_flashdata('msgSuccess','<p class="errorMsg">Tanggal yang ditentukan tidak boleh melebihi tanggal pada kontrak</p>');
   			return false;
   		}else{
   			if(($this->input->post('supposed')+$total_day)==$contract_length){
   				$this->db->where('id',$id);
				$this->db->update('ms_procurement',array('status_procurement'=>2));
   			}
   			$_param = array();
			$sql = "INSERT INTO tr_progress_kontrak (
									`id_contract`,
									`step_name`,
									`supposed`,
									`realization`,
									`entry_stamp`
									) 
					VALUES (?,?,?,?,?) ";

			foreach($this->progress as $_param) $param[$_param] = $data[$_param];
			
			$this->db->query($sql, $param);
			$id = $this->db->insert_id();
			if($id){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Tambah progress berhasil</p>');
				return $id;
			}else{
				$this->session->set_flashdata('msgSuccess','<p class="errorMsg">Gagal Menambahkan Data</p>');
				return false;
			}
   		}
   	}
   	function get_graph($id){
   		$data = $this->get_contract_progress($id);
   	
   		$result = array();
   		$total_supposed = $total_realization = 0;
   		$color 			= $this->config->item('color');
   		$basecolor 		= $this->config->item('basecolor');
   		

   		$row = 0;
   		foreach( $data as $key => $val){
   			$result['supposed']['data'][$val['id']] = $val['supposed'];
   			$result['supposed']['value'][$val['id']] = $val['step_name'].'( '.$val['supposed'].' Hari )';

   			$result['realization']['data'][$val['id']] = $val['realization'];
   			$result['realization']['value'][$val['id']] = $val['step_name'].'( '.$val['realization'].' Hari )';
   			$total_supposed+= $val['supposed'];
   			$total_realization+= $val['realization'];
   			$row++;
   		}

   		$result['supposed']['total'] = $total_supposed;
   		$result['realization']['total'] = $total_realization;

   		$result['max'] = ($total_supposed>$total_realization)?$total_supposed:$total_realization;
   		
   		return $result;

   	}
   	function get_kontrak($id){
   		$arr = $this->db->select('*,ms_contract.id id,tb_legal.name legal_name, ms_vendor.name vendor_name, tb_kurs.symbol kurs_name')
		->join('ms_vendor','ms_vendor.id=ms_contract.id_vendor')
   		->join('ms_vendor_admistrasi','ms_vendor.id=ms_vendor_admistrasi.id_vendor','LEFT')
   		->join('tb_legal','ms_vendor_admistrasi.id_legal=tb_legal.id','LEFT')
   		->join('tb_kurs','ms_contract.contract_kurs=tb_kurs.id','LEFT')
   		->where('id_procurement',$id)
   		->get('ms_contract')->row_array();
   		// echo $this->db->last_query();
		return $arr;
   	}
   	
   	function get_procurement_bsb($id,$search='', $sort='', $page='', $per_page='',$is_page=FALSE){

   		$result = $this->db->select('ms_procurement_bsb.id, tb_bidang.name bidang_name,tb_sub_bidang.name sub_bidang_name,')->where('ms_procurement_bsb.id_proc',$id)
   		->join('tb_bidang','tb_bidang.id=ms_procurement_bsb.id_bidang')
   		->join('tb_sub_bidang','tb_sub_bidang.id=ms_procurement_bsb.id_sub_bidang')
   		->where('ms_procurement_bsb.del',0);
		
		if($this->input->get('sort')&&$this->input->get('by')){
			$this->db->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$this->db->limit($per_page, $per_page*($cur_page - 1));
		}
   		return $this->db->get('ms_procurement_bsb')->result_array();

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
   	function get_peserta_list($id){

   		$bsb = $this->db->select('id_sub_bidang')->where('id_proc',$id)->get('ms_procurement_bsb')->result_array();
   		$id_sub_bidang = array();
   		foreach($bsb as $key => $val){
   			$id_sub_bidang[] = $val['id_sub_bidang'];
   		}

   		$id_vendor = $this->db->select('ms_vendor.id id, ms_vendor.name name')
   		->join('ms_vendor','ms_vendor.id=ms_iu_bsb.id_vendor','INNER')
   		->join('ms_ijin_usaha','ms_ijin_usaha.id=ms_iu_bsb.id_ijin_usaha','INNER')
   		->where('vendor_status',2)
   		->where_in('id_sub_bidang',$id_sub_bidang)
   		->get('ms_iu_bsb')->result_array();
   		
   		$res = array();
   		foreach($id_vendor as $key => $row){
   			$res[$row['id']] = $row['name'];
   		}

   		return $res;
   	}
   	function get_ijin_list($id,$vendor_id){

   		$id_bsb = array('id_bidang'=>array(),'id_sub_bidang'=>array());
   		foreach($this->get_bsb_procurement($id)->result_array() as $key => $val){
   			$id_bsb['id_bidang'][] = $val['id_bidang'];
   			$id_bsb['id_sub_bidang'][] = $val['id_sub_bidang'];
   		}

   		$id_vendor = $this->db->select('ms_ijin_usaha.id, ms_ijin_usaha.type type')
   		->join('ms_iu_bsb','ms_ijin_usaha.id=ms_iu_bsb.id_ijin_usaha');

   		if(count($id_bsb['id_bidang'])>0){
   			$id_vendor->where_in('id_bidang',$id_bsb['id_bidang']);
   		}

   		if(count($id_bsb['id_sub_bidang'])>0){
   			$id_vendor->where_in('id_sub_bidang',$id_bsb['id_sub_bidang']);
   		}
   		$vendor_list = $id_vendor->where('ms_ijin_usaha.id_vendor',$vendor_id)
   		->get('ms_ijin_usaha')->result_array();
   		

   		$res = array();
   		$name = array('siup'=>'SIUP','ijin_lain'=>'Surat Ijin Usaha Lainnya','asosiasi'=>'Sertifikat Asosiasi/Lainnya','siujk'=>'SIUJK','sbu'=>'SBU');
   		foreach($vendor_list as $key => $row){
   			$res[$row['id'].'|'.$row['type']] = $name[$row['type']];
   		}

   		return $res;
   	}
   	function get_pemenang($id){

   		
   		$id_pemenang = $this->db->select('mpp.id id, mv.name name,id_kurs, nilai_evaluasi, idr_value, tk.symbol kurs_name, kurs_value, is_winner')
   		->join('ms_vendor mv','mv.id=mpp.id_vendor','LEFT')
   		->join('tb_kurs tk','tk.id=mpp.id_kurs','LEFT')
   		->where('mpp.id_proc',$id)
   		->where('mpp.is_winner',1)
   		->where('mpp.del',0)
   		->get('ms_procurement_peserta mpp')->row_array();

   		return $id_pemenang;

   	}
   	function get_pemenang_list($id){
   		
   		$id_pemenang = $this->db->select('ms_procurement_peserta.id id, ms_vendor.name name, is_winner')
   		->join('ms_vendor','ms_vendor.id=ms_procurement_peserta.id_vendor')
   		->where('ms_procurement_peserta.id_proc',$id)
   		->where('ms_procurement_peserta.del',0)
   		->get('ms_procurement_peserta')->result_array();

   		return $id_pemenang;
   	}

   	function save_bsb($data){

		$_param = array();
		$sql = "INSERT INTO ms_procurement_bsb (
							id_proc,
							id_bidang,
							id_sub_bidang,
							entry_stamp
							) 
				VALUES (?,?,?,?) ";
		
		foreach($this->bsb as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);
		$id = $this->db->insert_id();
		
		return $id;
	
	}

	function save_peserta($data){
		$surat = $this->db->select('type')->where('id_vendor',$data['id_vendor'])->where('id',$data['id_surat'])->get('ms_ijin_usaha')->row_array();
		$data['surat'] = $surat['type'];

		$_param = array();
		$sql = "INSERT INTO ms_procurement_peserta (
							`id_proc`,
							`id_vendor`,
							`surat`,
							`id_surat`,
							
							`entry_stamp`
							) 
				VALUES (?,?,?,?,?) ";/*,?,?,?*/
							// -- `id_kurs`,
							// -- `idr_value`,
							// -- `kurs_value`,
		
		
		foreach($this->peserta as $_param) $param[$_param] = $data[$_param];
		
		$this->db->query($sql, $param);
		$id = $this->db->insert_id();
		
		return $id;	
	}

	function proses_pemenang($id,$data){
		$this->db->where('id_proc',$id);
		$this->db->update('ms_procurement_peserta',array('is_winner'=>0));

		$this->db->where('id',$data['pemenang']);
		$res = $this->db->update('ms_procurement_peserta',array(
															'is_winner'		=>1,
															'id_kurs'		=>$data['id_kurs'],
															'idr_value'		=>$data['idr_value'],
															'kurs_value'	=>$data['kurs_value'],
															'nilai_evaluasi'=>$data['nilai_evaluasi']
														));
		return $res;
	}

	function send_proc($id,$data){
		$this->db->where('id',$id);
		$this->db->update('ms_procurement',$data);
		return $this->db->affected_rows();
	}

	function hapus_pengadaan_bsb($id){
		$this->db->where('id',$id);
		
		return $this->db->update('ms_procurement_bsb',array('del'=>1));
	}

	function hapus_pengadaan_peserta($id){
		$this->db->where('id',$id);
		
		return $this->db->update('ms_procurement_peserta',array('del'=>1));
	}
	function get_pejabat(){
		$arr = $this->db->select('id,name')->get('tb_pejabat_pengadaan')->result_array();
		$result = array();
		foreach($arr as $key => $row){
			$result[$row['id']] = $row['name'];
		}
		return $result;
	}
	function get_budget_holder(){
		$arr = $this->db->select('id,name')->get('tb_budget_holder')->result_array();
		$result = array();
		foreach($arr as $key => $row){
			$result[$row['id']] = $row['name'];
		}
		return $result;
	}
	function get_bsb_procurement($id_proc){
		$bsb = $this->db->select('id_bidang, id_sub_bidang')->where('id_proc',$id_proc)->where('del',0)->get('ms_procurement_bsb');

		return $bsb;
	}
	function get_budget_spender(){
		$arr = $this->db->select('id,name')->get('tb_budget_spender')->result_array();
		$result = array();
		foreach($arr as $key => $row){
			$result[$row['id']] = $row['name'];
		}
		return $result;
	}
	function get_mekanisme(){
		$arr = $this->db->select('id,name')->where('id!=',1)->get('tb_mekanisme')->result_array();
		$result = array();
		foreach($arr as $key => $row){
			$result[$row['id']] = $row['name'];
		}
		return $result;
	}
	function get_proc_vendor($id){
		$id_pemenang = $this->db->select('ms_procurement_peserta.id_vendor id, CONCAT( tb_legal.name, " ",ms_vendor.name) name')
   		->join('ms_vendor','ms_vendor.id=ms_procurement_peserta.id_vendor')
   		->join('ms_vendor_admistrasi','ms_vendor_admistrasi.id_vendor=ms_vendor.id')
   		->join('tb_legal','ms_vendor_admistrasi.id_legal=tb_legal.id')
   		->join('ms_procurement','ms_procurement.id=ms_procurement_peserta.id_proc')
   		->where('ms_procurement_peserta.id_proc',$id)
   		// ->where('ms_procurement.status_procurement',1)
   		->where('ms_procurement_peserta.del',0)
   		->get('ms_procurement_peserta')->result_array();
   		$result = array();
   		// echo $this->db->last_query();
   		foreach($id_pemenang as $key => $value){
   			$result[$value['id']]=$value['name'];
   		}
   		return $result;
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


	function query_peserta($id='',$q=''){
		$bsb = $this->get_bsb_procurement($id)->result_array();
		
   		$id_sub_bidang = array();
   		foreach($bsb as $key => $val){
   			$id_sub_bidang[] = $val['id_sub_bidang'];
   		}

   		$peserta = $this->db->select('id_vendor')->where('id_proc',$id)->where('del',0)->get('ms_procurement_peserta')->result_array();

   		$id_peserta = array();

   		foreach($peserta as $key => $val){
   			$id_peserta[] = $val['id_vendor'];
   		}

   		$id_vendor = $this->db->select('ms_vendor.id id, ms_vendor.name as name,ms_vendor.id as id_vendor_list, (SELECT cast(AVG(point) as decimal(6, 2)) FROM tr_ass_point WHERE id_vendor=id_vendor_list) as point,ms_vendor_admistrasi.npwp_code npwp_code,ms_vendor_admistrasi.nppkp_code nppkp_code')
   		->join('ms_vendor','ms_vendor.id=ms_iu_bsb.id_vendor','INNER')
   		->join('ms_ijin_usaha','ms_ijin_usaha.id=ms_iu_bsb.id_ijin_usaha','INNER')
   		->where('vendor_status',2);

   		if(count($bsb)>0){
	   		$id_vendor->where_in('id_sub_bidang',$id_sub_bidang);
	   	}

	   	if(count($id_peserta)>0){
	   		$id_vendor->where_not_in('ms_vendor.id',$id_peserta);
	   	}

   		$id_vendor->like('ms_vendor.name',$q,'both')

   		->order_by('point')
   		->group_by('ms_iu_bsb.id_vendor')
   		->join('ms_vendor_admistrasi','ms_vendor_admistrasi.id_vendor=ms_vendor.id','LEFT');
   		return $this->db;
	}
	function get_pengadaan_vendor($id='', $sort='', $page='', $per_page='',$is_page=FALSE,$filter=array()){
		
   		$this->db = $this->query_peserta($id,$this->input->get('q'));

		$a = $this->form->generate_query($this->db->group_by('id'),$filter);
		
		if($this->input->get('sort')&&$this->input->get('by')){
			$a->order_by($this->input->get('by'), $this->input->get('sort')); 
		}
		if($is_page){
			$cur_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
			$a->limit($per_page, $per_page*($cur_page - 1));
		}
		
		$query = $a->get('ms_iu_bsb');
		// echo $this->db->last_query();
		return $query->result_array();
	}
	function search_kandidat($id){
		$res = null;
		if($this->input->post('term')!=''){
			$this->db = $this->query_peserta($id,$this->input->post('term'));

			$res_q = $this->db->get('ms_iu_bsb')->result_array();
			foreach($res_q as $row){
				$res[$row['id']]['id'] = $row['id'];
				$res[$row['id']]['name'] =$row['name'];
			}

		}
		// echo $this->db->last_query();
		// echo $this->input->post('id').$this->input->post('q');

		echo json_encode($res);
	}
	function tambah_peserta($id,$id_surat){
		$this->db->insert('ms_procurement_peserta',array('id_vendor'=>$id,'id_surat'=>$id_surat));
	}
}