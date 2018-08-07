<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#add_user').ajaxForm(function(data) {
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
	if ($use_username) {
		$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class'	=>'form-control',
		);
	}
	$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class'	=>'form-control',
	);
	$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=>'form-control',
	
	);
	$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=>'form-control',
	);
?>   
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Tambah Pengguna</b></h4>
		</div>
		<div class="modal-body">
			<?php 
				if(validation_errors()||isset($errors_username)||isset($errors_email)){
					if(isset($errors_email)) $email_error = "<br>".$errors_email; else $email_error = "";
					if(isset($errors_username)) $username_error = "<br>".$errors_username; else $username_error = "";
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>".validation_errors()."$username_error$email_error</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open_multipart('auth/register', 'id="add_user"', array('class'=>'form-horizontal'));?>
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
								<?php echo form_input($email); ?>
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
								<?php echo form_input($username); ?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Password
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php echo form_password($password); ?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Ketik Ulang Password
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<?php echo form_password($confirm_password); ?>
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
								echo form_dropdown('role', $option_roles, set_value('role',5), 'class="form-control"');
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
								<input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama') ?>"/>
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
								<input type="text" class="form-control" id="instansi" name="instansi" value="<?php echo set_value('instansi') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Jabatan
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo set_value('jabatan') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">HP
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input type="text" class="form-control" id="hp" name="hp" value="<?php echo set_value('hp') ?>"/>
							</div>
						</div>
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
		$("#instansi").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: []	
		});
		});
	</script>