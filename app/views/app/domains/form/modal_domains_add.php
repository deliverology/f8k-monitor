<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#form_add_domains').ajaxForm(function(data) {
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
			<h4 class="modal-title"><b>Tambah Instansi / Unit Kerja</b></h4>
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
			<?=form_open('domains/domain-add', 'id="form_add_domains"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-4">Nama Instansi / Unit Kerja
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" name="name" value="<?php echo set_value('name') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Nama Alias
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" name="name_alias" value="<?php echo set_value('name_alias') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Instansi / Unit Kerja Induk
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" id="parent_id" name="parent_id" value="<?php echo set_value('parent_id') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Tingkatan
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								<?php 
									$att='class="form-control"';
								echo form_dropdown('type', $option_type,set_value('type'),$att);?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Status Instansi / Unit Kerja
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<?php 
								$options_status = array(
								'1' => 'Sudah diverifikasi',
								'0' => 'Belum diverifikasi'
								);
								echo form_dropdown('status', $options_status, set_value('status'), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4"><i><small><span class="required">*</span> Harus diisi</small></i>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/multiple-select/js/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/multiple-select/css/token-input-facebook.css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#parent_id").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: []	
		});
		});
	</script>
