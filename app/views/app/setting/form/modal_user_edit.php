<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#edit_user').ajaxForm(function(data) {
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
	if ($user->num_rows() > 0)
	{
		$user_detil = $user->row();
		$user_encode = $this->encrypt->encode($user_detil->id);
		$this->load->model('m_monitor');
		$prepopulate_instansi = $this->m_monitor->get_domains_prepopulate($user_detil->domain_id);
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
			<?=form_open_multipart('setting/user-edit/'.$user_encode.'', 'id="edit_user"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-3">Email
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" disabled id="email" name="email" value="<?php echo set_value('email',$user_detil->email) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Username
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" disabled id="username" name="username" value="<?php echo set_value('username',$user_detil->username) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Status
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								$options_status = array(
								'1' => 'Non Aktif',
								'0' => 'Aktif'
								);
						echo form_dropdown('status', $options_status, set_value('status',$user_detil->banned), 'class="form-control"');
						?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Tingkatan Pengguna
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php 
								echo form_dropdown('role', $option_roles, set_value('role',$user_detil->role_id), 'class="form-control"');
								?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Nama
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name',$user_detil->name) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Instansi / Unit Kerja
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="instansi" name="instansi"
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Jabatan
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo set_value('jabatan',$user_detil->position) ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">HP
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="hp" name="hp" value="<?php echo set_value('hp',$user_detil->phone) ?>"/>
							</div>
						</div>
					</div>
					<input type="hidden" name="user_id" value="<?php echo set_value('user_id',$user_encode); ?>"/>
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
		$("#instansi").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: <?php echo json_encode($prepopulate_instansi);?>	
		});
		});
	</script>