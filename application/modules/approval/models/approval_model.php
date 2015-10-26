<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model{

	function __construct(){
		parent::__construct();

	}

	function administrasi(){
		
		$this->db->where('id',$id);
		
		return $this->db->update('ms_vendor_admistrasi',array('del'=>1));
	
	}
	function get_dpt_type(){
		$query = $this->db->get('tb_dpt_type');
		$res   =  $query->result_array();
		$result = array();
		foreach($res as $key => $row){
			$result[$row['id']] = $row['name'];
		}

		return $result;
	}
	function get_total_data($id){
		$table = array('ms_akta'=>'Akta','ms_situ'=>'SITU/Domisili','ms_tdp'=>'TDP','ms_pengurus'=>'Pengurus','ms_pemilik'=>'Kepemilikan Saham','ms_ijin_usaha'=>'Izin Usaha','ms_agen'=>'Pabrikan/Keagenan/Distributor','ms_pengalaman'=>'Pengalaman','ms_agen_produk'=>'Produk','ms_score_k3'=>'K3');
		$result = array(0=>array(),1=>array(),2=>array(),3=>array(),4=>array());
		$total=0;

		$adm = $this->db->select('data_status')->where('id_vendor',$id)->get('ms_vendor_admistrasi')->row_array();
		$result[$adm['data_status']][] = 'Data Administrasi Vendor';
		$total+=1;
		foreach($table as $field=>$label){
			if($field !='ms_agen_produk'){
				$this->db->select('data_status');
			}else{
				$this->db->select('ms_agen_produk.data_status data_status');
			}
			$this->db->where('id_vendor',$id);
			$this->db->where($field.'.del',0);
			if($field =='ms_agen_produk'){
				$this->db->join('ms_agen','ms_agen.id=ms_agen_produk.id_agen');
			}
			
			$res = $this->db->get($field)->result_array();

			foreach($res as $key=>$data){
				$result[(($data['data_status']==NULL)?0:$data['data_status'])][] = $table[$field];
				$total+=1;
			}
		}
		// echo $this->db->last_query()
		$result['total'] = $total;
		return $result;
	}
	function angkat_vendor($id){
		$this->db->where('id',$id);
		$update_status = $this->db->update('ms_vendor',array('vendor_status'=>2));
		
		$dpt_list = $this->db->select('*')->where('id_vendor',$id)->where('data_status',1)->get('ms_ijin_usaha')->result_array();
		foreach($dpt_list as $key => $row){
			$this->db->where('id_vendor',$row['id_vendor']);
			$this->db->where('id_dpt_type',$row['id_dpt_type']);
			$update_status = $this->db->update('tr_dpt',array(
					'start_date'=>$_POST['start_date'],
					'status'	=>1
				)
			);
			echo $this->db->last_query();
		}
		
	}
}