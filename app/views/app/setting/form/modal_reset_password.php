<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_reset_password').ajaxForm(function(data) {
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
			<h4 class="modal-title"><b>Pengaturan Pengguna</b></h4>
		</div>
		<?=form_open('setting/reset-password/'.$user_id.'', 'id="form_reset_password"', array('class'=>'form-horizontal'));?>
		<div class="modal-body"> 
			<h4 class="modal-title text-center"><b>Apakah anda yakin ingin melakukan reset password pada pengguna tersebut?</b></h4>
			<input type="hidden" name="id" value="<?php echo set_value('id',$user_id); ?>"/>
		</div>
		<div class="modal-footer">
			<?=form_submit('delete', 'Ya', 'class="btn blue"'); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>
