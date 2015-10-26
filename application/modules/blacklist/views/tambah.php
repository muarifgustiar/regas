<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>

<script type="text/javascript">
$( document ).ready(function() {

    $("#listDefault").hide();
    

    $('#remark').on('click' , function(){
	    var $remark = $('#remark').is(':checked');
	    $("#remarkArea").attr("disabled", false);
   		$("#remarkArea").val("");

    	$("#listDefault").hide();

	    if($remark){
	    	$("#listDefault").show();
	        $("#remarkArea").attr("disabled", true);
	    }
	})

	<?php foreach ($remark as $key => $value) {?>
				
		<?php $id = '#option'.$value['id'];?>
		
	    $("<?php echo $id?>").click(function(){
	        $("#remarkArea").val("<?php echo $value['remark']?>");
	    });

	<?php }?>
});
	
</script>

<div class="formDashboard" style="width:auto !important;">
	<h1 class="formHeader">Masukan Vendor ke Daftar Blacklist</h1>

	<form method="POST" enctype="multipart/form-data" style="width:500px !important; display:inline-block;">
		<table>
			<?php if($vendor_name){?>
			<tr>
				<td><label>Nilai Skor</label></td>
				<td>
					<?php echo $this->session->userdata('blacklist')['poin'];?>
				</td>
			</tr>
			<?php } ?>
			<tr class="input-form">
				<td><label>Nama Vendor*</label></td>
				<td>
					<input type="input" placeholder="Cari Vendor" name="q" class="suggestionInput" id="vendor_name" value="<?php echo $vendor_name;?>">
					<input type="hidden" id="id_vendor" name="id_vendor" value="<?php echo $id_vendor;?>">
				<?php //echo $filter_list;?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Mulai*</label></td>
				<td>
					<?php echo $this->form->calendar(array('name'=>'start_date','value'=>(isset($start_date)?$start_date:$this->form->get_temp_data('start_date'))), FALSE);?>
					<?php echo form_error('start_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Tanggal Selesai*</label></td>
				<td >
					<?php echo $this->form->lifetime_calendar(array('name'=>'end_date','value'=>(isset($end_date)?$end_date:$this->form->get_temp_data('end_date'))),FALSE);?>
					<?php echo form_error('end_date'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Remark*</label></td>
				<td>
					<textarea name="remark" id="remarkArea"><?php echo $this->form->get_temp_data('remark');?></textarea>
					<?php echo form_error('remark'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td></td>
				<td><input type="checkbox" name="remark" id="remark">Gunakan Default Remark</td>
			</tr>
			<tr class="input-form">
				<td><label>File </label></td>
				<td>
					<input type="file" name="blacklist_file" value="<?php echo $this->form->get_temp_data('blacklist_file');?>">
					<?php echo form_error('blacklist_file'); ?>
				</td>
			</tr>
		</table>

		<div class="buttonRegBox clearfix" style="float:left;">
			<input type="submit" value="Simpan" class="btnBlue" name="Simpan">
		</div>
	</form>
		<div id="listDefault" class="">
			<h4>Pilih Remark</h4>
			<ul>
				<?php foreach ($remark as $key => $value) {?>
				<li>
					<?php $id = 'class=option id=option'.$value['id'];?>
					<?php echo form_radio('remarkOption', $value['remark'],TRUE, $id); echo '<p>'.$value['remark'].'</p>';?>
				</li>
				<?php }?>
			</ul>
		</div>
</div>
