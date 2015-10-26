<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends CI_Controller {

	public $id_pengadaan;
	public $tabNav;

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('admin')){
			redirect(site_url());
		}

		$this->load->model('pengadaan_model','pm');
		
		if ($this->uri->segment(3) === FALSE)
		{
		    $this->id_pengadaan = 0;
		}
		else
		{
		   	$this->id_pengadaan = $this->uri->segment(3);
		}
		$this->tabNav = array(
								'bsb'=>	array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/bsb/'),
										'label' => 'Bidang / Sub-Bidang Pekerjaan'
										),
								'peserta'=>array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/peserta/'),
										'label'	=>'Peserta Pengadaan'
										),
								'pemenang'=>array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/pemenang/'),
										'label'	=>'Pemenang Pengadaan'
										),
								'kontrak'=>array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/kontrak/'),
										'label'	=>'Penandatangan kontrak'
										),
								'progress'=>array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/progress_pengadaan/'),
										'label'	=>'Progress Paket'
										),

							);
		$this->progressNav = array(
								'progress_pengadaan'=>	array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/progress_pengadaan/'),
										'label' => 'Progress Paket Pengadaan'
										),
								'progress_pengerjaan'=>array(
										'url' 	=> site_url('pengadaan/view/'.$this->id_pengadaan.'/progress_pengerjaan/'),
										'label'	=>'Progress Paket Pekerjaan'
										)
							);
	}

	public function index()
	{	
		$this->load->library('form');
		$search = '';
		$page = '';
		$post = $this->input->post();

		$per_page=10;

		$sort = $this->utility->generateSort(array('name', 'pemenang', 'pemenang_kontrak', 'nppkp_code','proc_date','id','contract_date'));
		
		$data['pengadaan_list']=$this->pm->get_pengadaan_list($search, $sort, $page, $per_page,TRUE);

		$data['filter_list'] = $this->form->group_filter_post($this->get_field());

		$data['pagination'] = $this->utility->generate_page('pengadaan',$sort, $per_page, $this->pm->get_pengadaan_list($search, $sort, '','',FALSE));
		$data['sort'] = $sort;

		$layout['content']= $this->load->view('pengadaan/content',$data,TRUE);
		$layout['script']= $this->load->view('pengadaan/content_js',$data,TRUE);
		$layout['script']= $this->load->view('pengadaan/form_filter',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function tambah()
	{
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$vld = 	array(
			array(
				'field'=>'name',
				'label'=>'Nama Paket Pengadaan',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_source',
				'label'=>'Sumber Anggaran',
				'rules'=>'required'
				),
			array(
				'field'=>'idr_value',
				'label'=>'Nilai',
				'rules'=>'callback_check_nilai'
				),
			array(
				'field'=>'kurs_value',
				'label'=>'Nilai',
				'rules'=>'callback_check_nilai'
				),
			array(
				'field'=>'id_kurs',
				'label'=>'Kurs',
				'rules'=>'required'
				),
			
			array(
				'field'=>'budget_year',
				'label'=>'Tahun Anggaran',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_holder',
				'label'=>'Budget Holder',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_spender',
				'label'=>'Pemegang Cost Center',
				'rules'=>'required'
				),
			
			array(
				'field'=>'id_mekanisme',
				'label'=>'Metode Pelelangan',
				'rules'=>'required'
				),
			array(
				'field'=>'evaluation_method',
				'label'=>'Metode Evaluasi',
				'rules'=>''
				),
			);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['entry_stamp'] 	= date("Y-m-d H:i:s");
			$_POST['idr_value'] 	= preg_replace("/[,]/", "", $this->input->post('idr_value'));
			$_POST['kurs_value'] 	= preg_replace("/[,]/", "", $this->input->post('kurs_value'));
			unset($_POST['Simpan']);

			$res = $this->pm->save_data($this->input->post());
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data!</p>');

				redirect(site_url('pengadaan/view/'.$res));
			}
		}
		$data['pejabat_pengadaan'] = $this->pm->get_pejabat();
		$data['budget_holder'] = $this->pm->get_budget_holder();
		$data['budget_spender'] = $this->pm->get_budget_spender();
		$data['id_mekanisme'] = $this->pm->get_mekanisme();

		$layout['content']= $this->load->view('tambah',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function edit($id)
	{
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$vld = 	array(
			array(
				'field'=>'name',
				'label'=>'Nama Paket Pengadaan',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_source',
				'label'=>'Sumber Anggaran',
				'rules'=>'required'
				),
			array(
				'field'=>'idr_value',
				'label'=>'Nilai',
				'rules'=>'callback_check_nilai'
				),
			array(
				'field'=>'kurs_value',
				'label'=>'Nilai',
				'rules'=>'callback_check_nilai'
				),
			array(
				'field'=>'id_kurs',
				'label'=>'Kurs',
				'rules'=>'required'
				),
			
			array(
				'field'=>'budget_year',
				'label'=>'Tahun Anggaran',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_holder',
				'label'=>'Budget Holder',
				'rules'=>'required'
				),
			array(
				'field'=>'budget_spender',
				'label'=>'Pemegang Cost Center',
				'rules'=>'required'
				),
			
			array(
				'field'=>'id_mekanisme',
				'label'=>'Metode Pelelangan',
				'rules'=>'required'
				),
			array(
				'field'=>'evaluation_method',
				'label'=>'Metode Evaluasi',
				'rules'=>''
				),
			);
		
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['edit_stamp'] = date("Y-m-d H:i:s");
			$_POST['idr_value'] 	= preg_replace("/[,]/", "", $this->input->post('idr_value'));
			$_POST['kurs_value'] 	= preg_replace("/[,]/", "", $this->input->post('kurs_value'));
			unset($_POST['Simpan']);

			$res = $this->pm->edit_data($this->input->post(),$id);
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses mengubah data!</p>');

				redirect(site_url('pengadaan/view/'.$id));
			}
		}
		$data = $this->pm->get_pengadaan($id);
		$data['pejabat_pengadaan'] = $this->pm->get_pejabat();
		$data['budget_holder_list'] = $this->pm->get_budget_holder();
		$data['budget_spender_list'] = $this->pm->get_budget_spender();
		$data['id_mekanisme_list'] = $this->pm->get_mekanisme();
		$data['id'] = $id;
		$layout['content']= $this->load->view('edit',$data,TRUE);
		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function view($id,$page='bsb',$opt = null){
		
		$data = $this->pm->get_pengadaan($id);
		$data['id'] = $id;
		$data['table'] = $this->$page($id,$page,$opt);

		$layout['content']= $this->load->view('pengadaan/view',$data,TRUE);
		$layout['script']= $this->load->view('pengadaan/content_js',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$this->session->userdata('admin'),TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function bsb($id,$page){
		$data['sort'] = $this->utility->generateSort(array('bidang_name', 'sub_bidang_name'));
		$data['tabNav'] = $this->tabNav;
		$data['id'] = $id;
		$per_page=10;
		$data['pagination'] = $this->utility->generate_page('pengadaan/view/'.$id.'/'.$page,$data['sort'], $per_page,  $this->pm->get_procurement_bsb($id,'', $data['sort'], '','',FALSE));
		$data['list'] = $this->pm->get_procurement_bsb($id,'', $data['sort'], '','',FALSE);
		return $this->load->view('tab/bsb',$data,TRUE);
	}

	public function tambah_bidang($id){
		$form = ($this->session->userdata('form'))?$this->session->userdata('form'):array();
		
		$fill = $this->securities->clean_input($_POST,'save');
		$item = $vld = $save_data = array();
		$admin = $this->session->userdata('admin');
		$vld = 	array(
					array(
						'field'=>'id_bidang',
						'label'=>'Bidang',
						'rules'=>'required'
					)
				);
		$this->form_validation->set_rules($vld);
		if($this->input->post('next')){
			if($this->form_validation->run()==TRUE){
				
				$this->session->set_userdata('form',array_merge($form,$this->input->post()));
				redirect(site_url('pengadaan/tambah_sub_bidang/'.$id));
			
			}
		}

		$data['id_bidang'] = $this->utility->get_bidang_list();


		$layout['content']= $this->load->view('tab/tambah_bidang',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$admin,TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function tambah_sub_bidang($id){
		$form = ($this->session->userdata('form'))?$this->session->userdata('form'):array();
		
		$fill = $this->securities->clean_input($_POST,'save');
		$item = $vld = $save_data = array();
		$admin = $this->session->userdata('admin');
		

		$vld = 	array(
					array(
						'field'=>'id_sub_bidang',
						'label'=>'Sub Bidang',
						'rules'=>'required'
					)
				);
		$this->form_validation->set_rules($vld);
		if($this->input->post('simpan')){

			if($this->form_validation->run()==TRUE){
				unset($_POST['next']);
				$form['id_proc'] = $id;
				$form['entry_stamp'] = date('Y-m-d H:i:s');

				$this->session->set_userdata('form',array_merge($form,$this->input->post()));
				
				$result = $this->pm->save_bsb($this->session->userdata('form'));
			// 	echo print_r($this->input->post('form'));
				if($result){
					$this->session->unset_userdata('form');
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah data bidang!</p>');
					redirect(site_url('pengadaan/view/'.$id.'/'));
				}
			}
		}elseif($this->input->post('back')){
			unset($_POST['back']);
			$form = $this->session->userdata('form');
			$this->session->set_userdata('form',array_merge($form,$this->input->post()));
			redirect(site_url('pengadaan/tambah_bidang/'.$id));
		}

		$data['id_sub_bidang'] = $this->utility->get_sub_bidang_list($form['id_bidang']);


		$layout['content']= $this->load->view('tab/tambah_sub_bidang',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$admin,TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function hapus_bsb($id,$id_proc){
		if($this->pm->hapus_pengadaan_bsb($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('pengadaan/view/'.$id_proc));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('pengadaan/view/'.$id_proc));
		}
	}

	public function peserta($id){
		$data['sort'] = $this->utility->generateSort(array('peserta_name'));
		
		$page = 'peserta';
		$data['id'] = $id;
		$data['tabNav'] = $this->tabNav;
		
		$data['pagination'] = $this->utility->generate_page('pengadaan/view/'.$id.'/'.$page,$data['sort'], NULL,  $this->pm->get_procurement_peserta($id,NULL, $data['sort'], '','',FALSE));
		$data['list'] = $this->pm->get_procurement_peserta($id,NULL, $data['sort'], '','',FALSE);
		return $this->load->view('tab/peserta',$data,TRUE);
	}
	public function tambah_vendor($id_proc,$id){

		$form['id_proc'] 		= $id_proc;
		$form['id_vendor'] 		= $id;
		$form['entry_stamp'] 	= date('Y-m-d H:i:s');
		$form['id_surat']		= $this->input->post('id_surat');
		$result = $this->pm->save_peserta($form);
		if($result){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah peserta!</p>');
			redirect(site_url('pengadaan/view/'.$id_proc.'/peserta'));
			
		}
	}
	public function tambah_peserta($id){
		$admin = $this->session->userdata('admin');
		$page = '';
		$this->load->library('form');

		$per_page=10;
		$sort = $this->utility->generateSort(array('name','point','npwp_code','nppkp_code','id'));
		
		$data['vendor_list']=$this->pm->get_pengadaan_vendor($id, $sort, $page, $per_page,TRUE);

		$data['pagination'] = $this->utility->generate_page('admin/admin_dpt',$sort, $per_page, $this->pm->get_pengadaan_vendor($id, $sort, '', '',TRUE));
		$data['sort'] = $sort;

		
		$data['id_pengadaan'] = $id;
		$layout['content']= $this->load->view('tab/tambah_peserta',$data,TRUE);
		$layout['script']= $this->load->view('content_js',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$admin,TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}
	public function search_kandidat($id){
		$search = $this->input->get('q');
		$data_vendor = $this->pm->search_kandidat($id);
	}
	public function hapus_peserta($id,$id_proc){
		if($this->pm->hapus_pengadaan_peserta($id)){
			$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menghapus data!</p>');
			redirect(site_url('pengadaan/view/'.$id_proc.'/peserta'));
		}else{
			$this->session->set_flashdata('msgSuccess','<p class="msgError">Gagal menghapus data!</p>');
			redirect(site_url('pengadaan/view/'.$id_proc.'/peserta'));
		}
	}

	public function tambah_ijin_usaha($id){

		$form = ($this->session->userdata('form'))?$this->session->userdata('form'):array();
		
		$fill = $this->securities->clean_input($_POST,'save');
		$item = $vld = $save_data = array();
		$admin = $this->session->userdata('admin');
		

		$vld = 	array(
					array(
						'field'=>'id_surat',
						'label'=>'Izin Usaha',
						'rules'=>'required'
					),array(
						'field'=>'kurs_value',
						'label'=>'Nilai Mata Uang Asing',
						'rules'=>''
					),
					array(
						'field'=>'id_kurs',
						'label'=>'Kurs',
						'rules'=>''
					),
					array(
						'field'=>'idr_value',
						'label'=>'Kurs',
						'rules'=>''
					),
				);
		$this->form_validation->set_rules($vld);
		if($this->input->post('simpan')){
			if($this->form_validation->run()==TRUE){
				unset($_POST['simpan']);
				$form['id_proc'] = $id;
				$dt = explode('|',$_POST['id_surat']);
				$form['id_surat'] = $dt[0];
				$form['idr_value'] = $_POST['idr_value'];
				$form['id_kurs'] = $_POST['id_kurs'];
				$form['kurs_value'] = $_POST['kurs_value'];
				$form['surat'] = $dt[1];
				$form['entry_stamp'] = date('Y-m-d H:i:s');

				$this->session->set_userdata('form',array_merge($form,$this->input->post()));
				
				$result = $this->pm->save_peserta($this->session->userdata('form'));
				if($result){
					$this->session->unset_userdata('form');
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah Peserta!</p>');
					redirect(site_url('pengadaan/view/'.$id.'/peserta'));
				}
			}
		}elseif($this->input->post('back')){
			unset($_POST['back']);
			$form = $this->session->userdata('form');
			$this->session->set_userdata('form',array_merge($form,$this->input->post()));
			redirect(site_url('pengadaan/tambah_peserta/'.$id));
		}

		$data['id_ijin_usaha'] = $this->pm->get_ijin_list($id,$form['id_vendor']);


		$layout['content']= $this->load->view('tab/tambah_ijin_usaha',$data,TRUE);

		$item['header'] = $this->load->view('admin/header',$admin,TRUE);
		$item['content'] = $this->load->view('admin/dashboard',$layout,TRUE);
		$this->load->view('template',$item);
	}

	public function pemenang($id){
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$data['data'] = $this->pm->get_pemenang($id);

		$vld = 	array(
					array(
						'field'=>'pemenang',
						'label'=>'Pemenang',
						'rules'=>'required'
						),
					array(
						'field'=>'idr_value',
						'label'=>'Nilai',
						'rules'=>'callback_check_nilai'
						),
					array(
						'field'=>'kurs_value',
						'label'=>'Nilai',
						'rules'=>'callback_check_nilai'
						),
					array(
						'field'=>'id_kurs',
						'label'=>'Kurs',
						'rules'=>'required'
						),
					array(
						'field'=>'nilai_evaluasi',
						'label'=>'Nilai Evaluasi',
						'rules'=>'required'
						)
				);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['idr_value'] = preg_replace("/[,]/", "", $this->input->post('idr_value'));
			$_POST['kurs_value'] = preg_replace("/[,]/", "", $this->input->post('kurs_value'));
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Simpan']);

			$res = $this->pm->proses_pemenang($id,$this->input->post());
			if($res){
			
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses memilih pemenang!</p>');

				redirect(site_url('pengadaan/view/'.$id.'/pemenang'));
			}
		}
		
		$data['tabNav'] = $this->tabNav;
		$data['id'] = $id;
		$per_page=10;
		$data['list'] = $this->pm->get_pemenang_list($id);
		if(empty($data['data'])){
			$view = $this->load->view('tab/pemenang',$data,TRUE);
		}else{
			$view = $this->load->view('tab/pemenang_view',$data,TRUE);
		}
		return $view;
	}
	public function pemenang_edit($id){
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$data['data'] = $this->pm->get_pemenang($id);

		$vld = 	array(
					array(
						'field'=>'pemenang',
						'label'=>'Pemenang',
						'rules'=>'required'
						),
					array(
						'field'=>'idr_value',
						'label'=>'Nilai',
						'rules'=>'callback_check_nilai'
						),
					array(
						'field'=>'kurs_value',
						'label'=>'Nilai',
						'rules'=>'callback_check_nilai'
						),
					array(
						'field'=>'id_kurs',
						'label'=>'Kurs',
						'rules'=>'required'
						),
					array(
						'field'=>'nilai_evaluasi',
						'label'=>'Nilai Evaluasi',
						'rules'=>'required'
						)
				);
		
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['idr_value'] = preg_replace("/[,]/", "", $this->input->post('idr_value'));
			$_POST['kurs_value'] = preg_replace("/[,]/", "", $this->input->post('kurs_value'));
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Simpan']);

			$res = $this->pm->proses_pemenang($id,$this->input->post());
			if($res){
			
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses memilih pemenang!</p>');

				redirect(site_url('pengadaan/view/'.$id.'/pemenang'));
			}
		}
		
		$data['tabNav'] = $this->tabNav;
		$data['id'] = $id;
		$per_page=10;
		$data['list'] = $this->pm->get_pemenang_list($id);
		
		$view = $this->load->view('tab/pemenang_edit',$data,TRUE);
		
		return $view;
	}
	public function check_nilai($field){
		$idr_field = $this->input->post('idr_value');
		$kurs_field = $this->input->post('kurs_value');
		
		if($idr_field==''&&$kurs_field==''){
			$this->form_validation->set_message('check_nilai','Isi salah satu nilai HPS');
			return false;
		}else{
			return true;
		}
	}

	public function kontrak($id)
	{
		$_POST 					= $this->securities->clean_input($_POST,'save');
		$admin 					= $this->session->userdata('admin');
		$data_kontrak 			= $this->pm->get_kontrak($id);
		$data['tabNav'] 		= $this->tabNav;
		$data['vendor_list'] 	= $this->pm->get_proc_vendor($id);
		
		if(count($data_kontrak)>0){
			$data = $data_kontrak;
			$data['id'] = $id;
			$data['tabNav'] = $this->tabNav;
			return $this->load->view('tab/kontrak_view',$data,TRUE);
		}else{
			$data['vendor_list'] = $this->pm->get_proc_vendor($id);
			$vld = 	array(
				array(
					'field'=>'id_vendor',
					'label'=>'Perusahaan',
					'rules'=>'required'
					),
				array(
					'field'=>'no_sppbj',
					'label'=>'No. SPPBJ',
					'rules'=>'required'
					),
				array(
					'field'=>'sppbj_date',
					'label'=>'Tanggal SPPBJ',
					'rules'=>'required'
					),
				array(
					'field'=>'no_spmk',
					'label'=>'No. SPMK',
					'rules'=>'required'
					),
				array(
					'field'=>'spmk_date',
					'label'=>'Tanggal SPMK',
					'rules'=>'required'
					),
				array(
					'field'=>'start_work',
					'label'=>'Tanggal Mulai Kerja',
					'rules'=>'required'
					),
				array(
					'field'=>'end_work',
					'label'=>'Tanggal Akhir Kerja',
					'rules'=>'required'
					),
				array(
					'field'=>'no_contract',
					'label'=>'No. Kontrak / PO',
					'rules'=>'required'
					),
				array(
					'field'=>'po_file',
					'label'=>'Lampiran Kontrak',
					'rules'=>'callback_do_upload[po_file]'
					),

				array(
					'field'=>'contract_price',
					'label'=>'Nilai Kontrak / PO*',
					'rules'=>'required'
					),
				array(
					'field'=>'contract_kurs',
					'label'=>'Mata Uang',
					'rules'=>'required'
					),
				
				array(
					'field'=>'contract_price_kurs',
					'label'=>'Nilai Kontrak / PO dalam kurs',
					'rules'=>'required'
					),
				array(
					'field'=>'start_contract',
					'label'=>'Tanggal Mulai Kontrak',
					'rules'=>'required'
					),
				array(
					'field'=>'end_contract',
					'label'=>'Tanggal Selesai Kontrak',
					'rules'=>'required'
					)
				);
			
			$this->form_validation->set_rules($vld);
			if($this->form_validation->run()==TRUE){
				$_POST['entry_stamp'] = date("Y-m-d H:i:s");
				$_POST['id_procurement'] = $id;
				$_POST['contract_price'] 	= preg_replace("/[,]/", "", $this->input->post('contract_price'));
				$_POST['contract_price_kurs'] 	= preg_replace("/[,]/", "", $this->input->post('contract_price_kurs'));
				unset($_POST['Simpan']);

				$res = $this->pm->save_kontrak($this->input->post());
				if($res){
					$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses membuat kontrak!</p>');

					redirect(site_url('pengadaan/view/'.$id.'/kontrak'));
				}
			}
			$data['id'] = $id;
			return $this->load->view('tab/kontrak',$data,TRUE);
		}
	}
	public function kontrak_edit($id)
	{
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$data_kontrak = $this->pm->get_kontrak($id);
		$data['data_pemenang'] = $this->pm->get_pemenang($id);
		$data = $data_kontrak;
		$data['tabNav'] = $this->tabNav;
		$data['vendor_list'] = $this->pm->get_proc_vendor($id);
		$vld = 	array(
			array(
				'field'=>'id_vendor',
				'label'=>'Perusahaan',
				'rules'=>'required'
				),
			array(
				'field'=>'no_sppbj',
				'label'=>'No. SPPBJ',
				'rules'=>'required'
				),
			array(
				'field'=>'sppbj_date',
				'label'=>'Tanggal SPPBJ',
				'rules'=>'required'
				),
			array(
				'field'=>'no_spmk',
				'label'=>'No. SPMK',
				'rules'=>'required'
				),
			array(
				'field'=>'spmk_date',
				'label'=>'Tanggal SPMK',
				'rules'=>'required'
				),
			array(
				'field'=>'start_work',
				'label'=>'Tanggal Mulai Kerja',
				'rules'=>'required'
				),
			array(
				'field'=>'end_work',
				'label'=>'Tanggal Akhir Kerja',
				'rules'=>'required'
				),
			array(
				'field'=>'no_contract',
				'label'=>'No. Kontrak / PO',
				'rules'=>'required'
				),

			array(
				'field'=>'contract_price',
				'label'=>'Nilai Kontrak / PO*',
				'rules'=>'required'
				),
			array(
				'field'=>'contract_kurs',
				'label'=>'Mata Uang',
				'rules'=>'required'
				),
			
			array(
				'field'=>'contract_price_kurs',
				'label'=>'Nilai Kontrak / PO dalam kurs',
				'rules'=>'required'
				),
			array(
				'field'=>'start_contract',
				'label'=>'Tanggal Mulai Kontrak',
				'rules'=>'required'
				),
			array(
				'field'=>'end_contract',
				'label'=>'Tanggal Selesai Kontrak',
				'rules'=>'required'
				)
			);
		if(!empty($_FILES['po_file']['name'])){
			$vld[] = array(
					'field'=>'po_file',
					'label'=>'Lampiran',
					'rules'=>'callback_do_upload[po_file]'
					);
		}
		$this->form_validation->set_rules($vld);
		if($this->form_validation->run()==TRUE){
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			$_POST['contract_price'] 	= preg_replace("/[,]/", "", $this->input->post('contract_price'));
			$_POST['contract_price_kurs'] 	= preg_replace("/[,]/", "", $this->input->post('contract_price_kurs'));
			$_POST['id_procurement'] = $id;
			unset($_POST['Simpan']);

			$res = $this->pm->edit_kontrak($this->input->post(),$id);
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses membuat kontrak!</p>');

				redirect(site_url('pengadaan/view/'.$id.'/kontrak'));
			}
		}
		$data['id'] = $id;
		return $this->load->view('tab/kontrak_edit',$data,TRUE);
		
	}
	public function submit($id){
		$data = $this->pm->get_pengadaan($id);
		if($data['status_procurement']!=0){
			redirect('pengadaan/view/'.$id.'/progress');
		}
		$data['tabNav'] = $this->tabNav;
		$data['sort'] = $this->utility->generateSort(array('peserta_name'));
		$data['id_pengadaan'] = $id;
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		
		if($this->input->post('simpan')){
			unset($_POST['simpan']);
			$_POST['proc_date'] = date("Y-m-d H:i:s");
			$_POST['status_procurement'] = 1;
			$res = $this->pm->send_proc($id,$this->input->post());
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Data telah terkirim ke Admin Kontrak. Data akan segera di proses!</p>');
				redirect(site_url('pengadaan/view/'.$id.'/submit'));
			}

		}

		return $this->load->view('tab/submit_procurement',$data,TRUE);
	}

	public function progress_pengadaan($id){

		$data['progress'] = $this->pm->get_progress_pengadaan($id);
		$data['step_pengadaan'] = $this->pm->get_pengadaan_step();



		$data['tabNav'] = $this->tabNav;
		$data['progressNav'] = $this->progressNav;

		$data_kontrak = $this->pm->get_kontrak($id);

		$data['id_pengadaan'] = $id;

		
		if($this->input->post('simpan')){
			$res = $this->pm->save_progress_pengadaan($id);
			if($res){
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Berhasil mengubah progress!</p>');
				redirect(current_url());
			}
		}
		return $this->load->view('tab/progress_pengadaan',$data,TRUE);
	}

	public function progress_pengerjaan($id){

		$data = $this->pm->get_pengadaan($id);
		$data['tabNav'] = $this->tabNav;
		$data['progressNav'] = $this->progressNav;

		/*Create Graph Pengerjaan*/
		$data['pengadaan'] = $this->pm->get_paket_progress($id);



		$data_kontrak = $this->pm->get_kontrak($id);

		$data['contract'] = $this->pm->get_contract_progress($data_kontrak['id']);

		$contract_length = ceil((abs(strtotime($data_kontrak['end_work'])-strtotime($data_kontrak['start_work']))+1)/86400) ;

		$data['graph'] = $this->pm->get_graph($data_kontrak['id']);

		$data['graph']['max'] = ($contract_length>$data['graph']['max'] )?$contract_length:$data['graph']['max'];
		
		$data['id_pengadaan'] = $id;

		$data_cp = $this->pm->get_contract_progress($data_kontrak['id']);

		foreach( $data_cp as $key => $val){
   			$data['graph']['supposed']['percentage'][$val['id']] = (($val['supposed']/$data['graph']['max'])*100);
   			$data['graph']['realization']['percentage'][$val['id']] = (($val['realization']/$data['graph']['max'])*100);
   		}

		$data['sort'] = $this->utility->generateSort(array('step_name','supposed','realization'));
		
		return $this->load->view('tab/progress_pengerjaan',$data,TRUE);
	}
	public function tambah_progress($id){
		$data_kontrak = $this->pm->get_kontrak($id);
		$data['tabNav'] = $this->tabNav;
		$_POST = $this->securities->clean_input($_POST,'save');
		$admin = $this->session->userdata('admin');
		$vld = 	array(
			array(
				'field'=>'step_name',
				'label'=>'Pemenang',
				'rules'=>'required'
				),
			array(
				'field'=>'supposed',
				'label'=>'Waktu yang Ditentukan',
				'rules'=>'required'
				),
			array(
				'field'=>'realization',
				'label'=>'Waktu Pengerjaan',
				'rules'=>'required'
				),
			);
		
		$this->form_validation->set_rules($vld);

		if($this->form_validation->run()==TRUE){

			$_POST['id_contract'] = $data_kontrak['id'];
			$_POST['entry_stamp'] = date("Y-m-d H:i:s");
			unset($_POST['Simpan']);

			$res = $this->pm->tambah_progress($id,$this->input->post());
			if($res){
			
				$this->session->set_flashdata('msgSuccess','<p class="msgSuccess">Sukses menambah progress!</p>');

				redirect(site_url('pengadaan/view/'.$id.'/proses_pengerjaan'));
			}
		}

		$data['id'] = $id;
		$per_page=10;
		$data['list'] = $this->pm->get_pemenang_list($id);

		return $this->load->view('tab/tambah_progress',$data,TRUE);
	}

	public function penilaian_kerja($id){
		$data = $this->pm->get_pengadaan($id);
		$data_kontrak = $this->pm->get_kontrak($id);

		$data['contract'] = $this->pm->get_contract_progress($data_kontrak['id']);
		$contract_length = ceil((abs(strtotime($data_kontrak['end_work'])-strtotime($data_kontrak['start_work']))+1)/86400) ;

		$data['graph'] = $this->pm->get_graph($data_kontrak['id']);

		$data['graph']['max'] = ($contract_length>$data['graph']['max'] )?$contract_length:$data['graph']['max'];

		$data['id_pengadaan'] = $id;

		$data_cp = $this->pm->get_contract_progress($data_kontrak['id']);
		foreach( $data_cp as $key => $val){
   			$data['graph']['supposed']['percentage'][$val['id']] = (($val['supposed']/$data['graph']['max'])*100);
   			$data['graph']['realization']['percentage'][$val['id']] = (($val['realization']/$data['graph']['max'])*100);
   		}

		$data['sort'] = $this->utility->generateSort(array('step_name','supposed','realization'));

		return $this->load->view('tab/progress_pengadaan',$data,TRUE);
	}

	public function penilaian_pengadaan($id){
		$data = $this->pm->get_pengadaan($id);
		$data_kontrak = $this->pm->get_kontrak($id);
		$data['id_pengadaan'] = $id;
		
		$data['sort'] = $this->utility->generateSort(array('step_name','supposed','realization'));

		return $this->load->view('tab/progress_pengadaan',$data,TRUE);
	}

	public function do_upload($name = '', $db_name = ''){	
		$form = $this->session->userdata('form');
		$file_name = $_FILES[$db_name]['name'] = $db_name.'_'.$this->utility->name_generator($_FILES[$db_name]['name']);
		
		$config['upload_path'] = './lampiran/'.$db_name.'/';
		$config['allowed_types'] = 'pdf|jpeg|jpg|png|gif';
		$config['max_size'] = '2096';
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload($db_name)){
			$this->form_validation->set_message('do_upload', $this->upload->display_errors());
			return false;
		}else{
			$_POST[$db_name] = $file_name; 
			
			return true;
		}
	}
	
	public function get_field(){
		return array(
			array(
				'label'	=>	'Administrasi',
				'filter'=>	array(
								array('table'=>'ms_vendor|name' ,'type'=>'text','label'=> 'Nama Vendor'),
								array('table'=>'tb_legal|name' ,'type'=>'text','label'=> 'Badan Hukum'),
								array('table'=>'ms_vendor_admistrasi|vendor_website' ,'type'=>'text','label'=> 'Website'),
								array('table'=>'ms_vendor_admistrasi|npwp_code' ,'type'=>'text','label'=> 'NPWP'),
								array('table'=>'ms_vendor_admistrasi|nppkp_code' ,'type'=>'text','label'=> 'NPPKP'),
								array('table'=>'ms_vendor_admistrasi|vendor_address' ,'type'=>'text','label'=> 'Alamat'),
								array('table'=>'ms_vendor_admistrasi|vendor_city' ,'type'=>'text','label'=> 'Kota'),
								array('table'=>'ms_vendor_admistrasi|vendor_email' ,'type'=>'text','label'=> 'Email'),
							)
			),
			array(
				'label'	=>	'Akta Perusahaan',
				'filter'=>	array(
								array('table'=>'ms_akta|no' ,'type'=>'text','label'=> 'No Akta')
							)
			),
			array(
				'label'	=>	'Pengurus',
				'filter'=>	array(
								array('table'=>'ms_pengurus|name' 	,'type'=>'text','label'=> 'Nama'),
								array('table'=>'ms_pengurus|no' 	,'type'=>'text','label'=> 'No')
							)
			),
			array(
				'label'	=>	'Kepemilikan Modal',
				'filter'=>	array(
								array('table'=>'ms_pemilik|name' 	,'type'=>'text','label'=> 'Nama')
							)
			),
			array(
				'label'	=>	'SITU/SKPD',
				'filter'=>	array(
								array('table'=>'ms_situ|no' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_situ|address' 	,'type'=>'text','label'=> 'Alamat')
							)
			),
			array(
				'label'	=>	'Bidang / Sub Bidang',
				'filter'=>	array(
								array('table'=>'tb_bidang|name|get_bidang' 	,'type'=>'dropdown','label'=> 'Bidang')
							)
			),
			array(
				'label'	=>	'Tanggal Diangkat DPT',
				'filter'=>	array(
								array('table'=>'tr_dpt|start_date' 	,'type'=>'date_range','label'=> array('Dari tanggal :','Hingga Tanggal'))
							)
			),
			array(
				'label'	=>	'TDP',
				'filter'=>	array(
								array('table'=>'tr_tdp|no' 	,'type'=>'text','label'=> 'No'),
							)
			),
			array(
				'label'	=>	'SIUP',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|no|siup' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_ijin_usaha|qualification|siup' 	,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'tb_bidang|name|siup' 	,'type'=>'text','label'=> 'Bidang / Sub bidang'),
							)
			),array(
				'label'	=>	'Surat Ijin Usaha Lainnya',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|no|ijin_lain' 	,'type'=>'text','label'=> 'No'),
								array('table'=>'ms_ijin_usaha|qualification|ijin_lain' 	,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_ijin_usaha|authorize_by|ijin_lain' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'tb_bidang|name|ijin_lain' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'Sertifikat Asosiasi/Lainnya',
				'filter'=>	array(
								array('table'=>'ms_ijin_usaha|authorize_by|asosiasi' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'ms_ijin_usaha|no|asosiasi' 	,'type'=>'text','label'=> 'no'),
								array('table'=>'tb_name|name|asosiasi' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'SIUJK',
				'filter'=>	array(
								
								array('table'=>'ms_ijin_usaha|qualification|siujk' ,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_ijin_usaha|authorize_by|siujk' 	,'type'=>'text','label'=> 'Lembaga Penerbit'),
								array('table'=>'ms_ijin_usaha|no|siujk' 	,'type'=>'text','label'=> 'no'),
								array('table'=>'tb_name|name|siujk' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
							)
			),array(
				'label'	=>	'Keagenan',
				'filter'=>	array(
								
								array('table'=>'ms_agen_produk|type' ,'type'=>'text','label'=> 'Kualifikasi'),
								array('table'=>'ms_agen_produk|name' 	,'type'=>'text','label'=> 'Nama Produk'),
								array('table'=>'ms_agen_produk|merk' 	,'type'=>'text','label'=> 'Nama Merk'),
							)
						
			),array(
				'label'	=>	'Pengalaman',
				'filter'=>	array(
								array('table'=>'ms_pengalaman|job_name' 	,'type'=>'text','label'=> 'Nama Paket Pengadaan'),
								array('table'=>'tb_name|name' 	,'type'=>'text','label'=> 'Bidang / Sub Bidang'),
								array('table'=>'ms_pengalaman|job_location' 	,'type'=>'text','label'=> 'Lokasi'),
								array('table'=>'ms_agen_produk|merk' 	,'type'=>'text','label'=> 'Nama Merk'),
							)
						)
			
		);
	}
}