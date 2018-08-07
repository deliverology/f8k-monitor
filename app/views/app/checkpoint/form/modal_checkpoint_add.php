<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_add_checkpoint').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
	}); 
</script>  
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Tambah Checkpoint</b></h4>
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
			<?=form_open('checkpoint/checkpoint-add/'.$monitor_id_encode.'', 'id="form_add_checkpoint"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-5">Tahun
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<input type="text" name="year" value="<?php echo set_value('year');?>" size="4" maxlength="4" class="form-control">
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-5">Bulan
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<div class="input-icon right">
								<?php 
								$options_month = array(
								'1' => 'B01',
								'2' => 'B02',
								'3' => 'B03',
								'4' => 'B04',
								'5' => 'B05',
								'6' => 'B06',
								'7' => 'B07',
								'8' => 'B08',
								'9' => 'B09',
								'10' => 'B10',
								'11' => 'B11',
								'12' => 'B12'
								);
								echo form_dropdown('month', $options_month, set_value('month'), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-5">Minggu
						</label>
						<div class="col-md-3">
							<div class="input-icon right">
								<?php 
								$options_week = array(
								'' => '',
								'1' => 'M01',
								'2' => 'M02',
								'3' => 'M03',
								'4' => 'M04'
								);
								echo form_dropdown('week', $options_week, set_value('week'), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-5">Pembukaan Periode Lapor
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<input type="text" name="date_open" value="<?php echo set_value('date_open');?>" size="10" maxlength="10" class="form-control datepicker">
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-5">Penutupan Periode Lapor
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<input type="text" name="date_close" value="<?php echo set_value('date_close');?>" size="10" maxlength="10" class="form-control datepicker">
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-5"><i><small><span class="required">*</span> Harus diisi</small></i>
						</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('tambah', 'Tambah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
                
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
	</script>
