<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8"/>
		<title>Login | Monev DKI</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2-metronic.css"/>
		<link href="<?php echo base_url()?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/themes/blue.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/favicon.ico"/>
	</head>
	<body class="login">
		<div class="logo">
			<a href="index.html">
			<img src="<?php echo base_url()?>assets/img/logo-login.png" alt=""/>
			</a>
		</div>
		<div class="content">
			<?php 
				
				$login = array(
				'name'	=> 'login',
				'id'	=> 'login',
				'value' => set_value('login'),
				'maxlength'	=> 80,
				'size'	=> 30,
				'placeholder' => 'Username',
				'autocomplete' => 'off',
				'class' => 'form-control placeholder-no-fix',
				'type' => 'text'
				);
				if ($login_by_username AND $login_by_email) {
					$login_label = 'Email or login';
					} else if ($login_by_username) {
					$login_label = 'Login';
					} else {
					$login_label = 'Email';
				}
				$password = array(
				'name'	=> 'password',
				'id'	=> 'password',
				'size'	=> 30,
				'placeholder' => 'Password',
				'autocomplete' => 'off',
				'type' => 'password' ,
				'class' => 'form-control placeholder-no-fix'
				);
				$remember = array(
				'name'	=> 'remember',
				'id'	=> 'remember',
				'value'	=> 1,
				'checked'	=> set_value('remember'),
				'style' => 'margin:0;padding:0',
				);
				$captcha = array(
				'name'	=> 'captcha',
				'id'	=> 'captcha',
				'maxlength'	=> 8,
				);
				
				$attributes = array('class' => 'login-form');
				echo form_open($this->uri->uri_string(),$attributes); 
			?>
			
			<h3 class="form-title">Login ke akun anda</h3>
			<?php if(isset($errors[$login['name']]) or isset($errors[$password['name']]))
				{
					echo "<div class='alert alert-danger'>
					<button class='close' data-close='alert'></button>
					<span>
					Username atau password anda salah.
					</span>
					</div>";
				}
			?>	
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="input-icon">
					<i class="fa fa-user"></i>
					<?php echo form_input($login); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<?php echo form_input($password); ?>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> Remember me </label>
				<button type="submit" class="btn blue pull-right">
					Login <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
			<div class="forget-password">
				<div class='text-center'><?php echo date('Y');?> &copy; Pemerintah Provinsi DKI Jakarta</div>
			</div>
			<?php echo form_close();?>
		</div>
		<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
		<script src="<?php echo base_url()?>assets/scripts/core/app.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/scripts/custom/login.js" type="text/javascript"></script>
		<script>
			jQuery(document).ready(function() {     
				App.init();
				Login.init();
			});
			
			$('#frm').submit(function(){
				$.post($('#frm').attr('action'), $('#frm').serialize(), function(json){
					if ( json.st == 1 ){
						alert(json.msg);
						document.location = '';
						} else {
						$('#msg-container').html(json.msg);
					}
				},'json');
				return false;
			});
			
			$(document).ajaxSend(function(event, request, settings) {
				$('#modal-loading-indicator').show();
			});
			
			$(document).ajaxComplete(function(event, request, settings) {
				$('#modal-loading-indicator').hide();
			});
			
		</script>
	</body>
</html>																