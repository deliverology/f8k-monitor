<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#prioritas_edit').ajaxForm(function(data) {
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
	if ($prioritas->num_rows() > 0)
	{
		$prioritas_detil = $prioritas->row();
	}
	
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3 class="modal-title"><b>Edit Prioritas</b></h3>
		</div>
		<div class="modal-body">
			<?php 
				if(validation_errors()){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>Form dengan tanda (*) harus diisi</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('monitor/prioritas_edit', 'id="prioritas_edit"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" name="prioritas" value="<?php echo set_value('prioritas',$prioritas_detil->name); ?>"/>
								<input type="hidden" name="prioritas_id" value="<?php echo set_value('prioritas_id',$this->encrypt->encode($prioritas_detil->id)); ?>"/>
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