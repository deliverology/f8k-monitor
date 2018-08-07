<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#edit_role').ajaxForm(function(data) {
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
	if ($role->num_rows() > 0)
	{
		$role_detil = $role->row();
		$role_encode = $this->encrypt->encode($role_detil->id);
	}
?>   
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Edit Tingkatan Pengguna</b></h4>
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
			<?=form_open_multipart('setting/role-edit/'.$role_encode.'', 'id="edit_role"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-3">Tingkatan Pengguna
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="role" name="role" value="<?php echo set_value('role',$role_detil->role) ?>"/>
							</div>
						</div>
					</div>
					<input type="hidden" name="id" value="<?php echo set_value('id',$role_encode); ?>"/>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('ubah', 'Ubah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>