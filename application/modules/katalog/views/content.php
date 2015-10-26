<?php echo $this->session->flashdata('msgSuccess')?>
<?php echo $this->session->flashdata('msgError')?>
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
								if($value['gambar_barang']!=''){
									echo base_url('lampiran/gambar_barang/'.$value['gambar_barang']);
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
								<?php echo 'IDR '.number_format($value['last_price']); ?>
							</div>
							<div class="btn">
								<a href="<?php echo site_url('katalog/edit_barang/'.$value['id']);?>"><i class="fa fa-cog"></i> Ubah</a>
								<a href="<?php echo site_url('katalog/hapus_barang/'.$value['id']);?>"><i class="fa fa-trash"></i> Hapus</a>
							</div>
						</div>
					</div>
				</div>
				
				<?php } ?>

			</div>
		</div>
	</div>
</div>	