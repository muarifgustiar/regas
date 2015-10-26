 <?php echo $this->session->flashdata('msgSuccess')?>
	<?php 
		if($this->utility->check_administrasi()>0){
			?>
		<p class="noticeMsg">Harap melengkapi data administrasi vendor.<br>Pilih menu Administrasi di samping atau klik <a href="<?php echo site_url('administrasi');?>">disini</a></p>
			<?php
		}
	?>
	<h3>Summary Data</h3>

	<div id="container" style="min-width: 400px; height: 150px; margin: 0 auto"></div>

	<!-- <div class="graphBar clearfix">
		<?php foreach($graphBar as $row){
			?>
			<div class="graph" style="width: <?php echo $row['val'];?>%;background: <?php echo $row['color'];?>;"></div>
			<?php
		}?>
	</div> -->

	<div class="successVer msgBlock">
		<h4><?php echo count($approval_data[1])?> data telah sesuai</h4>
		<ul>
			<?php foreach($approval_data[1] as $key =>$value){ ?>
			<li><?php echo $value;?></li>
			<?php } ?>
		</ul>
	</div>

	<div class="warnVer msgBlock">
		<ul>
			<h4><?php echo count($approval_data[0])?> data belum terverifikasi</h4>
			
			<?php 
				$link = array(
					'Akta' 							=> 'akta',
					'SITU/Domisili' 				=> 'situ',
					'TDP'							=> 'tdp',
					'Kepemilikan Saham'				=> 'pemilik',
					'Izin Usaha'					=> 'izin',
					'Pabrikan/Keagenan/Distributor'	=> 'agen',
					'K3'							=> 'k3',
					'Data Administrasi Vendor'		=> 'administrasi',
				);
			?>
			<?php foreach($approval_data[0] as $key =>$value){?>
			<li><a href="<?php echo $link[$value];?>"><?php echo $value;?></a></li>
			<?php } ?>
		</ul>
	</div>

	<div class="errorVer msgBlock">
		<ul>
			<h4><?php echo count($approval_data[3])?> data tidak sesuai</h4>
			<?php foreach($approval_data[3] as $key =>$value){ ?>
			<li><a href="<?php echo $link[$value];?>"><?php echo $value;?></a></li>
			<?php } ?>
		</ul>
	</div>