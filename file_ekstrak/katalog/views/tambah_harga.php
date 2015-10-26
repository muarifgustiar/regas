<div class="formDashboard">
	<h1 class="formHeader">Tambah Harga Barang</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Tanggal*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'issue_date','value'=>$this->form->get_temp_data('issue_date')), false);?>
					<?php echo form_error('issue_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Harga</label></td>
				<td>
					<div>
						<input type="text" name="price" class="money-masked" id="hps" value="<?php echo $this->form->get_temp_data('price');?>">					
					</div>
					<?php echo form_error('price'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
		</div>
	</form>
</div>

