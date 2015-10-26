<div class="formDashboard">
	<h1 class="formHeader">Edit Domisili Perusahaan</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama Surat*</label></td>
				<td>
					<?php 
						$v = 	array(
									''												=>	'-- Pilih --',
									'Surat Keterangan Domisili Perusahaan (SKDP)'	=>	'Surat Keterangan Domisili Perusahaan (SKDP)',
									'Surat Izin Tempat Usaha (SITU)'				=>	'Surat Izin Tempat Usaha (SITU)',
									'Herregisterasi SKDP'							=>	'Herregisterasi SKDP',
								);
						echo form_dropdown('type', $v, ($this->form->get_temp_data('type'))?$this->form->get_temp_data('type'):$type,'');?>
						<?php echo form_error('type'); 
					?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Nomor*</label></td>
				<td>
					<input type="text" name="no" value="<?php echo ($this->form->get_temp_data('no'))?$this->form->get_temp_data('no'):$no;?>">
					<?php echo form_error('no'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'issue_date','value'=>($this->form->get_temp_data('issue_date'))?$this->form->get_temp_data('issue_date'):$issue_date), false);?>
					<?php echo form_error('issue_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Alamat*</label></td>
				<td>
					<input type="text" name="address" value="<?php echo ($this->form->get_temp_data('address'))?$this->form->get_temp_data('address'):$address;?>">
					<?php echo form_error('address'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Foto Lokasi*</label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/file_photo/'.$file_photo)?>" target="_blank">Foto Lokasi</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="file_photo" value="<?php echo ($this->form->get_temp_data('file_photo'))?$this->get_temp_data('file_photo'):$file_photo;?>">
					<?php echo form_error('file_photo'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Masa Berlaku*</label></td>
				<td>
					<?php echo $this->form->lifetime_calendar(array('name'=>'expire_date','value'=>($this->form->get_temp_data('expire_date'))?$this->form->get_temp_data('expire_date'):$expire_date), false);?>
					<?php echo form_error('expire_date'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Lampiran*</label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/file_photo/'.$file_photo)?>" target="_blank">Foto Lokasi</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="situ_file" value="<?php echo ($this->form->get_temp_data('situ_file'))?$this->get_temp_data('situ_file'):$situ_file;?>">
					<?php echo form_error('situ_file'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>