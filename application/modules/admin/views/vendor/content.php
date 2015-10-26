<?php echo $this->session->flashdata('msgSuccess')?>
<div class="tableWrapper">
	<div class="tableHeader">
		<form method="POST">
			<?php echo $filter_list;?>
		</form>	
	</div>
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Vendor<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['legal_name'] == 'asc') ? 'desc' : 'asc'; ?>&by=legal_name">Badan Usaha<i class="fa fa-sort-<?php echo ($sort['legal_name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['username'] == 'asc') ? 'desc' : 'asc'; ?>&by=username">Username<i class="fa fa-sort-<?php echo ($sort['username'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['password'] == 'asc') ? 'desc' : 'asc'; ?>&by=password">Password<i class="fa fa-sort-<?php echo ($sort['password'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<!--<td colspan="2">Action</td>-->
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($vendor_list)){
			foreach($vendor_list as $row => $value){
			?>
				<tr>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['legal_name'];?></td>
					<td><?php echo $value['username'];?></td>
					<td><?php echo $value['password'];?></td>
					<!--<td class="actionBlock">
						<a href="<?php echo site_url('pengalaman/edit/'.$value['id'])?>" class="editBtn">Edit</a> | 
						<a href="<?php echo site_url('pengalaman/hapus/'.$value['id'])?>" class="delBtn"><i class="fa fa-trash"></i>Hapus</a>
					</td>-->
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