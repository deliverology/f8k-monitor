<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#add_module').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
	}); 
</script>    
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Tambah Modul</b></h4>
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
			<?=form_open_multipart('setting/module-add/', 'id="add_module"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-3">Kata Kunci
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="key" name="key" value="<?php echo set_value('key') ?>"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Tipe
							<span class="required">
								*
							</span>
						</label>
						<br><br>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								$options_type = array(
									'1' => 'Modul',
									'2' => 'Fungsi'
									);
								echo form_dropdown('type', $options_type, set_value('type',2), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('save', 'Tambah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>