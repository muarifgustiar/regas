<div class="formDashboard">
	<h1 class="formHeader">Tambah Data Barang</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama Barang*</label></td>
				<td>
					<input type="text" name="vendor_name" id="vendor_name" value="<?php echo (isset($vendor_name)?$vendor_name:$this->form->get_temp_data('vendor_name'));?>" <?php echo (isset($vendor_name)?'readonly disabled':'')?>>
					<?php echo form_error('id_vendor'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Remark*</label></td>
				<td>
					<textarea name="remark"><?php echo $this->form->get_temp_data('remark');?></textarea>
					<?php echo form_error('remark'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Gambar</label></td>
				<td>
					<input type="file" name="gambar_barang" value="<?php echo $this->form->get_temp_data('gambar_barang');?>">
					<?php echo form_error('gambar_barang'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
		</div>
	</form>
</div>

