<?php echo $this->session->flashdata('msgSuccess')?>
<h2 class="formHeader">Daftar Auction</h2>
<div class="tableWrapper" style="margin-bottom: 20px">
	<div class="tableHeader">
		<form method="POST">
			<?php //echo $filter_list;?>
			<a href="<?php echo site_url('auction/tambah');?>" class="btnBlue"><i class="fa fa-plus"></i> Tambah</a>
		</form>	
	</div>
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Paket<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['auction_date'] == 'asc') ? 'desc' : 'asc'; ?>&by=auction_date">Tanggal<i class="fa fa-sort-<?php echo ($sort['auction_date'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['work_area'] == 'asc') ? 'desc' : 'asc'; ?>&by=work_area">Lokasi<i class="fa fa-sort-<?php echo ($sort['work_area'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($auction_list)){
			foreach($auction_list as $row => $value){
			?>
				<tr>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['auction_date'];?></td>
					<td><?php echo ($value['work_area']=='kantor_pusat')?'Kantor Pusat':'Site Office';?></td>
					<td class="actionBlock">
						<a href="<?php echo site_url('auction/ubah/'.$value['id'])?>" class="editBtn"><i class="fa fa-cog"></i>&nbsp;Ubah</a> | 
						<a href="<?php echo site_url('auction/duplikat/'.$value['id'])?>" class="editBtn"><i class="fa fa-files-o"></i></i>&nbsp;Duplikat</a> | 
						<a href="<?php echo site_url('auction/admin/auction_progress/index/'.$value['id'])?>" class="editBtn"><i class="fa fa-search"></i>&nbsp;Lihat Pengadaan</a> | 
						<a href="<?php echo site_url('auction/hapus/'.$value['id'])?>" class="delBtn"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
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
	<div class="pageNumber">
		<?php echo $pagination ?>
	</div>
</div>
