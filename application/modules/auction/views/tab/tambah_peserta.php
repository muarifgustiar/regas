<div class="formDashboard">
	<h1>Tambah Peserta</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Pilih Peserta</label></td>
				<td>
					<?php echo form_dropdown('id_vendor', $id_vendor, $this->form->get_temp_data('id_vendor'),'');?>
					<?php echo form_error('id_vendor'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="simpan">
		</div>
	</form>
</div>