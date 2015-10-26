<div class="sideArea">
	<ul class="listMenu">
		<li><a href="<?php echo site_url()?>"><i class="fa fa-home"></i>&nbsp; Beranda</a></li>
		<li><a href="<?php echo site_url('administrasi');?>"><i class="fa fa-file-o"></i>&nbsp; Administrasi</a></li>
		<li><a href="<?php echo site_url('akta');?>"><i class="fa fa-file-o"></i>&nbsp; Akta</a></li>
		<li><a href="<?php echo site_url('situ');?>"><i class="fa fa-file-o"></i>&nbsp; SITU/SKDP</a></li>
		<li><a href="<?php echo site_url('tdp');?>"><i class="fa fa-file-o"></i>&nbsp; TDP</a></li>
		<li><a href="<?php echo site_url('pengurus');?>"><i class="fa fa-file-o"></i>&nbsp; Pengurus Perusahaan</a></li>
		<li><a href="<?php echo site_url('pemilik');?>"><i class="fa fa-file-o"></i>&nbsp; Pemilik Modal</a></li>
		<li><a href="<?php echo site_url('izin');?>"><i class="fa fa-file-o"></i>&nbsp; Izin Usaha</a></li>
		<li><a href="<?php echo site_url('pengalaman');?>"><i class="fa fa-file-o"></i>&nbsp; Pengalaman</a></li>
		<li><a href="<?php echo site_url('agen');?>"><i class="fa fa-file-o"></i>&nbsp; Pabrikan/Keagenan/Distributor</a></li>
		<?php 
		$user = $this->session->userdata('user');
		if($this->dpt->check_iu($user['id_user'])>0){?>
		<li><a href="<?php echo site_url('k3');?>"><i class="fa fa-file-o"></i>&nbsp; Aspek K3</a></li>
		<?php }?>

		<?php 
		$this->load->model('dashboard/dashboard_model');
		$auction = $this->dashboard_model->get_auction();
		if($auction->num_rows() > 0){ ?>
		<li><a href="<?php echo site_url('auction/user/vendor_dash');?>"><i class="fa fa-file-o"></i>&nbsp; Auction</a></li>
		<?php }?>


		<?php 
			
			if($user['vendor_status']==0){
				?>
				<li class="waitBtn"><a href="<?php echo site_url('vendor/to_waiting_list');?>" class="waitingList"><i class="fa fa-briefcase"></i>&nbsp; Submit Data</a></li>
				<?php
			}
		?>
	</ul>
</div>
<div class="mainArea">
	<?php if(isset($content)){
		echo $content;
	}
	?>
</div>
