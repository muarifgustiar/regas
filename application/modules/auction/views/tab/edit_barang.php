<div class="formDashboard">
	<h1>Tambah Barang</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama Barang / Jasa</label></td>
				<td>
					<div>
						<input type="text" name="nama_barang" value="<?php echo ($this->form->get_temp_data('nama_barang'))?$this->form->get_temp_data('nama_barang'):$nama_barang;?>">					
					</div>
					<?php echo form_error('nama_barang'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Mata Uang</label></td>
				<td>
					<div>
						<?php 
						// echo print_r($id_kurs);
						echo form_dropdown('id_kurs', $kurs, ($this->form->get_temp_data('id_kurs'))?$this->form->get_temp_data('id_kurs'):$id_kurs);?>				
					</div>
					<?php echo form_error('id_kurs'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Nilai HPS</label></td>
				<td>
					<div>
						<input type="text" name="nilai_hps" class="money-masked" value="<?php echo ($this->form->get_temp_data('nilai_hps'))?$this->form->get_temp_data('nilai_hps'):$nilai_hps;?>">					
					</div>
					<?php echo form_error('nilai_hps'); ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="simpan">
		</div>
	</form>
</div>