<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.wysiwyg.css');?>" type="text/css"/>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){

            if($(this).attr("value")=="text"){
                $(".text").css("display", "block");
                $(".radio").css("display", "none");
                $(".file").css("display", "none");
                $(".buttonRegBox").show();
            }else if($(this).attr("value")=="radio"){
                $(".radio").css("display", "block");
                $(".text").css("display", "none");
                $(".file").css("display", "none");
                $(".buttonRegBox").show();
            }else if($(this).attr("value")=="file"){
                $(".radio").css("display", "none");
                $(".text").css("display", "none");
                $(".file").css("display", "block");
                $(".buttonRegBox").show();
            }else{
    			$(".box").hide();
                $(".buttonRegBox").hide();
            }
        });
    }).change();
});
</script>
<div class="formDashboard">
	<h1 class="formHeader">Tambah Pertanyaan K3</h1>
	<?php
		$options = array(
                  '' 		=> 'Tidak Ada',
                  'text'    => 'Text',
                  'radio'   => 'Radio Button',
                  'file' 	=> 'File',
                );

	?>
	<?php echo 'Tipe Pertanyaan Dipilih: '.form_dropdown('type', $options,'', 'class="dropdownTP"'); ?>
	<div class="box text">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" style="width:700px !important;" name="value"></textarea>
						<input type="hidden" value="text" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
			</div>
		</form>
	</div>
	<div class="box radio">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" style="width:700px !important;" name="value"></textarea>
						<input type="hidden" value="radio" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
				<tr class="input-form">
					<td><label>Label Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<input placeholder="label pertama" type="text" class="textTP" name="labelfield[]">
						<input placeholder="label kedua" type="text" class="textTP" name="labelfield[]">
						<?php echo form_error('labelfield[]');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
			</div>
		</form>
	</div>
	<div class="box file">
		<form method="POST" enctype="multipart/form-data">
			<table>
				<tr class="input-form">
					<td><label>Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<textarea class="wysiwyg textTP" name="value"></textarea>
						<input type="hidden" value="file" name="type">
						<?php echo form_error('value');?>
					</td>
				</tr>
				<tr class="input-form">
					<td><label>Label Pertanyaan* :</label></td>
					<td style="width: 500px;">
						<input placeholder="label pertama" type="text" class="textTP" name="labelfield">
						<?php echo form_error('labelfield');?>
					</td>
				</tr>
			</table>
			<div class="buttonRegBox clearfix">
				<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
			</div>
		</form>
	</div>	

	
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.wysiwyg.js');?>"></script>

<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('.wysiwyg').wysiwyg();
	});
})(jQuery);
</script>