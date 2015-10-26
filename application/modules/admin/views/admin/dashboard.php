<div class="sideArea">
	<div class="loginInfo">
		<h2>Selamat Datang, <?php echo $this->session->userdata('admin')['role_name'];?></h2>
		<!--<p class="sbuText">Welcome <?php echo $this->session->userdata('admin')['role_name'];?>, Sumber Daya Manusia dan Umum</p>-->
	</div>
</div>
<div class="mainArea">
	<?php if(isset($content)){
		echo $content;
	}
	?>
</div>
