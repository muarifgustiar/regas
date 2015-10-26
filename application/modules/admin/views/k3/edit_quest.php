<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.wysiwyg.css');?>" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>

<div class="formDashboard">
	<h1 class="formHeader">Edit Pertanyaan K3</h1>
	<?php foreach ($quest as $key => $value) {?>

	<?php if ($value['type'] == "text") {?>
	<div class="text">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" style="width:700px !important;" name="value"><?php echo $value['value'] ?></textarea>
						<input type="hidden" value="text" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Update">
			</div>
		</form>
	</div>
	<?php }?>

	<?php if ($value['type'] == "radio") {?>
	<div class="radio">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" style="width:700px !important;" name="value"><?php echo $value['value'] ?></textarea>
						<input type="hidden" value="radio" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
				<tr class="input-form">
					<td><label>Label Pertanyaan* :</label></td>
						<?php $label = explode("|", $value['label']);?>
					<td style="width: 500px;">
						<input placeholder="label pertama" type="text" class="textTP" name="labelfield[]" value="<?php echo $label[0];?>">
						<input placeholder="label kedua" type="text" class="textTP" name="labelfield[]" value="<?php echo $label[1];?>">
						<?php echo form_error('labelfield[]');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Update">
			</div>
		</form>
	</div>
	<?php }?>

	<?php if ($value['type'] == "file") {?>
	<div class="file">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" style="width:700px !important;" name="value"><?php echo $value['value'] ?></textarea>
						<input type="hidden" value="file" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
				<tr class="input-form">
					<td><label>Label Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<?php $label = explode("_", $value['label']); $result = implode(" ", $label)?>
						<input placeholder="label pertama" type="text" class="textTP" name="labelfield" value="<?php echo $result; ?>">
						<?php echo form_error('labelfield');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Update">
			</div>
		</form>
	</div>
	<?php } ?>
	<?php } ?>
	
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.wysiwyg.js');?>"></script>

<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('.wysiwyg').wysiwyg();
	});
})(jQuery);
</script>