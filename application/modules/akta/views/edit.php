<div class="formDashboard">
	<h1 class="formHeader">Ubah Akta</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Jenis* :</label></td>
				<td>
					<?php 
						$v = 	array(
									''			=>	'Pilih Salah Satu',
									'pendirian'	=>	'Akta Pendirian',
									'perubahan'	=>	'Akta - Akta Perubahan Terakhir (mengenai anggaran dasar)',
									'direksi'	=>	'Akta - Akta Perubahan Terakhir (mengenai susunan terakhir direksi dan komisaris)',
									'saham'		=>	'Akta - Akta Perubahan Terakhir (mengenai susunan terakhir pegang saham)',
								);
						echo form_dropdown('type', $v, ($this->form->get_temp_data('type'))?$this->form->get_temp_data('type'):$type,'');?>
						<?php echo form_error('type'); ?>
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
				<td><label>Nomor*</label></td>
				<td>
					<input type="text" name="no" value="<?php echo ($this->form->get_temp_data('no'))?$this->form->get_temp_data('no'):$no;?>">
					<?php echo form_error('no'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Notaris*</label></td>
				<td>
					<input type="text" name="notaris" value="<?php echo ($this->form->get_temp_data('notaris'))?$this->form->get_temp_data('notaris'):$notaris;?>">
					<?php echo form_error('notaris'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Bukti <i>scan</i> Akta*</label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/akta_file/'.$akta_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="akta_file" value="<?php echo ($this->form->get_temp_data('akta_file'))?$this->form->get_temp_data('akta_file'):$akta_file;?>">
					<?php echo form_error('akta_file'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No. Pengesahan*</label></td>
				<td>
					<input type="text" name="authorize_no" value="<?php echo ($this->form->get_temp_data('authorize_no'))?$this->form->get_temp_data('authorize_no'):$authorize_no;?>">
					<?php echo form_error('authorize_no'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Lembaga Pengesah*</label></td>
				<td>
					<input type="text" name="authorize_by" value="<?php echo ($this->form->get_temp_data('authorize_by'))?$this->form->get_temp_data('authorize_by'):$authorize_by;?>">
					<?php echo form_error('authorize_by'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Ditetapkan*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'authorize_date','value'=>$this->form->get_temp_data('authorize_date')), false);?>
					<?php echo form_error('authorize_date'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Bukti <i>scan</i> dokumen penetapan*</label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/authorize_file/'.$authorize_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="authorize_file" value="<?php echo $this->form->get_temp_data('authorize_file');?>">
					<?php echo form_error('authorize_file'); ?>
				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>