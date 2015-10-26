

<div id="edit" class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'persyaratan');?>

	<div class="tableWrapper" style="margin-bottom: 20px">
	<?php if($this->session->userdata('admin')['id_role']==6|7){ ?>
	<div class="btnTopGroup clearfix">
		<form method="POST" enctype="multipart/form-data">
			<h2>Persyaratan</h2>
			<table style="width:100%">
				<tr class="input-form">
					<td>
						<textarea id="wysiwyg" style="width:100%" name="description"><?php echo ($this->form->get_temp_data('description'))?$this->form->get_temp_data('description'):$description;?></textarea>
					</td>
				</tr>
			</table>
			
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan Perubahan" class="btnBlue" name="update">
			</div>
		</form>
	</div>
	</div>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.wysiwyg.js');?>"></script>

<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('#wysiwyg').wysiwyg();
	});
})(jQuery);
</script>