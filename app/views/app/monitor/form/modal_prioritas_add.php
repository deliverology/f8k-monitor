<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#prioritas_add').ajaxForm(function(data) {
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
			<h4 class="modal-title"><b>Tambah Prioritas</b></h4>
		</div>
		<div class="modal-body">
			<?php 
				if(validation_errors()){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>Form harus diisi</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('monitor/prioritas_add/"'.$monitor.'"', 'id="prioritas_add"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" name="prioritas" value="<?php echo set_value('prioritas') ?>"/>
								<input type="hidden" name="monitor_id" value="<?php echo set_value('monitor_id',$monitor); ?>"/>
							</div>
						</div>
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