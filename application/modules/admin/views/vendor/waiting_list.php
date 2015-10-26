<h2 class="formHeader">Daftar Tunggu Penyedia Barang/Jasa</h2>
<div class="tableWrapper">
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['legal_name'] == 'asc') ? 'desc' : 'asc'; ?>&by=legal_name">Badan Usaha<i class="fa fa-sort-<?php echo ($sort['legal_name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Badan Usaha<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['last_update'] == 'asc') ? 'desc' : 'asc'; ?>&by=last_update">Aktivitas Terakhir<i class="fa fa-sort-<?php echo ($sort['last_update'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($list)){
			foreach($list as $row => $value){
			?>
				<tr>
					
					<td><?php echo $value['legal_name'];?></td>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['last_update'];?></td>
					<td class="actionBlock">
						<a href="<?php echo site_url('approval/administrasi/'.$value['id'])?>" class="editBtn"><i class="fa fa-pencil-square-o"></i>Cek Data</a>
						
					</td>
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
	
</div>
<div class="pageNumber">
	<?php echo $pagination ?>
</div>