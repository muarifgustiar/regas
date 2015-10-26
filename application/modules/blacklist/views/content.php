<?php echo $this->session->flashdata('msgSuccess')?>
<?php echo $this->session->flashdata('msgError')?>
<div class="btnTopGroup clearfix">
	<a href="<?php echo site_url('blacklist/tambah')?>" class="btnBlue"><i class="fa fa-plus"></i>Tambah</a>
</div><!-- 
<div class="btnTopGroup clearfix">
	<a href="<?php echo site_url('blacklist/tambah_baru')?>" class="btnBlue"><i class="fa fa-plus"></i>Tambah Baru</a>
</div> -->

<div class="tableWrapper">
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['id_vendor'] == 'asc') ? 'desc' : 'asc'; ?>&by=id_vendor">Vendor<i class="fa fa-sort-<?php echo ($sort['id_vendor'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['start_date'] == 'asc') ? 'desc' : 'asc'; ?>&by=start_date">Tanggal Mulai<i class="fa fa-sort-<?php echo ($sort['start_date'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['end_date'] == 'asc') ? 'desc' : 'asc'; ?>&by=end_date">Tanggal Akhir<i class="fa fa-sort-<?php echo ($sort['end_date'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['remark'] == 'asc') ? 'desc' : 'asc'; ?>&by=remark">Alasan Blacklist (remark)<i class="fa fa-sort-<?php echo ($sort['remark'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['blacklist_file'] == 'asc') ? 'desc' : 'asc'; ?>&by=blacklist_file">File<i class="fa fa-sort-<?php echo ($sort['blacklist_file'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		// echo print_r($blacklist);
		if(count($blacklist)){
			foreach($blacklist as $row => $value){
		?>
				<tr>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['start_date'];?></td>
					<td><?php echo $value['end_date'];?></td>
					<td><?php echo $value['remark'];?></td>
					<td><a href="<?php echo base_url('lampiran/blacklist_file/'.$value['blacklist_file']);?>" target="_blank"><?php echo $value['blacklist_file'];?> <i class="fa fa-link"></i></a></td>
					<td class="actionBlock">
						<a href="<?php echo site_url('blacklist/edit/'.$value['id'])?>" class="editBtn"><i class="fa fa-cog"></i>Edit</a>
						<a href="<?php echo site_url('blacklist/hapus/'.$value['id'])?>" class="delBtn"><i class="fa fa-trash"></i>Hapus</a>
					</td>
				</tr>
			<?php 
			}
		}else{?>
			<tr>
				<td colspan="11" class="end_dateData">Data tidak ada</td>
			</tr>
		<?php }
		?>
		</tbody>
	</table>
	
</div>
<div class="pageNumber">
	<?php echo $pagination ?>
</div>