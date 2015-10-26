<?php echo $this->session->flashdata('msgSuccess')?>
<h2 class="formHeader">Daftar Pengadaan</h2>
<div class="tableWrapper" style="margin-bottom: 20px">
	<!-- <div class="tableHeader">
		<form method="POST">
			<?php //echo $filter_list;?>
			<<a href="<?php echo site_url('pengadaan/tambah');?>" class="btnBlue"><i class="fa fa-plus"></i> Tambah</a>
		</form>	
	</div> -->
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Pengadaan<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['pemenang'] == 'asc') ? 'desc' : 'asc'; ?>&by=pemenang">Nama Pemenang Sesuai BAHP<i class="fa fa-sort-<?php echo ($sort['pemenang'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['pemenang_kontrak'] == 'asc') ? 'desc' : 'asc'; ?>&by=pemenang_kontrak">Nama Pemenang Sesuai Kontrak<i class="fa fa-sort-<?php echo ($sort['pemenang_kontrak'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($pengadaan_list)){
			foreach($pengadaan_list as $row => $value){
			?>
				<tr>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['pemenang'];?></td>
					<td><?php echo $value['pemenang_kontrak'];?></td>
					
					<td class="actionBlock">
						<a href="<?php echo site_url('assessment/view_vendor/'.$value['id'])?>" class="editBtn"><i class="fa fa-search"></i>&nbsp;Lihat Vendor</a>
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
