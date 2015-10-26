<div class="tableWrapper formAss" style="margin-bottom: 20px;padding-left: 20px;">
	<h1 class="formHeader">Penilaian Vendor</h1>
	<form method="POST" enctype="multipart/form-data">
		
			<div class="panel-group">
				<div class="panel">
				<?php 
				$i=1;
				foreach($assessment_question as $key => $value){ ?>
				
					<div class="panel-body">
						<h4 class="panel-title"><?php echo $value['name']; ?></h4>
						<ul class="assQuest">
							<?php
							foreach($value['quest'] as $row => $val){ 
								$is_id = $this->session->userdata('admin')['id_role']==$val['id_role'];
							?>
							<li>
								<div class="fieldPanel <?php echo ($is_id)?'':'questGrey';?>">
									<div class="questBox">
										<p><?php echo $i.'. '.$val['value']; ?></p>
									</div>
									<div class="questBobot">
										<span>Poin : <?php echo $val['point'];?></span>
									</div>
									<div class="questCheck">
										<label>
											<?php if($is_id){ 

											?>
											<select name="ass[<?php echo $val['id']; ?>]">
												<option value="">Belum Dinilai</option>
												<option value="<?php echo $val['point']; ?>" <?php ($data_assessment[$val['id']]!=0)?'selected':'';?>>Memenuhi</option>
												<option value="0" <?php ($data_assessment[$val['id']]!=0)?'selected':'';?> >Tidak Memenuhi</option>
											</select>
											<?php }else{
												if($data_assessment[$val['id']]!=0){
													echo 'Memenuhi';
												}else if($data_assessment[$val['id']]==0){
													echo 'Tidak Memenuhi';
												}else{
													echo 'Belum Dinilai';
												}
											} ?>
										</label>
										<!--
										<input type="hidden" name="ass[<?php echo $val['id']; ?>]" value="0">
										<?php if($is_id){ ?>
										<input type="checkbox" name="ass[<?php echo $val['id']; ?>]" value="<?php echo $val['point']; ?>" 

										<?php 
										if(isset($data_assessment[$val['id']])){
											if($data_assessment[$val['id']]==$val['point']){
												echo 'checked';
											}
										} ?>
										/>
										<?php }else{
											if(isset($data_assessment[$val['id']])){
												if($data_assessment[$val['id']]==$val['point']){
													echo '<i class="fa fa-check"></i>';
												}else{
													echo '<i class="fa fa-minus"></i>';
												}
											} else{
													echo '<i class="fa fa-minus"></i>';
												}
										} ?>
									-->
										

									</div>
								</div>
							</li>
							<?php
							$i++;
							 } ?>
						</ul>
						
		            </div>
		       
				<?php 
				
				} ?>
			 </div>
              	
		</div>
		<div class="buttonRegBox clearfix">
			<input type="submit" value="Simpan" class="btnBlue" name="simpan">
		</div>

	</form>
	
</div>