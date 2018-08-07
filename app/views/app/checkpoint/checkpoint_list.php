<script type="text/javascript">
	var controller = 'checkpoint';
	var base_url = '<?php echo site_url(); ?>';
	
	function checkpoint_status(id){
	$.ajax({
	'url' : base_url + controller + '/checkpoint_status/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function checkpoint_delete(id){
	$.ajax({
	'url' : base_url + controller + '/checkpoint_delete/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function checkpoint_edit(id){
	$.ajax({
	'url' : base_url + controller + '/checkpoint_edit/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function checkpoint_add(id){
	$.ajax({
	'url' : base_url + controller + '/checkpoint_add/' + id,
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
	if($monitor_name->num_rows() > 0 )
	{
		$monitor_name_detil = $monitor_name->row();
	}
?>
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b>Monitor & Checkpoint</b>
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
					<a href="<?php echo site_url('checkpoint/checkpoint-management');?>">
					Monitor & Checkpoint
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Checkpoint
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
						<i class="fa fa-binoculars"></i> <b><?php echo $monitor_name_detil->name;?></b>
					</div>
					<div class='caption pull-right'>
						<?php if($this->acl->hasRole(1)||$this->acl->hasPermission('mc_checkpoint_add'))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='checkpoint_add(\"$monitor_id_encode\")'><button class='btn blue btn-sm'>
								Tambah Checkpoint <i class='fa fa-binoculars'></i>
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
								<th width ='5%'>
									 <strong>Id</strong>
								</th>
								<th width ='24%'>
									 <strong>Checkpoint</strong>
								</th>
								<th width ='24%' class='text-center'>
									 <strong>Tanggal Pembukaan Laporan</strong>
								</th>
								<th width ='24%' class='text-center'>
									 <strong>Tanggal Penutupan Laporan</strong>
								</th>
								<th width ='13%' class='text-center'>
									 <strong>Status Checkpoint</strong>
								</th>
								<th width ='10%'>
									 
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($checkpoint_list->num_rows() > 0){
								foreach ($checkpoint_list->result() as $checkpoint_list_row){
								if(isset($checkpoint_list_row->week)) $week = " M-".sprintf('%02d',$checkpoint_list_row->week);
								else $week = "";
									
								if($checkpoint_list_row->status == 1) $monitor_status = "Persiapan";
								elseif ($checkpoint_list_row->status == 2) $monitor_status = "Pelaporan";
								elseif ($checkpoint_list_row->status == 3) $monitor_status = "Verifikasi";
								else $monitor_status = "Arsip";
								$checkpoint_id_encode = $this->encrypt->encode($checkpoint_list_row->id);
								echo "
								<tr>
									<td width ='5%'>$checkpoint_list_row->id</td>
									<td width ='24%'>TA-".sprintf('%02d',$checkpoint_list_row->year)." B-".sprintf('%02d',$checkpoint_list_row->month).$week."</td>
									<td width ='24%' class='text-center'>".date("d-m-Y", strtotime($checkpoint_list_row->date_open))."</td>
									<td width ='24%' class='text-center'>".date("d-m-Y", strtotime($checkpoint_list_row->date_close))."</td>
									<td width ='15%' class='text-center'>$monitor_status</td>
									<td width ='8%' align='center'>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('mc_checkpoint_status')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='checkpoint_status(\"$checkpoint_id_encode\")' class='tip-top' data-original-title='Ubah Status Monitor'><i class='fa fa-eye'></i></a>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('mc_checkpoint_edit')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='checkpoint_edit(\"$checkpoint_id_encode\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-lg'></i></a>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('mc_checkpoint_delete')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='checkpoint_delete(\"$checkpoint_id_encode\")' class='tip-top' data-original-title='Hapus'><i class='fa fa-trash-o fa-lg fa-lg'></i></a>";
									echo "
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=6 class='text-center'><strong>Tidak terdapat data checkpoint<strong></td>
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
