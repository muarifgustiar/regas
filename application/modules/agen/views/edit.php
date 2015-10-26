<div class="formDashboard">
	<h1 class="formHeader">Ubah Pabrikan/Keagenan/Distributor</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>No.</label></td>
				<td>
					<input type="text" name="no" value="<?php echo ($this->form->get_temp_data('no'))?$this->form->get_temp_data('no'):$no;?>">
					<?php echo form_error('no'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Nama Principal</label></td>
				<td>
					<input type="text" name="principal" value="<?php echo ($this->form->get_temp_data('principal'))?$this->form->get_temp_data('principal'):$principal;?>">
					<?php echo form_error('principal'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'issue_date','value'=>($this->form->get_temp_data('issue_date'))?$this->form->get_temp_data('issue_date'):$issue_date), false);?>
					<?php echo form_error('issue_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Pabrikan/Keagenan/Distributor</label></td>
				<td>
					<?php echo form_dropdown('type', $pabrik, $this->form->get_temp_data('type'),'');?>
					<?php echo form_error('type'); ?>
				</td>
			</tr>
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
					<p><a href="<?php echo base_url('lampiran/agen_file/'.$agen_file)?>" target="_blank">Lampiran</a></p>
					<p><b><i style="color: #D62E2E;">Tinggalkan kosong jika tidak diganti</i></b></p>
					<input type="file" name="agen_file" value="<?php echo $this->form->get_temp_data('agen_file');?>">
					<?php echo form_error('agen_file'); ?>

				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
</div>