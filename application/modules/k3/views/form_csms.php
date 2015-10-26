<div class="formDashboard">
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td>Apakah perusahaan anda memiliki sertifikat CSMS?</td>
			</tr>
			<tr class="input-form">
				<td>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'csms'),1,(set_radio('csms',1)||($this->form->get_temp_data('csms')==1))?TRUE:FALSE,'class="csms_radio"')?>Punya
					</label>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'csms'),0,(set_radio('csms',0)||($this->form->get_temp_data('csms')==0))?TRUE:FALSE,'class="csms_radio"')?>Belum Punya
					</label>
				</td>
			</tr>
			<tr class="input-form lampiran_csms">
				<td><label>Jika ada, lampirkan sertifikat CSMS</label></td>
				<td>
					<p><a href="<?php if(isset($csms_file)){echo base_url('lampiran/csms_file/'.$csms_file);}?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="csms_file" value="<?php if(isset($this->form->get_temp_data)){echo ($this->form->get_temp_data('csms_file'))?$this->form->get_temp_data('csms_file'):$csms_file;}?>">
					<?php echo form_error('csms_file'); ?>
				</td>
			</tr>
			<tr class="input-form lampiran_csms">
				<td><label>Masa Berlaku</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'expiry_date','value'=>(isset($expiry_date)?$expiry_date:$this->form->get_temp_data('expiry_date')), false));?>
					<?php echo form_error('expiry_date'); ?>
				</td>
			</tr>
			
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Lanjut" class="btnBlue" name="next">
		</div>
	</form>
</div>