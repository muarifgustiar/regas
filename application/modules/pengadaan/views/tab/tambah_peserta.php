<!-- <div class="progressBar">
	<ul>
		<li class="active">
			Pilih Vendor
		</li>
		<li>
			Pilih Surat Izin
		</li>
	</ul>
</div>
<div class="formDashboard">
	<form method="POST" enctype="multipart/form-data">
		<table>
			<tr class="input-form">
				<td><label>Pilih Vendor</label></td>
				<td>
					<div>
					<?php echo form_dropdown('id_vendor', $id_peserta, $this->form->get_temp_data('id_vendor'));?>
					</div>
					<?php echo form_error('id_vendor'); ?>
				</td>
			</tr>
			
		</table>
		
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Lanjut" class="btnBlue" name="next">
		</div>
	</form>
</div> -->

<?php echo $this->session->flashdata('msgSuccess')?>
<h2 class="formHeader">Daftar Penyedia Barang / Jasa Terdaftar</h2>
<div class="tableWrapper">
	<div class="tableHeader">
		<form method="GET">
			<div class="suggestionGroup">
				<div class="suggestion">
					<input type="input" placeholder="Cari Vendor" name="q" class="suggestionInput" id="vendor_name" >
					<input type="hidden" id="id_vendor" name="id_vendor"></div>
					<button type="submit" class="suggestionSubmit"><i class="fa fa-search"></i></button>
				</div>
				
			</div>
			<?php //echo $filter_list;?>
		</form>	
	</div>
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Vendor<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['point'] == 'asc') ? 'desc' : 'asc'; ?>&by=point">Point<i class="fa fa-sort-<?php echo ($sort['point'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td>Izin Usaha</td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($vendor_list)){
			foreach($vendor_list as $row => $value){
			?>
				<tr>
					<form action="<?php echo site_url('pengadaan/tambah_vendor/'.$id_pengadaan.'/'.$value['id'])?>" method="post">
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['point'];?></td>
					<td>
						<?php 
						$array = $this->pm->get_ijin_list($id_pengadaan,$value['id']);
						echo form_dropdown('id_surat', $array,null /*$this->form->get_temp_data('id_surat')*/);?>
					</td>
					<td class="actionBlock">
						<button type="submit"><i class="fa fa-plus"></i>&nbsp;Tambah Vendor</button> 
					</td>
					</form>	
				</tr>
			<?php 
			}
		}else{?>
			<tr>
				<td colspan="11" class="noData">Data tidak ada</td>
			</tr>
		<?php }
		?>
		</tbody>
	</table>
	<div class="pageNumber">
		<?php echo $pagination ?>
	</div>
</div>