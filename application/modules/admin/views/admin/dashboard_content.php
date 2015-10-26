<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.css');?>">

<!-- <a href="<?php echo site_url('admin/admin_vendor/waiting_list')?>" class="linkBlock clearfix col-lg-24">
<div class="dbBlock col-lg-24 pumpkinBlock">
	<div class="iconBlock">
		<i class="fa fa-hourglass"></i>
	</div>
	
	<div class="totalBlock">
		<span><?php echo $daftar_tunggu; ?></span>
		<p>Vendor</p>
	</div>
	
	<p class="title">Daftar Tunggu Penyedia Barang/Jasa</p>
</div>
</a>
<a href="<?php echo site_url('admin/admin_dpt')?>" class="linkBlock clearfix col-lg-24">
<div class="dbBlock col-lg-24 belizeBlock">
	<div class="iconBlock">
		<i class="fa fa-hourglass"></i>
	</div>
	
	<div class="totalBlock">
		<span><?php echo $total_dpt; ?></span>
		<p>Vendor</p>
	</div>
	
	<p class="title">Daftar Penyedia Barang / Jasa Terdaftar</p>
</div>
</a> -->
<h1>Selamat Datang, <?php echo $this->session->userdata('admin')['role_name'];?></h1>
<!-- <div class="dataWrapper">
    <h2>Daftar Tunggu Penyedia Jasa</h2>
    <table id="penyediaJasa" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Badan Usaha</th>
                <th>Nama Badan Usaha</th>
                <th>Aktivitas Terakhir</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Badan Usaha</th>
                <th>Nama Badan Usaha</th>
                <th>Aktivitas Terakhir</th>
            </tr>
        </tfoot>
    </table>
</div> -->

<div class="dataWrapper">
    <div id="penyediaanBarang" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div>