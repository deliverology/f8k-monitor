<script type="text/javascript">
	var controller = 'setting';
	var base_url = '<?php echo site_url(); ?>';
	
	function module_add(){
	$.ajax({
	'url' : base_url + controller + '/module_add',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function module_delete(id){
	$.ajax({
	'url' : base_url + controller + '/module_delete/' + id,
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
					Pengaturan Modul
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
						<i class="fa fa-cog"></i> <b>Pengaturan Modul</b>
					</div>
					<div class='caption pull-right'>
						<?php if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_module_add'))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='module_add()'><button class='btn blue btn-sm'>
								Tambah Modul <i class='fa fa-street-view'></i>
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
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='45%'><strong>Kata Kunci</strong></th>
								<th width ='45%'><strong>Tipe</strong></th>
								<th width ='10%' class='text-center'></th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($permissions->num_rows() > 0){
								foreach ($permissions->result() as $row){
								if($row->type == 1) $type = "Modul";
								else $type = "Fungsi";
								$id_encode = $this->encrypt->encode($row->id);
								echo "
								<tr>
									<td width ='45%'>$row->key</td>
									<td width ='45%'>$type</td>
									<td width ='10%' class='text-center'>
										<div class='btn-group'>";
											if($this->acl->hasRole(1)) echo "<a href='' class='tip-top' data-toggle='modal' data-target='#myModal' data-original-title='Hapus' onclick='module_delete(\"$id_encode\")'><i class='fa fa-trash'></i></a>";
											else echo "-";
											echo "
										</div>
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=6 class='text-center'><strong>Tidak terdapat data modul<strong></td>
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
