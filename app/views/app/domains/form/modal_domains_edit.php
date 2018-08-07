<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#edit_domain').ajaxForm(function(data) {
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
	if ($domain->num_rows() > 0)
	{
		$domain_detil = $domain->row();
		$domain_detil_encode = $this->encrypt->encode($domain_detil->id);
		$this->load->model('m_monitor');
		$prepopulate_instansi = $this->m_monitor->get_domains_prepopulate($domain_detil->parent_id);
	}
?>   
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Edit Data Pengguna</b></h4>
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
			<?=form_open_multipart('domains/domain_edit/'.$domain_detil_encode.'', 'id="edit_domain"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-4">Instansi / Unit Kerja
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name',$domain_detil->name); ?>"/>
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
								<input type="text" class="form-control" id="instansi_induk" name="instansi_induk"
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
								<?php 
								echo form_dropdown('type', $option_type, set_value('type',$domain_detil->domains_type_id), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4">Alias
						</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input type="text" class="form-control" id="alias" name="alias" value="<?php echo set_value('alias',$domain_detil->name_alias); ?>"/>
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
								echo form_dropdown('status', $options_status, set_value('status',$domain_detil->verified), 'class="form-control"');
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/multiple-select/js/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/multiple-select/css/token-input-facebook.css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#instansi_induk").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: <?php echo json_encode($prepopulate_instansi);?>	
		});
		});
	</script>