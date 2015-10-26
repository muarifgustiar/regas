<div class="tab procView">
	<?php echo $this->utility->tabNav($tabNav,'progress');?>
	<div class="tableWrapper">
		<div class="tab procView">
			<?php echo $this->utility->tabNav($progressNav,'progress_pengadaan');?>
			<div class="tableWrapper">
				<form method="POST">
					<div class="pengadaanStep">
						<?php foreach($step_pengadaan as $key => $val){ ?>
						<label>
							<?php echo $val?>&nbsp;<input type="hidden" name="pengadaan[<?php echo $key;?>]" value="0">
								<?php if($this->session->userdata('admin')['id_role']==3){ ?>
							<input type="checkbox" name="pengadaan[<?php echo $key;?>]" value="1" <?php echo (isset($progress[$key]))? (($progress[$key])?'checked':''): '';?>>
							<?php }else{  echo (isset($progress[$key]))? (($progress[$key])?'<i class="fa fa-check-square-o"></i>':'<i class="fa fa-square-o"></i>'): '';

							}?>
						</label>
						<?php } ?>
						<?php if($this->session->userdata('admin')['id_role']==3){ ?>
						<div class="buttonRegBox clearfix">
							<input type="submit" value="Simpan" class="btnBlue" name="simpan">
						</div>
						<?php } ?>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>