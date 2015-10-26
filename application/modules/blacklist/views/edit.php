<div class="formDashboard">
	<h1 class="formHeader">Ubah Data Blacklist</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama Vendor*</label></td>
				<td>
					<input type="text" name="id_vendor" value="<?php echo ($this->form->get_temp_data('id_vendor'))?$this->form->get_temp_data('id_vendor'):$id_vendor;?>" >
					<?php echo form_error('id_vendor'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Mulai*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'start_date','value'=>$this->form->get_temp_data('start_date')), false);?>
					<?php echo form_error('start_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Selesai*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'end_date','value'=>$this->form->get_temp_data('end_date')), false);?>
					<?php echo form_error('end_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Remark*</label></td>
				<td>
					<textarea name="remark"><?php echo $this->form->get_temp_data('remark');?><?php echo ($this->form->get_temp_data('remark'))?$this->form->get_temp_data('remark'):$remark;?></textarea>
					<?php echo form_error('remark'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>File </label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/blacklist_file/'.$blacklist_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="blacklist_file" value="<?php echo $this->form->get_temp_data('blacklist_file');?>">
					<?php echo form_error('blacklist_file'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>