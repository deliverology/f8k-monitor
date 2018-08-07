<script type="text/javascript">
	var controller = 'setting';
	var base_url = '<?php echo site_url(); ?>';
	
	function user_add(){
	$.ajax({
	'url' : base_url + controller + '/user_add',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function reset_password(id){
	$.ajax({
	'url' : base_url + controller + '/reset_password/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function user_edit(id){
	$.ajax({
	'url' : base_url + controller + '/user_edit/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function user_delete(id){
	$.ajax({
	'url' : base_url + controller + '/user_delete/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function monitor_delete(id){
	$.ajax({
	'url' : base_url + controller + '/monitor_delete/' + id,
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
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b>Pengaturan</b>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url();?>">
					Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Pengaturan Pengguna
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
			<div class="portlet">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cog"></i> <b>Pengaturan Pengguna</b>
					</div>
					<div class='caption pull-right'>
						<?php if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_user_add'))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='user_add()'><button class='btn blue btn-sm'>
								Tambah Pengguna <i class='fa fa-user-plus'></i>
								</button></a>
								</div>
								";
							}
						?>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
					</div>
					<div class="portlet-body">
						<?=form_open('setting/users-management-search');?>
							<div class="row">
								<div class="col-md-2">
										<input type="text" name="key" placeholder="Kata kunci" class="form-control">
								</div>
								<div class="col-md-2">
										<?php 
										$options_search = array(
											'1' => 'Username',
											'2' => 'Email',
											'3' => 'Instansi / Unit Kerja Koordinasi'
										);
										echo form_dropdown('option', $options_search, set_value('option',1), 'class="form-control"');
										?>
								</div>
								<div class="col-md-1">
										<?=form_submit('search', 'Search', 'class="btn blue"'); ?>
								</div>
							</div>
						<?php echo form_close(); ?>
						<br>
						<?php
						if(isset($search)){
							if($option == 1) $option_name = "Username";
							elseif($option == 2) $option_name = "Email";
							else $option_name = "Instansi / Unit Kerja Koordinasi";
							echo "
							<div class='alert alert-info'>
								<i class='fa fa-search-plus'></i> Kata kunci pencarian $option_name: <strong>$key <a href='".site_url('setting/users-management')."'>[Reset] </a></strong> 
							</div>
							";
						}
						?>
						
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='15%'>
									 <strong>Username</strong>
								</th>
								<th width ='15%'>
									 <strong>Email</strong>
								</th>
								<th width ='35%'>
									 <strong>Instansi / Unit Kerja</strong>
								</th>
								<th width ='14%'>
									 <strong>Tingkatan</strong>
								</th>
								<th width ='13%'>
									 <strong>Status</strong>
								</th>
								<th width ='8%'>
									 
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($users->num_rows() > 0){
								foreach ($users->result() as $row){
								if($row->banned == 0) $status = "Aktif";
								else $status = "Non Aktif";
								$user_id = $this->encrypt->encode($row->user_id);
								echo "
								<tr>
									<td width ='15%'>$row->username</td>
									<td width ='15%'>$row->email</td>
									<td width ='35%'>$row->domain_name</td>
									<td width ='14%'>$row->role</td>
									<td width ='14%'>$status</td>
									<td width ='8%' class='text-center'>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_user_reset')) echo "<a href='' data-toggle='modal' data-target='#myModal' onclick='reset_password(\"$user_id\")' class='tip-top' data-original-title='Reset Password'><i class='fa fa-recycle fa-lg'></i></a>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_user_edit')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='user_edit(\"$user_id\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-lg'></i></a>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_user_delete')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='user_delete(\"$user_id\")' class='tip-top' data-original-title='Hapus'><i class='fa fa-trash-o fa-lg'></i></a>";
									echo "
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=6 class='text-center'><strong>Kata kunci pencarian tidak ditemukan<strong></td>
							</tr>
							";	
							}
							?>
							</tbody>
							</table>
							<div class="margin-top-20 text-center">
								<?php echo $paging;?>
							</div>
							
							<p>
								<?php 
								if($this->acl->hasRole(1)){
								echo "<strong><i>Default password : mY_P4ssw0rd</i></strong>";
								}
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
			</div>
		</div>
	</div>
</div>
