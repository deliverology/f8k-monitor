<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_edit_data').ajaxForm(function(data) {
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
	if($profile->num_rows() > 0)
	{
		$profile_detil = $profile->row();
	}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Ubah Data</b></h4>
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
			<?=form_open('profile/edit', 'id="form_edit_data"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-4">Nama
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
									<input type="text" class="form-control" name='name' value="<?php echo set_value('name',$profile_detil->name) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Jabatan
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
									<input type="text" class="form-control" name='position' value="<?php echo set_value('position',$profile_detil->position) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Hp
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
									<input type="text" class="form-control" name='phone' value="<?php echo set_value('phone',$profile_detil->phone) ?>"/>
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
