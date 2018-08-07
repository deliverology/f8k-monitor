<script type="text/javascript">
	var controller = 'setting';
	var base_url = '<?php echo site_url(); ?>';
	
	function role_add(){
	$.ajax({
	'url' : base_url + controller + '/role_add',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function role_edit(id){
	$.ajax({
	'url' : base_url + controller + '/role_edit/' + id,
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
					Pengaturan Tingkatan Pengguna
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
						<i class="fa fa-cog"></i> <b>Pengaturan Tingkatan Pengguna</b>
					</div>
					<div class='caption pull-right'>
						<?php if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_role_add'))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='role_add()'><button class='btn blue btn-sm'>
								Tambah Tingkatan Pengguna <i class='fa fa-arrows-v'></i>
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
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='90%'>
									 <strong>Tingkatan Pengguna</strong>
								</th>
								<th width ='10%'>
									 
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($roles->num_rows() > 0){
								foreach ($roles->result() as $row){
								$role_id = $this->encrypt->encode($row->id);
								echo "
								<tr>
									<td width ='90%'>$row->role</td>
									<td width ='10%' align='center'>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_role_edit')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='role_edit(\"$role_id\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-lg'></i></a>";
									else "-";
									echo "
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=6 class='text-center'><strong>Tidak terdapat data tingakatan pengguna<strong></td>
							</tr>
							";	
							}
							?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
			</div>
		</div>
	</div>
</div>
