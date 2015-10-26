<?php echo $this->session->flashdata('msgSuccess')?>
<h2 class="formHeader">Daftar Vendor</h2>
<div class="tableWrapper">
	<div class="tableHeader">
		<form method="POST">
			<?php //echo $filter_list;?>
		</form>	
	</div>
	<table class="tableData">
		<thead>
			<tr>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>&by=name">Nama Vendor<i class="fa fa-sort-<?php echo ($sort['name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['npwp_code'] == 'asc') ? 'desc' : 'asc'; ?>&by=npwp_code">NPWP<i class="fa fa-sort-<?php echo ($sort['npwp_code'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['nppkp_code'] == 'asc') ? 'desc' : 'asc'; ?>&by=nppkp_code">NPPKP<i class="fa fa-sort-<?php echo ($sort['nppkp_code'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
				<td colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($vendor_list)){
			foreach($vendor_list as $row => $value){
			?>
				<tr>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['npwp_code'];?></td>
					<td><?php echo $value['nppkp_code'];?></td>
					<td class="actionBlock">
						<a href="<?php echo site_url('k3/penilaian_k3/'.$value['id'])?>" class="editBtn"><i class="fa fa-pencil-square-o"></i>&nbsp;Nilai CSMS</a> | 
						<a href="<?php echo site_url('k3/penilaian_view/'.$value['id'])?>"><i class="fa fa-search"></i>&nbsp;Lihat Nilai</a>
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
