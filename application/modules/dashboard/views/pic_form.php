<div class="registerBlock">
	<h1 class="formHeader">Surat Pernyataan</h1>
	<form method="POST">
		<table>
			<tr class="input-form">
				<td><label>Nama</label></td>
				<td>
					<input type="text" name="pic_name" value="<?php echo $this->form->get_temp_data('pic_name');?>">
					<?php echo form_error('pic_name'); ?>
				</td>
				<td rowspan="9" style="padding-left: 10px;">
					<p>Menyatakan dengan sesungguhnya bahwa :</p>
					<ol>
						<li>Saya secara hukum mempunyai kapasitas untuk menandatangani kontrak (sesuai akte pendirian/perubahannya/surat kuasa);</li>
						<li>Saya/perusahaan saya tidak sedang dalam pengawasan pengadilan atau tidak sedang dinyatakan pailit atau kegiatan usahanya tidak sedang dihentikan atau tidak sedang menjalani hukuman (sanksi) pidana;</li>
						<li>Saya tidak pernah dihukum berdasarkan putusan pengadilan atas tindakan yang berkaitan dengan kondite profesional saya;</li>
						<li>Perusahaan saya memiliki kinerja baik dan tidak termasuk dalam kelompok yang terkena sanksi atau daftar hitam di PT Perusahaan Gas Negara (Persero) Tbk maupun di instansi lainnya, dan tidak dalam sengketa dengan PT Perusahaan Gas Negara (Persero) Tbk;</li>
						<li>Informasi/dokumen/formulir yang akan saya sampaikan adalah benar dan dapat dipertanggung jawabkan secara hukum.</li>
						<li>Segala dokumen dan formulir yang disampaikan / isi adalah benar.</li>
						<li>Apabila dikemudian hari, ditemui bahwa dokumen dokumen dan formulir yang telah kami berikan tidak benar/palsu, maka kami bersedia dikenakan sanksi sebagai berikut:
							<ol type="a">
								<li>Administrasi tidak diikutsertakan dalam setiap Pengadaan Barang dan Jasa PT Nusantara Regas selama 2 (dua) tahun</li>
								<li>Penawaran kami digugurkan</li>
								<li>Dibatalkan sebagai pemenang pengadaan</li>
								<li>Dituntut ganti rugi atau digugat secara perdata</li>
								<li>Dilaporkan kepada pihak yang berwajib untuk diproses secara pidana</li>
							</ol>
						</li>
					</ol>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Jabatan</label></td>
				<td>
					<input type="text" name="pic_position" value="<?php echo $this->form->get_temp_data('pic_position');?>">
					<?php echo form_error('pic_position'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>No Telp</label></td>
				<td>
					<input type="text" name="pic_phone" value="<?php echo $this->form->get_temp_data('pic_phone'); ?>">
					<?php echo form_error('pic_phone'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Email</label></td>
				<td>
					<input type="text" name="pic_email" value="<?php echo $this->form->get_temp_data('pic_email');?>">
					<?php echo form_error('pic_email'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Alamat</label></td>
				<td>
					<textarea name="pic_address"><?php echo $this->form->get_temp_data('pic_address'); ?></textarea>
					<?php echo form_error('pic_address'); ?>
				</td>
			</tr>
			<tr class="input-form">
				<td><label>Bertindak untuk dan atas nama</label></td>
				<td>
					<b><?php echo $data_vendor['legal_name'].' '.$data_vendor['name']; ?></b>
				</td>
			</tr>
		</table>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Next" class="btnBlue" name="next">
		</div>
	</form>
</div>