<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.wysiwyg.css');?>" type="text/css"/>

<div class="formDashboard">
	<h1 class="formHeader">Edit Header K3</h1>
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Nama* :</label></td>
				<td style="width: 500px;"><?php //print_r($header)?>
					<?php foreach ($header as $key => $question) { ?>
					<textarea id="wysiwyg" style="width:700px !important;" name="question"><?php echo $question; ?></textarea>
					<?php echo form_error('question');?>
					<?php } ?>
				</td>
			</tr>
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Update" class="btnBlue" name="Update">
		</div>
	</form>
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