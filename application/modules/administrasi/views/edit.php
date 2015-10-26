<div class="formDashboard">
	<h1 class="formHeader">Administrasi</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<!--<tr class="input-form">
				<td><label>Lokasi Pendaftaran</label></td>
				<td>
					<?php echo $sbu_name;//form_dropdown('id_sbu', $sbu, (isset($id_sbu)?$id_sbu:$this->form->get_temp_data('id_sbu')) ,'class="col-14"');?>
				</td>
			</tr>-->
			<tr class="input-form">
				<td><label>Nama Badan Usaha</label></td>
				<td>
					<?php echo form_dropdown('id_legal', $legal, (isset($id_legal)?$id_legal:$this->form->get_temp_data('id_legal')) ,'style="display: block; margin-bottom: 5px;"');?>
					<input type="text" name="name" value="<?php echo (isset($name)?$name:$this->form->get_temp_data('name'));?>" >
					<?php echo form_error('name'); ?>
					<?php echo form_error('id_legal'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Alamat*</label></td>
				<td>
					<textarea name="vendor_address" cols="40" rows="3"><?php echo ($this->form->get_temp_data('vendor_address'))?$this->form->get_temp_data('vendor_address'):$vendor_address;?></textarea>
					<p class="notifReg">diisi sesuai dengan Surat Keterangan Domisil Perusahaan (SKDP) / Surat Izin Tempat Usaha (SITU)</p>
					<?php echo form_error('vendor_address'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Kota / Kab*</label></td>
				<td>
					<input type="text" name="vendor_city" value="<?php echo (isset($vendor_city)?$vendor_city:$this->form->get_temp_data('vendor_city'));?>">
					<?php echo form_error('vendor_city'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Kode Pos*</label></td>
				<td>
					<input type="text" name="vendor_postal" value="<?php echo (isset($vendor_postal)?$vendor_postal:$this->form->get_temp_data('vendor_postal'));?>">
					<?php echo form_error('vendor_postal'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Provinsi*</label></td>
				<td>
					<input type="text" name="vendor_province" value="<?php echo (isset($vendor_province)?$vendor_province:$this->form->get_temp_data('vendor_province'));?>">
					<?php echo form_error('vendor_province'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No. NPWP*</label></td>
				<td>
					<input type="text" name="npwp_code" id="npwp" value="<?php echo (isset($npwp_code)?$npwp_code:$this->form->get_temp_data('npwp_code'));?>">
					<?php echo form_error('npwp_code'); ?>
				</td>
			</tr>
			<tr class="input-form">
				
				<td><label>Tanggal Pengukuhan</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'npwp_date','value'=>(isset($npwp_date)?$npwp_date:$this->form->get_temp_data('npwp_date')), false));?>
					<?php echo form_error('npwp_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Lampiran</label></td>
				<td><?php if($npwp_file!=''){ ?>
					<p><a href="<?php echo base_url('lampiran/npwp_file/'.$npwp_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<?php } ?>
					<input type="file" name="npwp_file" value="<?php echo ($this->form->get_temp_data('npwp_file'))?$this->form->get_temp_data('npwp_file'):$npwp_file;?>">
					<?php echo form_error('npwp_file'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No. NPPKP</label></td>
				<td>
					<input type="text" name="nppkp_code" value="<?php echo (isset($nppkp_code)?$nppkp_code:$this->form->get_temp_data('nppkp_code'));?>">
					<?php echo form_error('nppkp_code'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Pengukuhan</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'nppkp_date','value'=>(isset($nppkp_date)?$nppkp_date:$this->form->get_temp_data('nppkp_date')), false));?>
					<?php echo form_error('nppkp_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Lampiran</label></td>
				<td>
					<?php if($nppkp_file!=''){ ?>
					<p><a href="<?php echo base_url('lampiran/nppkp_file/'.$nppkp_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<?php } ?>
					<input type="file" name="nppkp_file" value="<?php echo ($this->form->get_temp_data('nppkp_file'))?$this->form->get_temp_data('nppkp_file'):$nppkp_file;?>">
					<?php echo form_error('nppkp_file'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Status</label></td>
				<td>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'vendor_office_status'),'pusat',(set_radio('vendor_office_status','pusat')||((isset($vendor_office_status)?$vendor_office_status:$this->form->get_temp_data('vendor_office_status'))=='pusat'))?TRUE:FALSE)?>Pusat
					</label>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'vendor_office_status'),'cabang',(set_radio('vendor_office_status','cabang')||((isset($vendor_office_status)?$vendor_office_status:$this->form->get_temp_data('vendor_office_status'))=='cabang'))?TRUE:FALSE)?>Cabang
					</label>
					<?php echo form_error('vendor_office_status'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Negara</label></td>
				<td>
					<input type="text" name="vendor_country" value="<?php echo (isset($vendor_country)?$vendor_country:$this->form->get_temp_data('vendor_country'));?>">
					<?php echo form_error('vendor_country'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No Telp</label></td>
				<td>
					<input type="text" name="vendor_phone" value="<?php echo (isset($vendor_phone)?$vendor_phone:$this->form->get_temp_data('vendor_phone'));?>">
				<?php echo form_error('vendor_phone'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Fax</label></td>
				<td>
					<input type="text" name="vendor_fax" value="<?php echo (isset($vendor_fax)?$vendor_fax:$this->form->get_temp_data('vendor_fax'));?>">
					<?php echo form_error('vendor_fax'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Email</label></td>
				<td>
					<input type="text" name="vendor_email" value="<?php echo (isset($vendor_email)?$vendor_email:$this->form->get_temp_data('vendor_email'));?>">
					<?php echo form_error('vendor_email'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Website</label></td>
				<td>
					<input type="text" name="vendor_website" value="<?php echo (isset($vendor_website)?$vendor_website:$this->form->get_temp_data('vendor_website'));?>">
					<?php echo form_error('vendor_website'); ?>
				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>