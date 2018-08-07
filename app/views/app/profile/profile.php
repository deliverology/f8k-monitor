<script type="text/javascript">
	var base_url = '<?php echo site_url(); ?>';
	
	function change_password(){
	$.ajax({
	'url' : base_url + 'auth' + '/change_password',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function change_email(){
	$.ajax({
	'url' : base_url + 'profile' + '/change_email',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function edit(){
	$.ajax({
	'url' : base_url + 'profile' + '/edit',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
</script>
<?php
	if($profile->num_rows() > 0)
	{
		$profile_detil = $profile->row();
	}
?>
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b>Profil Pengguna</b>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url();?>">
					Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Profil 
				</li>
				
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-user"></i>Data Akun
					</div>
					<div class="tools">
						
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Username</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled value="<?php echo $profile_detil->username; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Alamat Email</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled value="<?php echo $profile_detil->email; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Tingkatan Pengguna</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled value="<?php echo $profile_detil->role; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Nama</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled name='name' value="<?php echo $profile_detil->name; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Jabatan</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled value="<?php echo $profile_detil->position; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3"><strong>Hp</strong>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" disabled value="<?php echo $profile_detil->phone; ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">
						</label>
						<div class="col-md-6">
							<div class='btn-group'>
								<?php 
								if($this->acl->hasPermission('profile_change_data'))
								echo 
								"
								<a data-toggle='modal' data-target='#myModal' onclick='edit()'>
									<button class='btn btn-info'>
									Ubah Data <i class='fa fa-pencil-square-o'></i>
									</button>
								</a>
								";
								if($this->acl->hasPermission('profile_change_email'))
								echo
								"
								<a data-toggle='modal' data-target='#myModal' onclick='change_email()'>
									<button class='btn btn-info'>
									Ubah Email <i class='fa fa-envelope'></i>
									</button>
								</a>
								";
								if($this->acl->hasPermission('profile_change_password'))
								echo
								"
								<a data-toggle='modal' data-target='#myModal' onclick='change_password()'>
									<button class='btn btn-info'>
									Ubah Password <i class='fa fa-key'></i>
									</button>
								</a>
								";
								?>
							</div>	
						</div>
						<br><br>
					</div>
					<?php echo form_close(); ?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static"></div>
				</div>
			</div>
		</div>
	</div>
</div>
