<div class="sideArea">
	<ul class="listMenu">
		<li><a href="<?php echo site_url('auction')?>"><i class="fa fa-home"></i>&nbsp; Semua Auction</a></li>
		<li><a href="<?php echo site_url('Katalog')?>">&nbsp; Katalog</a></li>
	</ul>
</div>
<div class="mainArea">
	<?php if(isset($content)){
		echo $content;
	}
	?>
</div>