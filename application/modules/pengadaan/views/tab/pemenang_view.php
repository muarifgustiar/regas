<div class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'pemenang');?>
	
	<div class="tableWrapper" style="margin-bottom: 20px;padding-left: 20px;">
		<form method="POST" enctype="multipart/form-data">
			<div class="formDashboard">
			<table>
				<tr class="input-form">
					<td><label>Pemenang</label></td>
					<td><?php echo $data['name']?>
					</td>
				</tr>
				<tr class="input-form">
					<td>
						<label>Nilai : </label>
					</td>
					<td>
						 Rp. <?php echo $data['idr_value']?>
					</td>
				</tr>
				<tr class="input-form">
					<td>
						
					</td>
					<td>
						<?php echo $data['kurs_name']?>
						<?php echo $data['kurs_value']?>
					</td>
				</tr>
				<tr class="input-form">
					<td>
						<label>Hasil evaluasi :</label>
					</td>
					<td>
						<?php echo $data['nilai_evaluasi']?>
					</td>
				</tr>
			</table>
			<?php echo form_error('id_surat'); ?>
			<?php if($this->session->userdata('admin')['id_role']==3){ ?>
			<div class="buttonRegBox clearfix">
				<a href="<?php echo site_url('pengadaan/view/'.$id.'/pemenang_edit')?>" class="btnBlue">Edit</a>
			</div>
			<?php } ?>
			</div>
		</form>
		
	</div>
</div>