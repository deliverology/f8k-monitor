<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_checkpoint_delete').ajaxForm(function(data) {
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
			<h4 class="modal-title"><b>Checkpoint</b></h4>
		</div>
		<?=form_open('checkpoint/checkpoint-delete/'.$checkpoint_id_encode.'', 'id="form_checkpoint_delete"', array('class'=>'form-horizontal'));?>
		<div class="modal-body"> 
			<h4 class="modal-title text-center"><b>Apakah anda yakin menghapus data ini?</b></h4>
		</div>
		<div class="modal-footer">
			<?=form_submit('delete', 'Ya', 'class="btn blue"'); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>
