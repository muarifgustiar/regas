<script type="text/javascript">
$(document).ready(function () {
	$('.customCB').click(function(){
		$(this).addClass("checked");
		var $inputs = $('.customCB')
		if($(":checkbox").filter(':checked').length==9){
			$("input[type=checkbox]").prop('disabled',true); 
			$(".checked").removeAttr("disabled");

		// submit the form 
		}else{
			$inputs.prop('disabled',false);
		}
	})
})
</script>


<?php echo $this->session->flashdata('msgSuccess')?>
<h2 class="formHeader">Custom Report</h2>
<div class="tableWrapper" style="margin-bottom: 20px;padding-left: 20px;">
	<form method="POST" enctype="multipart/form-data">
		<div class="customReport">
			<?php echo form_error('report'); ?>
			<div class="customBox">
				<input class="customCB" type="checkbox" name="report[]" value="name" />
				<p>Nama Perusahaan</p>
			</div>
			<div class="customBox">
				<input class="customCB" type="checkbox" name="report[]" value="address" />
				<p>Alamat</p>
			</div>
			<div class="customBox">
				<input class="customCB" type="checkbox" name="report[]" value="type" />
				<p>Badan Usaha</p>
			</div>
		</div>


		<div class="buttonRegBox clearfix">
			<input type="submit" value="Go" class="btnBlue" name="print">
		</div>
	</form>
	
</div>
