<h2>Katalog Barang</h2>
<div class="tableWrapper">
	<div class="tableHeader">
		<a href="<?php echo site_url('katalog/tambah');?>" class="btnBlue"><i class="fa fa-plus"></i> Tambah</a>
	</div>
		<div>
			<div class="itemContainer">

				<?php foreach ($katalog as $key => $value) {
					?>
				
				<div class="item">
					<div class="itemWrapper">
						<div class="topItem">
							<div class="image">
								<img src="<?php 
								if($value['images']!=''){
									echo base_url('assets/images/item/'.$value['images']);
								}else{
									echo base_url('assets/images/default-img.png');
								}
								?>">
							</div>
						</div>
						<div class="btmItem">
							<div class="name">
								<a href="<?php echo site_url('katalog/view/'.$value['id'])?>"><?php echo $value['nama']?></a>
							</div>
							<div class="price">
								<?php echo 'IDR '.$value['last_price']; ?>
							</div>
						</div>
					</div>
				</div>
				
				<?php } ?>

			</div>
		</div>
	</div>
</div>	