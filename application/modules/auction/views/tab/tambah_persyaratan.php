<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.wysiwyg.css');?>" type="text/css"/>

<div id="edit" class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'persyaratan');?>

	<div class="tableWrapper" style="margin-bottom: 20px">
	<?php if($this->session->userdata('admin')['id_role']==6|7){ ?>
	<div class="btnTopGroup clearfix">
		<form method="POST" enctype="multipart/form-data">
			<h2>Tambah Persyaratan</h2>
			<table>
				<tr class="input-form">
					<td>
						<textarea id="wysiwyg" width="1000px !important" name="description"></textarea>
					</td>
				</tr>
			</table>
			
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="simpan">
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