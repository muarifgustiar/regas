<div class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'progress');?>
	<div class="tableWrapper">
		<div class="tab procView">
			<?php echo $this->utility->tabNav($progressNav,'progress_pengerjaan');?>

			<div class="tableWrapper" style="margin-bottom: 20px;padding-left: 20px;">
				<?php if($this->session->userdata('admin')['id_role']==3){ ?>
				<div class="btnTopGroup clearfix">
					<a href="<?php echo site_url('pengadaan/view/'.$id_pengadaan.'/tambah_progress');?>" class="btnBlue"><i class="fa fa-plus"></i> Tambah</a>
				</div><?php } ?>
				
				
				<p>Grafik Progress</p>
				<div class="graphBar clearfix">
					<div class="graphBarGroup clearfix barPengadaan" style="max-width: 50%;">
						<table width="100%">
							<tr class="graphWrap">
							<?php if(isset($pengadaan)){ ?>
								<?php foreach($pengadaan as $key => $row){ ?>
									<td class="graph" title="<?php echo $row['value'];?>" style="width: 50px;background: <?php echo $row['color'];?>"></td>
								<?php } ?>
							<?php } ?>
							<tr>
						</table>
					</div>
					<?php if(isset($graph['supposed']['percentage'])||isset($graph['realization']['percentage'])){ ?>
					<div class="graphBarGroup clearfix" style="width: 50%;margin-left: -4px; border-left: 2px solid #2ecc71">
						<?php } 
						 if(isset($graph['realization']['percentage'])){ ?>
						<div class="graphWrapLine">
							<?php foreach($graph['realization']['percentage'] as $key => $row){
								?>
								<div class="graph" title="<?php echo $graph['realization']['value'][$key];?>"  style="width: <?php echo $row;?>%;background: #2ecc71;"></div>
								<?php
							}?>
						</div>
						<?php } ?>
						<?php if(isset($graph['supposed']['percentage'])){ ?>
						<div class="graphWrap">
						<?php foreach($graph['supposed']['percentage'] as $key => $row){
								?>
								<div class="graph" title="<?php echo $graph['supposed']['value'][$key];?>" style="width: <?php echo $row;?>%;background: #bdc3c7"></div>
								<?php
							}?>
						</div>
						
					</div>
					<?php } ?>
					<p class="notifReg"><i>*Arahkan Mouse untuk melihat keterangan pada Grafik Progress</i></p>
				</div>
				
				
				
				<table class="tableData">
					<thead>
						<tr>
							<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['step_name'] == 'asc') ? 'desc' : 'asc'; ?>&by=step_name">Tahap Pengadaan<i class="fa fa-sort-<?php echo ($sort['step_name'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
							<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['supposed'] == 'asc') ? 'desc' : 'asc'; ?>&by=supposed">Waktu yang ditetapkan<i class="fa fa-sort-<?php echo ($sort['supposed'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
							<td><a href="?<?php echo $this->utility->generateLink('sort','desc')?>&sort=<?php echo ($sort['realization'] == 'asc') ? 'desc' : 'asc'; ?>&by=realization">Waktu Pengerjaan<i class="fa fa-sort-<?php echo ($sort['realization'] == 'asc') ? 'desc' : 'asc'; ?>"></i></a></td>
							
						</tr>
					</thead>
					<tbody>
					<?php 
					$total_supposed = 0;
					$total_realization = 0;

					if(count($contract)){
						$key = 0;
						foreach($contract as $row => $value){
						?>
							<tr>
								<td>
									<?php echo $value['step_name'];?></td>
								<td>
									<div class="colorBox" style="background: #bdc3c7;">
									</div>
									<?php echo $value['supposed'];?> Hari Kerja</td>
								<td>
									<div class="colorBox" style="background: #2ecc71;">
									</div>
									<?php echo $value['realization'];?> Hari Kerja</td>
							</tr>
						<?php 

						$total_supposed+=$value['supposed'];
						$total_realization+=$value['realization'];
						$key++;
						}
					}else{?>
						<tr>
							<td colspan="4" class="noData">Data tidak ada</td>
						</tr>
					<?php }
					?>
						<tr>
							<td >Total :</td>
							<td ><?php echo $total_supposed; ?> Hari Kerja</td>
							<td ><?php echo $total_realization; ?> Hari Kerja</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>