<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function program_add(id){
	$.ajax({
	'url' : base_url + controller + '/program_add/' + id,
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
			'url' : base_url + controller + '/program_edit/' + id,
			'type' : 'GET',
			'success' : function(data){ 
				var container = $('#myModal');
				if(data){
					container.html(data);
				}
			}
		});
	}

	function program_delete(id){
		$.ajax({
			'url' : base_url + controller + '/program_delete/' + id,
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
	if($prioritas_info->num_rows()>0)
	{
		$prioritas_info_detil = $prioritas_info->row();
		$monitor_encode = $this->encrypt->encode($prioritas_info_detil->monitor_id);
		$prioritas_encode = $this->encrypt->encode($prioritas_info_detil->prioritas_id);
		$monitor_name = $prioritas_info_detil->monitor_name;
		$monitor_code = $prioritas_info_detil->monitor_code;
		$prioritas_serial = $prioritas_info_detil->prioritas_serial;
		$prioritas_name = $prioritas_info_detil->prioritas_name;
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
					<?php echo $monitor_name;?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo site_url('monitor/browse')."/".$monitor_encode;?>">
					Prioritas
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Program
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
						<i class="fa fa-desktop"></i><?php echo $monitor_code.$prioritas_serial.' - '.$prioritas_name; ?>
					</div>
					<div class="caption pull-right">
						<div class='btn-group'>
							<?php
								if($this->acl->hasRole(1) || ($prioritas_info_detil->monitor_status == 1)){
								echo "
									<a data-toggle='modal' data-target='#myModal' onclick='program_add(\"$prioritas_encode\")'>
										<button class='btn blue btn-xs'>
											Tambah Program <i class='fa fa-plus-circle'></i>
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
									<th style="width: 88%"><strong>Nama Program</strong></th>
									<th style="width: 7%"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($program->num_rows() > 0)
									{
										$i=1;
										foreach ($program->result() as $row)
										{
											$program_id_encode = $this->encrypt->encode($row->program_id);
											echo "
											<tr>
											<td style='width: 5%' class='text-left'>".$monitor_code.$prioritas_serial."P".$row->program_serial."</td>
											<td style='width: 88%'>".$row->program_name."</td>
											<td style='width: 7%' class='text-center'>
												<a href='".site_url('monitor/renaksi-browse')."/"."$program_id_encode' class='tip-top' data-original-title='Daftar Output' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>";
												if($this->acl->hasRole(1) || ($prioritas_info_detil->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Edit' data-toggle='modal' onclick='edit(\"$program_id_encode\")'><i class='fa fa-pencil-square fa-lg'></i></a>";
												if($this->acl->hasRole(1) || ($prioritas_info_detil->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Hapus' data-toggle='modal' onclick='program_delete(\"$program_id_encode\")'><i class='fa fa-trash-o fa-lg'></i></a>";
											echo "
											</td>
											</tr>
											";
										}
									}else echo "
									<tr>
										<td colspan='3' class='text-center'><strong>Tidak terdapat data program</strong></td>
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
