<?php echo $this->session->flashdata('msgSuccess')?>
<div id="container-chart">
	
</div>

<div>
	<h3>Harga HPS</h3>
    <div class="tableWrapper">
    	<div class="tableHeader">
			<a href="<?php echo site_url('katalog/tambah_harga/'.$id);?>" class="btnBlue"><i class="fa fa-plus"></i> Tambah</a>
		</div>
		<table class="tableData">
			<thead>
				<tr>
					<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['price'] == 'asc') ? 'desc' : 'asc'; ?>&by=price">Harga<i class="fa fa-sort-<?php echo ($sort['price'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
					<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['date'] == 'asc') ? 'desc' : 'asc'; ?>&by=date">Tanggal<i class="fa fa-sort-<?php echo ($sort['date'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
					<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['vendor_name'] == 'asc') ? 'desc' : 'asc'; ?>&by=vendor_name">Nama Vendor<i class="fa fa-sort-<?php echo ($sort['vendor_name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
					<td colspan="2">Action</td>
				</tr>
			</thead>

			<tbody>
				<?php foreach($list_harga as $key => $row){ ?>
					<tr>
						<td>Rp. <?php echo number_format($row['price']);?></td>
						<td><?php echo $row['date'];?></td>
						<td><?php echo $row['vendor_name'];?></td>
						<td class="actionBlock">
							<a href="<?php echo site_url('katalog/edit_harga/'.$id.'/'.$row['id'])?>" class="editBtn"><i class="fa fa-cog"></i>Edit</a>
							<a href="<?php echo site_url('katalog/hapus_harga/'.$id.'/'.$row['id'])?>" class="delBtn"><i class="fa fa-trash"></i>Hapus</a>
						</td>
					</tr>
				<?php }?>
					
				
			</tbody>
		</table>
		
	</div>
</div>
<div class="pageNumber">
	<?php echo $pagination ?>
</div>