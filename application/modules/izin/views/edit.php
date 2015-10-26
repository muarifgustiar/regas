<div class="formDashboard">
	<h1 class="formHeader">Ubah Izin Usaha</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<?php if($type!='siup'&&$type!='siujk'){ ?>
			<tr class="input-form">
				<td><label><?php if($type=='sbu'){
						?>Anggota Asosasi<?php
					}else{
						?>Lembaga Penerbit<?php 
					}?></label></td>
				<td>
					<input type="text" name="authorize_by" value="<?php echo ($this->form->get_temp_data('authorize_by'))?$this->form->get_temp_data('authorize_by'):$authorize_by;?>">
					<?php echo form_error('authorize_by'); ?>
				</td>
			</tr>
			<?php } ?>
			<tr class="input-form">
				<td><label>Nomor*</label></td>
				<td>
					<input type="text" name="no" value="<?php echo ($this->form->get_temp_data('no'))?$this->form->get_temp_data('no'):$no;?>">
					<?php echo form_error('no'); ?>
				</td>
			</tr>
			<?php if($type=='siujk'){?>
			<tr class="input-form">
				<?php 
					$options = array(
					              'a'	=> 'A',
					              'b'	=> 'B',
					              'c'	=> 'C',
					            );

				?>
				<td><label>Grade*</label></td>
				<td>
					<?php echo form_dropdown('grade', $options, $grade);?>
					<?php echo form_error('grade'); ?>
				</td>
			</tr>
			<?php }?>
			<tr class="input-form">
				<td><label>Tanggal</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'issue_date','value'=>($this->form->get_temp_data('issue_date'))?$this->form->get_temp_data('issue_date'):$issue_date), false);?>
					<?php echo form_error('issue_date'); ?>
				</td>
			</tr>
			<?php if($type!='asosiasi'&&$type!='sbu'){?>
			<tr class="input-form">
				<td><label>Kualifikasi</label></td>
				<td>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'qualification'),'kecil',(set_radio('qualification','kecil')||(($this->form->get_temp_data('qualification'))?$this->form->get_temp_data('qualification'):$qualification)=='kecil')?TRUE:FALSE)?>Kecil
					</label>
					<label class="lbform">
						<?php echo form_radio(array('name'=>'qualification'),'besar',(set_radio('qualification','besar')||(($this->form->get_temp_data('qualification'))?$this->form->get_temp_data('qualification'):$qualification)=='besar')?TRUE:FALSE)?>Non-kecil
					</label>
					<?php echo form_error('qualification'); ?>
				</td>
			</tr>
			<?php } ?>
			<tr class="input-form">
				<td><label>Masa Berlaku*</label></td>
				<td>
					<?php echo $this->form->lifetime_calendar(array('name'=>'expire_date','value'=> ($this->form->get_temp_data('expire_date'))?$this->form->get_temp_data('expire_date'):$expire_date, false));?>
					<?php echo form_error('expire_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Lampiran</label></td>
				<td>
					<p><a href="<?php echo base_url('lampiran/izin_file/'.$izin_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="izin_file" value="<?php echo $this->form->get_temp_data('izin_file');?>">
					<?php echo form_error('izin_file'); ?>

				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>