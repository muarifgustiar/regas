<?php
class Summary extends CI_Controller{
	
	function __construct(){
		parent::__construct();

		$this->load->model('report/report_pengadaan_model','rpm');
	}
	
	function index($id_lelang =  '', $id_vendor = ''){
		
		$fill = $this->rpm->get_header($id_lelang);
		$pemenang = $this->rpm->get_pemenang($id_lelang)->row_array();
		$kontrak = $this->rpm->get_kontrak($id_lelang)->row_array();
		$assessment = $this->rpm->get_assessment($id_lelang, $pemenang['id'])->row_array();

		
		$_barang = $_peserta = $_bsb = $_kurs = '';
		
		
		$peserta = $this->rpm->get_peserta($id_lelang);
		foreach($peserta->result() as $data)
			$_peserta .= '<li>'.$data->name.'</li>'; 
		$peserta = $_peserta;

		$bsb = $this->rpm->get_bsb($id_lelang);
		foreach($bsb->result() as $data)
			$_bsb .= '<li>'.$data->bidang.' - '.$data->sub_bidang.'</li>'; 
		$bsb = $_bsb;
		
		$progress = $this->rpm->get_progress_pengadaan($id_lelang);
		$_progress = '';
		foreach($progress as $key => $data){
			$_progress .= '<tr>';
			$_progress .= '<td>'.$key.'</td>'; 
			$_progress .= '<td>'.(($data==1)?'<i class="fa fa-check-square-o"></i>':'').'</td>'; 
			$_progress .= '</tr>';
		}
		
		$progress = $_progress;
		
		$kurs = $this->rpm->get_kurs($id_lelang);
		foreach($kurs->result() as $data)
			$_kurs .= '<li>'.$data->name.'</li>'; 
		$kurs = $_kurs;
		
		
		
		
			
		$return = '
			<html>
				<head>
					<link rel="stylesheet" href="'.site_url('assets/css/font-awesome.css').'" type="text/css"/>
					<style type="text/css">

						@page{
							size: A4 portrait;
							page-break-after : always;
							margin : 10px;
						}
						
						@media all{
							ol{
								padding-left : 20px;
								padding-top : -15px;
								padding-bottom : -15px;
							}
							
							table { page-break-inside:avoid; }
						    tr    { page-break-inside: avoid; }
						    thead { display:table-header-group; }
					    }
    				</style>
				</head>
				<body>
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td>
								
								<table cellspacing="0" cellpadding="3" border="1" width="100%">
									<tr>
										<td colspan="2" align="center" bgcolor="#eee">
											<b>Data Paket Pengadaan </b>
										</td>
									</tr>
									<tr>
										<td width="30%" valign="top">Nama paket</td>
										<td valign="top">'.$fill['name'].'</td>
									</tr>
									<tr class="input-form">
										<td>
											Nilai HPS: 
										</td>
										<td>
											 Rp.'.$fill['idr_value'].'
										</td>
									</tr>
									<tr class="input-form">
										<td>
											
										</td>
										<td>
											'.$fill['kurs_symbol'].' '.$fill['kurs_value'].'
											
										</td>
									</tr>
									
									<tr>
										<td valign="top">Sumber Dana</td>
										<td valign="top">'.$fill['budget_source'].'</td>
									</tr>

									<tr>
										<td valign="top">Pejabat Pengadaan</td>
										<td valign="top">'.$fill['nama_pejabat'].'</td>
									</tr>
									<tr>
										<td valign="top">Tahun Anggaran</td>
										<td valign="top">'.$fill['budget_year'].'</td>
									</tr>
									<tr>
										<td valign="top">Budget Holder</td>
										<td valign="top">'.$fill['budget_holder'].'</td>
									</tr>
									<tr >
										<td valign="top">Pemegang Cost Center</td>
										<td valign="top">'.$fill['budget_spender'].'
										</td>
									</tr>
									<tr>
										<td valign="top">Metode Pengadaan</td>
										<td valign="top">'.$fill['mekanisme'].'
										</td>
									</tr>
									<tr>
										<td valign="top">Metode Evaluasi</td>
										<td valign="top">'.$fill['evaluation_method'].'
										</td>
									</tr>
								</table>
								
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
						<tr>
							<td>
								
								<table cellspacing="0" cellpadding="3" border="1" width="100%">
									<tr>
										<td colspan="2" align="center" bgcolor="#eee">
											<b>Data e-Procurement</b>
										</td>
									</tr>
									<tr>
										<td valign="top">
											Peserta e-Auction 
											<div><i>(Nama Perusahaan)</i></div>
										</td>
										<td valign="top">
											<ol>
												'.$peserta.'
											</ol>
										</td>
									</tr>
									<tr>
										<td valign="top">
											Bidang Sub Bidang
										</td>
										<td valign="top">
											<ol>
												'.$bsb.'
											</ol>
										</td>
									</tr>
									<tr>
										<td valign="top">
											Pemenang
										</td>
										<td valign="top">
											<table width="100%">
												<tr>
													<td>Nama Pemenang</td>
													<td>: '.$pemenang['name'].'</td>
												</tr>
												<tr>
													<td>Nilai</td>
													<td>: Rp. '.$pemenang['idr_value'].'</td>
												</tr>
												<tr>
													<td></td>
													<td>: '.$pemenang['kurs'].' '.$pemenang['kurs_value'].'</td>
												</tr>
												<tr>
													<td>Hasil Evaluasi Teknikal</td>
													<td>:'.$pemenang['nilai_evaluasi'].'</td>
												</tr>
												<tr>
													<td>Nilai Evaluasi Assessment</td>
													<td>:'.$assessment['point'].'</td>
												</tr>
												<tr>
													<td>Efisiensi</td>
													<td>Harga HPS : Rp.'.$fill['idr_value'].'</td>
												</tr>'.(($fill['kurs_value']>0)?'
												<tr>
													<td></td>
													<td>Harga HPS dalam kurs : Rp.'.$fill['kurs_symbol'].' '.$fill['kurs_value'].'</td>
												</tr>':'').'
												<tr>
													<td></td>
													<td>Nilai : Rp. '.$pemenang['idr_value'].'</td>
												</tr>'.(($pemenang['kurs_value']>0)?'
												<tr>
													<td></td>
													<td>Harga HPS dalam kurs : Rp.'.$pemenang['kurs_symbol'].' '.$pemenang['kurs_value'].'</td>
												</tr>':'').'
												<tr>
													<td></td>
													<td>Efisiensi : '.(($fill['idr_value']-$pemenang['idr_value'])/$fill['idr_value'] * 100).' %</td>
												</tr>
												'.(($fill['kurs_value']>0||$pemenang['kurs_value']>0)?'
												<tr>
													<td></td>
													<td>Efisiensi dalam kurs: '.(($fill['kurs_value']-$pemenang['kurs_value'])/$fill['kurs_value'] * 100).' %</td>
												</tr>':'').'

											</table>
										</td>
									</tr>
								</table>
								
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
						<tr>
							<td>
								
								<table cellspacing="0" cellpadding="3" border="1" width="100%">
									<tr>
										<td colspan="2" align="center" bgcolor="#eee">
											<b>Penandatanganan Kontrak</b>
										</td>
									</tr>
									<tr>
										<td valign="top">Nama Perusahaan</div>
										</td>
										<td valign="top">
											
												'.$kontrak['name'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">No. SPPBJ</div>
										</td>
										<td valign="top">
											
												'.$kontrak['no_sppbj'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">Tanggal SPPBJ</div>
										</td>
										<td valign="top">
											
												'.$kontrak['sppbj_date'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">No. SPMK</div>
										</td>
										<td valign="top">
											
												'.$kontrak['no_spmk'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">Tanggal SPMK</div>
										</td>
										<td valign="top">
											
												'.$kontrak['spmk_date'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">Periode Kerja</div>
										</td>
										<td valign="top">
												'.$kontrak['start_work'].' - '.$kontrak['end_work'].'
										</td>
									</tr>
									<tr>
										<td valign="top">No. Kontrak / PO.</div>
										</td>
										<td valign="top">
												'.$kontrak['no_contract'].'
										</td>
									</tr>
									<tr class="input-form">
										<td>
											Nilai Kontrak / PO 
										</td>
										<td>
											 Rp.'.$kontrak['contract_price'].'
										</td>
									</tr>
									<tr class="input-form">
										<td>
											
										</td>
										<td>
											'.$kontrak['kurs_symbol'].' '.$kontrak['contract_price_kurs'].'
											
										</td>
									</tr>
									<tr>
										<td valign="top">Periode Kontrak / PO</div>
										</td>
										<td valign="top">
												'.$kontrak['start_contract'].' - '.$kontrak['end_contract'].'
										</td>
									</tr>
									
								</table>
								
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
						<tr>
							<td>
								
								<table cellspacing="0" cellpadding="3" border="1" width="100%">
									<tr>
										<td colspan="2" align="center" bgcolor="#eee">
											<b>Progress Pengadaan</b>
										</td>
									</tr>
									'.$_progress.'
								</table>
								
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
						
					</table>
				</body>
			<html>';
		
		echo $return;
		
		
	}
}