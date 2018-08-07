   
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Export</b></h4>
		</div>
		<div class="modal-body">
			<?php 
				if(validation_errors()){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>".validation_errors()."</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('export/export_renaksi/'.$monitor_id.'', '', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-3">Tipe
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								$options_type = array(
									'1' => 'pdf',
									'2' => 'xls'
									);
								echo form_dropdown('type', $options_type, set_value('type',1), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Prioritas
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								echo form_dropdown('prioritas', $option_prioritas, set_value('prioritas',0), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Penanggung Jawab
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								echo form_dropdown('penanggung_jawab', $option_penanggungjawab, set_value('penanggung_jawab',0), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<input type="hidden" name="periode" value=0>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('export', 'Export', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>