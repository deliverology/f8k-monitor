<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function prioritas_add(id){
	$.ajax({
	'url' : base_url + controller + '/prioritas_add/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function edit(id){
	$.ajax({
	'url' : base_url + controller + '/prioritas_edit/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function prioritas_delete(id){
	$.ajax({
	'url' : base_url + controller + '/prioritas_delete/' + id,
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
	if($monitor->num_rows()>0)
	{
		$monitor_detil = $monitor->row();
		$monitor_encode = $this->encrypt->encode($monitor_detil->id);
	}
?>
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b>Monitor</b>
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
					<a href="<?php echo site_url('monitor/monitor-view')."/".$monitor_encode;?>">
					<?php echo $monitor_detil->name;?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Prioritas
				</li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-desktop"></i>Prioritas 
					</div>
					<div class="caption pull-right">
						<div class='btn-group'>
							<?php
								if($this->acl->hasRole(1) || ($monitor_detil->status == 1)){
								echo "
									<a data-toggle='modal' data-target='#myModal' onclick='prioritas_add(\"$monitor_encode\")'>
										<button class='btn blue btn-xs'>
											Tambah Prioritas <i class='fa fa-plus-circle'></i>
										</button>
									</a>
								";
								}
							?>
							
						</div>
					</div>
				</div>
				<div class="portlet-body">
					<div class='table-responsive'>												
						<table class='table table-striped table-bordered table-advance table-hover'>
							<thead>
								<tr>
									<th style="width: 5%"><strong>Kode</strong></th>
									<th style="width: 88%"><strong>Nama Prioritas</strong></th>
									<th style="width: 7%"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($prioritas->num_rows() > 0)
									{
										$i=1;
										foreach ($prioritas->result() as $row)
										{
											$prioritas_id_encode = $this->encrypt->encode($row->prioritas_id);
											echo "
											<tr>
											<td style='width: 5%' class='text-left'>".$row->monitor_code.$row->prioritas_serial."</td>
											<td style='width: 88%'>".$row->prioritas_name."</td>
											<td style='width: 7%' class='text-center'>
												<a href='".site_url('monitor/program-browse')."/".$prioritas_id_encode."' class='tip-top' data-original-title='Daftar Program' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>";
												if($this->acl->hasRole(1) || ($monitor_detil->status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Edit' data-toggle='modal' onclick='edit(\"$prioritas_id_encode\")'><i class='fa fa-pencil-square fa-lg'></i></a>";
												if($this->acl->hasRole(1) || ($monitor_detil->status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Hapus' data-toggle='modal' onclick='prioritas_delete(\"$prioritas_id_encode\")'><i class='fa fa-trash-o fa-lg'></i></a>";
											echo "	
											</td>
											</tr>
											";
										}
									}else echo "
									<tr>
										<td colspan='3' class='text-center'><strong>Tidak terdapat data prioritas</strong></td>
									</tr>
									";
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
				</div>
			</div>
		</div>
	</div>
</div>
