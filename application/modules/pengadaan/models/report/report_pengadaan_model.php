<?php
class Report_pengadaan_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function get_header($id_lelang = ''){
		$sql = "SELECT a.*,
					   b.name budget_holder,
					   g.name budget_spender,
					   c.name AS nama_spender,
					   d.name AS nama_pejabat,
					   h.name AS mekanisme,
					   f.symbol AS kurs_symbol
					   
				FROM ms_procurement a 
				
				LEFT JOIN tb_budget_holder b ON a.budget_holder = b.id
				LEFT JOIN tb_budget_spender c ON a.budget_spender = c.id
				LEFT JOIN tb_pejabat_pengadaan d ON a.id_pejabat_pengadaan = d.id
				-- LEFT JOIN ms_area_sbu e ON a.id_lokasi = e.id
				LEFT JOIN tb_kurs f ON a.id_kurs = f.id
				LEFT JOIN tb_budget_holder g ON a.budget_holder = g.id
				LEFT JOIN tb_mekanisme h ON a.id_mekanisme = h.id
				WHERE a.id = ? ";
		
		$sql = $this->db->query($sql, $id_lelang);
		return $sql->row_array();
	}

	function get_bsb($id_lelang = ''){
		$sql = "SELECT a.*,
					   b.name bidang,
					   c.name sub_bidang
					   
				FROM ms_procurement_bsb a
				LEFT JOIN tb_bidang b ON a.id_bidang = b.id 
				LEFT JOIN tb_sub_bidang c ON a.id_sub_bidang = c.id 
				
				WHERE id_proc = ?";
		
		return $sql = $this->db->query($sql, $id_lelang);
	}
	function get_pemenang($id_lelang = ''){
		$sql = "SELECT a.*,
				b.name name,
				c.symbol kurs
					   
				FROM ms_procurement_peserta a

				LEFT JOIN ms_vendor b ON a.id_vendor = b.id 
				LEFT JOIN tb_kurs c ON a.id_kurs = c.id

				WHERE id_proc = ? AND is_winner = 1";
		
		return $sql = $this->db->query($sql, $id_lelang);
	}
	function get_assessment($id_lelang = '',$id_vendor = ''){
		$sql = "SELECT a.*
					   
				FROM tr_ass_point a

				WHERE id_procurement = ? AND id_vendor = ? ";
		
		return $sql = $this->db->query($sql, array($id_lelang,$id_vendor));
	}
	function get_kontrak($id_lelang = ''){
		$sql = "SELECT a.*,
				b.name name,
				c.symbol kurs_symbol
				
					   
				FROM ms_contract a

				LEFT JOIN ms_vendor b ON a.id_vendor = b.id 
				LEFT JOIN tb_kurs c ON a.contract_kurs = c.id

				WHERE id_procurement = ? ";
		
		return $sql = $this->db->query($sql, $id_lelang);
	}

	function get_kurs($id_lelang = ''){
		$sql = "SELECT b.name FROM ms_procurement_kurs a LEFT JOIN tb_kurs b ON a.id_kurs = b.id WHERE a.id_procurement = ?";
		return $sql = $this->db->query($sql, $id_lelang);
	}
	
	function get_peserta($id_lelang = ''){
		$sql = "SELECT a.*,
					   b.name
					   
				FROM ms_procurement_peserta a
				LEFT JOIN ms_vendor b ON a.id_vendor = b.id 
				
				WHERE id_proc = ?";
		
		return $sql = $this->db->query($sql, $id_lelang);
	}
	
	function get_progress_pengadaan($id){
   		$query = $this->db->select('tb_progress_pengadaan.value step, tr_progress_pengadaan.value value')->where('id_proc',$id)->join('tb_progress_pengadaan','tb_progress_pengadaan.id = tr_progress_pengadaan.id_progress')->get('tr_progress_pengadaan')->result_array();
   		$return = array();
   		foreach ($query as $key => $value) {
   			$return[$value['step']] = $value['value'];
   		}
   		return $return;
   	}
}