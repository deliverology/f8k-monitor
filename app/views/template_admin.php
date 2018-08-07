<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $title;?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<meta content="" name="Kementerian Kelautan dan Perikanan"/>
		<meta content="" name="Kementerian Kelautan dan Perikanan"/>
		<?php $this->load->view('css');?>
		<?php $this->load->view('js');?>
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/favicon.ico"/>
	</head>
	<body class="page-header-fixed page-footer-fixed">
		
		<div class="header navbar navbar-fixed-top">
			
			<div class="header-inner">
				
				<a class="navbar-brand" href="index.html">
				<img src="<?php echo base_url();?>assets/img/logo-big.png" alt="logo" class="img-responsive"/>
				</a>
				
				<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<img src="<?php echo base_url();?>assets/img/menu-toggler.png" alt=""/>
				</a>
				
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username">
							<?php echo $username; ?>
						</span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							</li>
							<li>
								<a href="<?php echo site_url('auth/logout');?>">
								<i class="fa fa-sign-out"></i> Keluar
								</a>
							</li>
						</ul>
					</li>
					
				</ul>
				
			</div>
			
		</div>
		
		<div class="clearfix">
		</div>
		
		<div class="page-container">
			
			<div class="page-sidebar-wrapper">
				<div class="page-sidebar navbar-collapse collapse">
					
					<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
					
						<li <?php if(isset($active_icon_monitor))echo $active_icon_monitor;?>>
							<a href="<?php echo site_url('monitor');?>">
							<i class='fa fa-laptop'></i>
							<span class='	'>
								Monitor
							</span>
							<?php if(isset($active_icon_monitor))echo '<span class="selected"></span>';?>
							</a>
						</li>
						<?php
						if($this->acl->hasPermission('domains'))
						{
							echo
							"
							<li ".((isset($active_icon_unit)) ? $active_icon_unit : "").">
								<a href='".site_url('domains/domains-management')."'>
								<i class='fa fa-building'></i>
								<span class='title'>
									Instansi / Unit Kerja
								</span>
								".((isset($active_icon_unit)) ? "<span class='selected'></span>" : "")."
								</a>
							";
						}
						if($this->acl->hasPermission('mc'))
						{
							echo
							"
							</li>
								<li ".((isset($active_icon_mc)) ? $active_icon_mc : "").">
								<a href='".site_url('checkpoint/checkpoint-management')."'>
								<i class='fa fa-binoculars'></i>
								<span class='title'>
									Monitor & Checkpoint
								</span>
								".((isset($active_icon_mc)) ? "<span class='selected'></span>" : "")."
								</a>
							</li>
							";
						}
						if($this->acl->hasPermission('setting'))
						{
							echo
							"
							<li ".((isset($active_icon_setting)) ? $active_icon_setting : "").">
								<a href='javascript:;'>
								<i class='fa fa-cogs'></i>
								<span class='title'>
									Pengaturan
								</span>
								".((isset($active_icon_setting)) ? "<span class='selected'></span><span class='arrow open'></span>" : "<span class='arrow'></span>")."
								</a>
								<ul class='sub-menu'>
									<li ".((isset($active_icon_setting_users_management)) ? $active_icon_setting_users_management : "").">
										<a href='".site_url('setting/users-management')."'>
										<i class='fa fa-cog'></i> Pengaturan Pengguna
										</a>
									</li>
									<li ".((isset($active_icon_setting_roles_management)) ? $active_icon_setting_roles_management : "").">
										<a href='".site_url('setting/roles-management')."'>
										<i class='fa fa-cog'></i> Pengaturan Tingkatan Pengguna
										</a>
									</li>
									<li ".((isset($active_icon_setting_modules_management)) ? $active_icon_setting_modules_management : "").">
										<a href='".site_url('setting/modules-management')."'>
										<i class='fa fa-cog'></i> Pengaturan Modul
										</a>
									</li>
									<li ".((isset($active_icon_setting_rac)) ? $active_icon_setting_rac : "").">
										<a href='".site_url('setting/acl')."'>
										<i class='fa fa-cog'></i> Pengaturan Hak Akses
										</a>
									</li>
								</ul>
							";
						}
						if($this->acl->hasPermission('profile'))
						{
							echo "
							<li ".((isset($active_icon_profile)) ? $active_icon_profile : "").">
								<a href='".site_url('profile')."'>
								<i class='fa fa-user'></i>
								<span class='title'>
									Profil Pengguna
								</span>
								".((isset($active_icon_profile)) ? "<span class='selected'></span>" : "")."
								</a>
							</li>
							
							";
						}
						?>
					</ul>
					
				</div>
			</div>
			<div class="page-content-wrapper">
				<div id="preloader">
					<div id="status"></div>
				</div>
				<?php if(!empty($contents)) echo $contents;
					else redirect('error');
				?>
			</div>
			
		</div>
		
		<div class="footer">
			<div class="footer-inner">
				<?php 
					if(date('Y')==2018) echo '2018 &copy; Pemerintah Provinsi DKI Jakarta.';
					else 
					{
						echo '2018 - '.date('Y').' &copy; Pemerintah Provinsi DKI Jakarta.';	
					}
				?>
			</div>
			<div class="footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>
		
		
	</body>
	
</html>