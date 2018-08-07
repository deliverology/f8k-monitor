<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_reindex_monitor').ajaxForm(function(data) {
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
			<h4 class="modal-title"><b>Re-index Rencana Aksi</b></h4>
		</div>
		<?=form_open('monitor/reindex/'.$monitor_id_encode.'', 'id="form_reindex_monitor"', array('class'=>'form-horizontal'));?>
		<div class="modal-body"> 
			<h4 class="modal-title text-center"><b>Apakah anda yakin akan melakukan index ulang kepada seluruh rencana aksi?</b></h4>
			<input type="hidden" name="monitor_id_encode" value="<?php echo set_value('monitor_id_encode',$monitor_id_encode); ?>"/>
		</div>
		<div class="modal-footer">
			<?=form_submit('reindex', 'Ya', 'class="btn blue"'); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>
