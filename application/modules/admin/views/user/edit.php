<div class="formDashboard">
	<h1 class="formHeader">Edit Admin</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama User* :</label></td>
				<td>
					<input type="text" name="name" value="<?php echo ($this->form->get_temp_data('name'))?$this->form->get_temp_data('name'):$name;?>">
					<?php echo form_error('name'); ?>
				</td>
			</tr>
			
			<tr class="input-form">
				<td><label>Password*</label></td>
				<td>
					<input type="password" name="password" value="<?php echo ($this->form->get_temp_data('password'))?$this->form->get_temp_data('password'):$password;?>">
					<?php echo form_error('password'); ?>
				</td>
			</tr>
			<!--<tr class="input-form">
				<td><label>SBU</label></td>
				<td>
					<?php echo form_dropdown('id_sbu', $sbu, $this->form->get_temp_data('id_sbu'),'');?>
					<?php echo form_error('id_sbu'); ?>
				</td>
			</tr>-->
			<tr class="input-form">
				<td><label>Role</label></td>
				<td>
					<?php echo form_dropdown('id_role', $role, ($this->form->get_temp_data('id_role'))?$this->form->get_temp_data('id_role'):$id_role,'');?>
					<?php echo form_error('id_role'); ?>
				</td>
			</tr>
			
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="Update">
		</div>
	</form>
</div>