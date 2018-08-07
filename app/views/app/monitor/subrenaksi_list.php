<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function edit(id){
	$.ajax({
	'url' : base_url + controller + '/renaksi_edit/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	
	function renaksi_delete(id){
	$.ajax({
	'url' : base_url + controller + '/renaksi_delete/' + id,
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
					Sub Output
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
						<i class="fa fa-desktop"></i>Daftar Output 
					</div>
				</div>
				<div class="portlet-body">
					<div class='table-responsive'>												
						<table class='table table-striped table-bordered table-advance table-hover'>
							<thead>
								<tr>
									<th style='width: 5%'><strong>Kode</strong></th>
									<th style='width: 88%'><strong>Nama Output</strong></th>
									<th style='width: 7%'></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if ($renaksi->num_rows() > 0)
								{
									foreach ($renaksi->result() as $row)
									{
										$renaksi_id_encode = $this->encrypt->encode($row->renaksi_id);
										echo "
										<tr>
										<td style='width: 5%' class='text-left'>".$row->monitor_code.$row->prioritas_serial."P".$row->program_serial."A".$row->renaksi_serial."</td>
										<td style='width: 88%'>".$row->renaksi_name." <i>(".$row->sub_renaksi." Sub Output)</i></td>
										<td style='width: 7%' class='text-center'>
											<a href='".site_url('monitor/renaksi-view')."/"."$renaksi_id_encode' class='tip-top' data-original-title='Detail Output' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>";
											if($this->acl->hasRole(1) || ($row->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Edit' data-toggle='modal' onclick='edit(\"$renaksi_id_encode\")'><i class='fa fa-pencil-square fa-lg'></i></a>";
											if($this->acl->hasRole(1) || ($row->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Hapus' data-toggle='modal' onclick='renaksi_delete(\"$renaksi_id_encode\")'><i class='fa fa-trash-o fa-lg'></i></a>";
										echo "
										</td>
										</tr>
										";
									}
								}else echo "
								<tr>
									<td colspan='3' class='text-center'><strong>Tidak terdapat data output</strong></td>
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
