<div class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'kontrak');?>
	
	<div class="tableWrapper" style="margin-bottom: 20px;padding-left: 20px;">
		
			<div class="formDashboard">
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama Perusahaan* </label></td>
				<td>: <?php echo (isset($legal_name)) ? $legal_name : '';?> <?php echo (isset($vendor_name)) ? $vendor_name : '-';?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>No. SPPBJ*</label></td>
				<td>: <?php echo (isset($no_sppbj)) ? $no_sppbj : '-';?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal SPPBJ*</label></td>
				<td>: <?php echo (isset($sppbj_date)) ? $sppbj_date : '-';?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No. SPMK*</label></td>
				<td>: <?php echo (isset($no_spmk)) ? $no_spmk : '-';?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal SPMK*</label></td>
				<td>: <?php echo (isset($spmk_date)) ? $spmk_date : '-';?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Periode Kerja*</label></td>
				<td> <div>: <?php echo ((isset($start_work)) ? $start_work : 'Tidak Diketahui').' - '.((isset($end_work)) ? $end_work : 'Tidak Diketahui');?></div>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No. Kontrak / PO*</label></td>
				<td>
					<div style="margin-bottom: 10px"><?php echo (isset($no_contract)) ? $no_contract : '-'?></div>
					Lampiran : <?php 
					if(isset($po_file)){
						if($po_file){ ?>
						<a href="<?php echo base_url('lampiran/po_file/'.$po_file);?>"  target="_blank"><?php echo $po_file;?> <i class="fa fa-link"></i></a>
						<?php } 
						} else{
							echo 'Belum Terlampir';
						}?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Nilai Kontrak / PO*</label></td>
				<td>
					<div style="margin-bottom: 10px">Dalam Rupiah : Rp.<?php echo (isset($contract_price)) ? $contract_price : '-';?></div>
					<div style="margin-bottom: 10px">Dalam Mata Uang Asing : <?php echo (isset($kurs_name)&&isset($contract_price_kurs)) ? $kurs_name.' '.$contract_price_kurs : '-'; ?></div>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Periode Kontrak / PO*</label></td>
				<td>
					<div><?php echo ((isset($start_contract)) ? $start_contract : 'Tidak Diketahui').' - '.((isset($end_contract)) ? $end_contract : 'Tidak Diketahui');?></div>
				</td>
			</tr>
		</table>
			<?php if($this->session->userdata('admin')['id_role']==3){ ?>
		<div class="buttonRegBox clearfix">
			<a href="<?php echo site_url('pengadaan/view/'.$id.'/kontrak_edit');?>" class="btnBlue">Edit</a>
		</div>
		<?php } ?>
	</form>
</div>
		
		
	</div>
</div>
