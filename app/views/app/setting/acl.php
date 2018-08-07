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
					Pengaturan Hak Akses
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
						<i class="fa fa-cog"></i> <b>Pengaturan Hak Akses</b>
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
								<th width ='10%' class='text-center'>
									<strong>Hak Akses</strong> 
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
									<td width ='10%' class='text-center'>
									<a href='".site_url('setting/acl-detil/'.$role_id.'')."' class='tip-top' data-original-title='Daftar Hak Akses'><i class='fa fa-paw'></i></a>
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=2 class='text-center'><strong>Tidak terdapat data tingakatan pengguna<strong></td>
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
