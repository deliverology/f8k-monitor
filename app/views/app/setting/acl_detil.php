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
					<a href="<?php echo site_url('setting/acl');?>">
					Pengaturan Modul
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Detil Pengaturan Modul
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
						<i class="fa fa-cog"></i> <b>Detil Pengaturan Hak Akses</b>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar"><div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='45%'><strong>Kata Kunci</strong></th>
								<th width ='45%'><strong>Tipe</strong></th>
								<th width ='10%' class='text-center'><strong>Status</strong></th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($acl_detil->num_rows() > 0){
								foreach ($acl_detil->result() as $row){
								if($row->acl_value == 1) $icon = "<i class='fa fa-check-circle'></i>";
								else $icon = "<i class='fa fa-times'></i>";
								if($row->type == 1) $type = "Modul";
								else $type = "Fungsi";
								$id_encode = $this->encrypt->encode($row->acl_id);
								echo "
								<tr>
									<td width ='45%'>$row->key</td>
									<td width ='45%'>$type</td>
									<td width ='10%' class='text-center'>
										<div class='btn-group'>";
											if($this->acl->hasRole(1)||$this->acl->hasPermission('setting_acl')) echo "<a href=".site_url('setting/acl-edit/'.$this->encrypt->encode($row->role_id).'/'.$this->encrypt->encode($row->acl_id).'')." class='btn btn-sm'>".$icon."</a>";
											else echo $icon;
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
