<div>
	<h2 style="text-align: center">FORM EVALUASI PRA KUALIFIKASI<br>
RINGKASAN HASIL EVALUASI
	</h2>
	<table class="tableData">
		<tr>
			<td>
				Vendor : <?php echo $vendor['legal_name'].' '.$vendor['name'];?>
			</td>
			
		</tr>
		<tr>
			<td>
				Lampiran Sertifikat CSMS : <?php echo (isset($get_csms['csms_file'])) ? '<a href="'.base_url('lampiran/csms_file/').$get_csms['csms_file'].'">Lampiran</a>': '-';?>
			</td>
		</tr>
		<tr>
			<td>
				Lampiran HSE Plan : <?php echo (isset($get_hse['hse_file'])) ? '<a href="'.base_url('lampiran/hse_file/'.$get_hse['hse_file']).'">Lampiran</a>': '-';?>
			</td>
		</tr>
	</table>
	<form method="POST" enctype="multipart/form-data">
	
		<div class="panel-group">
			<p class="noticeMsg">
				Lingkari nomor yang paling baik mewakili evaluasi ini berdasarkan kriteria tujuan rating yang terlampir. <br>
				Untuk kriteria evaluasi, dapat dilihat pada <a href="<?php echo base_url('lampiran/LAMPIRAN CSMS-FORM-3A.pdf');?>" target="_target"><i class="fa fa-download"></i>&nbsp;Lampiran Kriteria Evaluasi Pra Kualifikasi </a> berikut. 
			</p>
			<table class="scoreTable">
				<thead>
					<tr>
						<td>
						</td>
						<td>
							A
						</td>
						<td>
							B
						</td>
						<td>
							C
						</td>
						<td>
							D
						</td>
						
					</tr>
				</thead>
				<tbody>
			<?php foreach($evaluasi as $key_ms => $value_ms){ 

				if(count($value_ms)>1){ ?>

					<tr class="doubleBorder">
						<td><b>Bagian <?php echo $key_ms;?> - <?php echo $ms_quest[$key_ms]?></b></td>
						<td colspan="4"></td>
					</tr>

					<?php foreach($value_ms as $key_ev => $val_ev){ ?>
					
					<tr class="evalQuest">
						<td class="textQuestLv1"><?php echo $evaluasi_list[$key_ev]['name'];?></td>
						<?php echo $this->utility->generate_radio_k3($key_ev,$evaluasi_list,isset($value_k3[$key_ev]) ? $value_k3[$key_ev] : NULL); ?>
					</tr>
					<?php foreach($val_ev as $key_quest => $val_quest){
						?>
						<tr class="borderQuest">
							<td class="textQuestLv2">
							<?php foreach($val_quest as $key_answer => $val_answer){
								 ?>
									<?php echo $val_answer['value'];?>
									<p><i>Jawaban : <?php 

									// if(isset($data_k3[$key_answer]['value'])) { echo $data_k3[$key_answer]['value'];}else{echo '-';} 
									switch ($val_answer['type']) {
												default:
												case 'text':
													if(isset($data_k3[$val_answer['id']]['value'])){
														if($data_k3[$val_answer['id']]['value']!=''){
															echo $data_k3[$val_answer['id']]['value'];
														}else{
															echo '-';
														}
													}else{
														echo '-';
													}
													
													break;
												case 'checkbox':
												
													$checkbox = explode('|', $val_answer['label']);

													foreach($checkbox as $key => $row){

														if(isset($data_k3[$val_answer['id']]['value'])){
															if($data_k3[$val_answer['id']]['value']==''){
																echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
															}else{
																if($key == $data_k3[$val_answer['id']]['value']){
																	echo '<label><i class="fa fa-check-square-o"></i>'. $row.'</label>';
																}else{
																	echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
																}
															}
															
														}else{
															echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
														}
													}
													break;
												case 'file':
													if(isset($data_k3[$val_answer['id']]['value'])){
														if($data_k3[$val_answer['id']]['value']!=''){
															echo '<p><a href="'.base_url('lampiran/'.$field_quest[$val_answer['id']]['label'].'/'.$data_k3[$val_answer['id']]['value']).'" target="_blank">Lampiran</a></p>';
														}else{
															echo '-';
														}
													}else{
														echo '-';
													}
												break;
											}
									?></i></p>

							<?php 	
							}?>
							</td>
							<?php echo $this->utility->generate_radio_k3($key_ev,$evaluasi_list,isset($value_k3[$key_ev]) ? $value_k3[$key_ev] : NULL,TRUE); ?>
						</tr>

						<?php 
					}  
					?>

					<?php 
					}
				}else{ 
					foreach($value_ms as $key_ev => $val_ev){ ?>
					<tr class="doubleBorder">
						<td class="radioQuest"><b>Bagian <?php echo $key_ms;?> - <?php echo $ms_quest[$key_ms]?></b></td>
						<?php echo $this->utility->generate_radio_k3($key_ev,$evaluasi_list,isset($value_k3[$key_ev]) ? $value_k3[$key_ev] : NULL); ?>
					</tr>

					<?php foreach($val_ev as $key_quest => $val_quest){ ?>
						<tr class="borderQuest">
							<td class="textQuestLv2">
						<?php foreach($val_quest as $key_answer => $val_answer){
						
							?>
							
								<?php echo $val_answer['value'];?>
								<p><i>Jawaban : <?php 
								// echo $val_answer['id'];
								// if(isset($data_k3[$key_answer]['value'])) { echo $data_k3[$key_answer]['value'];}else{echo '-';}
									switch ($val_answer['type']) {
												default:
												case 'text':
													if(isset($data_k3[$val_answer['id']]['value'])){
														// echo $data_k3[$key_answer]['value'];
														if($data_k3[$val_answer['id']]['value']!=''){
															echo $data_k3[$val_answer['id']]['value'];
														}else{
															echo '-';
														}
													}else{
														echo '-';
													}
													
													break;
												case 'checkbox':
												
													$checkbox = explode('|', $val_answer['label']);

													foreach($checkbox as $key => $row){

														if(isset($data_k3[$val_answer['id']]['value'])){
															if($data_k3[$val_answer['id']]['value']==''){
																echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
															}else{
																if($key == $data_k3[$val_answer['id']]['value']){
																	echo '<label><i class="fa fa-check-square-o"></i>'. $row.'</label>';
																}else{
																	echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
																}
															}
															
														}else{
															echo '<label><i class="fa fa-square-o"></i>'. $row.'</label>';
														}
													}
													break;
												case 'file':
													if(isset($data_k3[$val_answer['id']]['value'])){
														if($data_k3[$val_answer['id']]['value']!=''){
															echo '<p><a href="'.base_url('lampiran/'.$field_quest[$val_answer['id']]['label'].'/'.$data_k3[$val_answer['id']]['value']).'" target="_blank">Lampiran</a></p>';
														}else{
															echo '-';
														}
													}else{
														echo '-';
													}
												break;
											}
								 ?></i></p>
								
								
							
					<?php 	
						} ?>
							</td>
							<?php echo $this->utility->generate_radio_k3($key_ev,$evaluasi_list,isset($value_k3[$key_ev]) ? $value_k3[$key_ev] : NULL,TRUE); ?>
						</tr>
					<?php }  
					?>

					<?php 
						
					}
				}
			} ?></tbody>
            </table>

            
		</div>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="simpan">
		</div>
	</form>
</div>