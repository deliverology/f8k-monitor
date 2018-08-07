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
						<i class="fa fa-desktop"></i>Daftar Program 
					</div>
				</div>
				<div class="portlet-body">
					<div class="panel-group accordion" id="accordion1">
						<?php
							if ($program->num_rows() > 0)
							{
								$i=1;
								foreach($program->result() as $program_list)
								{
									echo "
										<div class='panel panel-default'>
											<div class='panel-heading'>
												<h4 class='panel-title'>
													<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion1' href='#collapse_".$i."'>
													<i class='fa fa-files-o'></i> <b>".$program_list->monitor_code.$program_list->prioritas_serial."P".$program_list->program_serial." ".$program_list->program_name."</b>
													</a>
												</h4>
											</div>
											<div id='collapse_".$i."' class='panel-collapse ".(($i==1)? 'in' : 'collapse')."'>
												<div class='panel-body'>";
												$this->load->model('m_monitor');
												$renaksi = $this->m_monitor->get_renaksi_list($this->encrypt->encode($program_list->program_id));
												if($renaksi->num_rows() > 0)
												{
													echo "
														<div class='table-responsive'>												
															<table class='table table-striped table-bordered table-advance table-hover'>
																<thead>
																	<tr>
																		<th style='width: 5%'><strong>Kode</strong></th>
																		<th style='width: 88%'><strong>Nama Output</strong></th>
																		<th style='width: 7%'></th>
																	</tr>
																</thead>
																<tbody>";
																	if ($renaksi->num_rows() > 0)
																	{
																		foreach ($renaksi->result() as $row)
																		{
																			$program_id_encode = $this->encrypt->encode($row->program_id);
																			$renaksi_id_encode = $this->encrypt->encode($row->renaksi_id);
																			echo "
																			<tr>
																			<td style='width: 5%' class='text-left'>".$row->monitor_code.$row->prioritas_serial."P".$row->program_serial."A".$row->renaksi_serial."</td>
																			<td style='width: 88%'>".$row->renaksi_name."</td>
																			<td style='width: 7%' class='text-center'>
																				<a href='".site_url('monitor/renaksi-view')."/"."$renaksi_id_encode' class='tip-top' data-original-title='Daftar Renaksi' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>";
																				if($this->acl->hasRole(1) || ($program_list->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Edit' data-toggle='modal' onclick='edit(\"$renaksi_id_encode\")'><i class='fa fa-pencil-square fa-lg'></i></a>";
																				if($this->acl->hasRole(1) || ($program_list->monitor_status == 1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Hapus' data-toggle='modal' onclick='renaksi_delete(\"$renaksi_id_encode\")'><i class='fa fa-trash-o fa-lg'></i></a>";
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
																echo "
																</tbody>
															</table>
														</div>
													";
												}
											echo "
												</div>
											</div>
										</div>
									";
									$i++;
								}
							}
							else
							{
								echo "
									<div class='panel panel-default'>
										<div class='panel-heading'>
											<h4 class='panel-title'>
												<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion1' href='#collapse_empty'>
												<i class='fa fa-files-o'></i> <b>Tidak terdapat program</b>
												</a>
											</h4>
										</div>
										<div id='collapse_empty' class='panel-collapse in'>
										</div>
									</div>
								";
							}
						?>
					</div>
				</div>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
				</div>
			</div>
		</div>
	</div>
</div>
