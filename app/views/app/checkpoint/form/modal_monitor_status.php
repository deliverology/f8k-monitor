<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_monitor_status').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
	}); 
</script> 
<?php 
	if($status->num_rows() > 0)
	{
		$status_detil = $status->row();
	}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Status Monitor</b></h4>
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
			<?=form_open('checkpoint/monitor_status/'.$monitor_id_encode.'', 'id="form_monitor_status"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<?php 
								$options_status = array(
								'1' => 'Pengisian',
								'2' => 'Pelaporan',
								'3' => 'Arsip'
								);
								echo form_dropdown('status', $options_status, set_value('status',$status_detil->status), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('ubah', 'Ubah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
