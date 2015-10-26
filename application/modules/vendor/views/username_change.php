<?php echo $this->session->flashdata('msgSuccess')?>
<?php echo $this->session->flashdata('msgError')?>
<div class="formDashboard">
	<h1 class="formHeader">Ubah Username</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Username</label></td>
				<td>
					<input type="text" name="vendor_email" value="<?php echo $username['vendor_email'];?>">
					<?php echo form_error('vendor_email'); ?>
				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="Update">
		</div>
	</form>
</div>