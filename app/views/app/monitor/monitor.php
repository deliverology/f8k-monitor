<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function add(){
	$.ajax({
	'url' : base_url + controller + '/monitor_add',
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
	'url' : base_url + controller + '/monitor_edit/' + id,
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
				<b>Monitor</b>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					Beranda
					</a>
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
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-globe"></i>Monitor
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
						<?php if($this->acl->hasRole(1))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='add()'><button class='btn btn-info'>
								Tambah Monitor <i class='fa fa-plus-circle'></i>
								</button></a>
								</div>
								";
							}
						?>
						
					</div>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
						
					</div>
					<div class="portlet-body">
						<div class="panel-group accordion" id="accordion1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
										<i class='fa fa-desktop'></i> <b>Monitor <?php echo date('Y')?></b>
										</a>
									</h4>
								</div>
								<div id="collapse_1" class="panel-collapse in">
									<div class="panel-body">
										<?php
											if ($list_monitor->num_rows() > 0)
											{
												echo "
												<div class='table-responsive'>												
												<table class='table table-striped table-bordered table-advance table-hover'>
												<thead>
												<tr>
												<th style='width: 33%'><strong>Monitor</strong></th>
												<th style='width: 30%'><strong>Verifikator</strong></th>
												<th style='width: 30%'><strong>Pemantau</strong></th>
												<th style='width: 7%'></th>
												</tr>
												</thead>
												<tbody>";
												$i=1;
												foreach ($list_monitor->result() as $row)
												{
													if($row->monitor_type_id == 1) $link = 'monitor/monitor-view';
													elseif($row->monitor_type_id == 2) $link = 'monitor-anggaran/monitor-view';
													$this->load->model('m_monitor');
													$domains_verifikator = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->verifikator_domains_id));							
													$domains_verifikator_arr = Array();
													foreach($domains_verifikator->result_array() as $domain_verifikator_row)
													{array_push($domains_verifikator_arr,$domain_verifikator_row['name']);}
													sort($domains_verifikator_arr);
													
													$domains_observer = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->observer_domains_id));							
													$domains_observer_arr = Array();
													foreach($domains_observer->result_array() as $domain_observer_row)
													{array_push($domains_observer_arr,$domain_observer_row['name']);}
													sort($domains_observer_arr);
													$monitor_id_encode = $this->encrypt->encode($row->id);
													echo "
													<tr>
													<td style='width: 33%'>$row->name</td>
													<td style='width: 30%'>".implode(', ',$domains_verifikator_arr)."</td>
													<td style='width: 30%'>".implode(', ',$domains_observer_arr)."</td>
													<td style='width: 7%' class='text-center' style='display: inline-block'>
													<a href='".site_url($link)."/".$this->encrypt->encode($row->id)."' class='tip-top' data-original-title='Detail Monitor' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>
													";
													if($this->acl->hasRole(1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Edit' data-toggle='modal' onclick='edit(\"$monitor_id_encode\")'><i class='fa fa-pencil-square fa-lg'></i></a>";
													if($this->acl->hasRole(1)) echo " <a href='' data-target='#myModal' class='tip-top' data-original-title='Hapus' data-toggle='modal' onclick='monitor_delete(\"$monitor_id_encode\")'><i class='fa fa-trash-o fa-lg'></i></a>";
													echo "
													</td>
													</tr>";
													$i++;
												}
												echo "
												</tbody>
												</table>
												</div>";
											}
											else
											{
												echo "
												<blockquote>
													<p>
														<b>Tidak terdapat monitor aktif</b>
													</p>
												</blockquote>";
											}
										?>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2">
										<i class='fa fa-archive'></i> <b>Monitor Arsip</b>
										</a>
									</h4>
								</div>
								<div id="collapse_2" class="panel-collapse collapse">
									<div class="panel-body" style="overflow-y:auto;">
										<?php
											if ($arsip->num_rows() > 0)
											{
												echo "
												<div class='table-responsive'>												
												<table class='table table-striped table-bordered table-advance table-hover'>
												<thead>
												<tr>
												<th style='width: 33%'><strong>Monitor</strong></th>
												<th style='width: 30%'><strong>Verifikator</strong></th>
												<th style='width: 30%'><strong>Pemantau</strong></th>
												<th style='width: 7%'></th>
												</tr>
												</thead>
												<tbody>";
												$i=1;
												foreach ($arsip->result() as $row)
												{
													if($row->monitor_type_id == 1) $link = 'monitor/monitor-view';
													elseif($row->monitor_type_id == 2) $link = 'monitor-anggaran/monitor-view';
													$this->load->model('m_monitor');
													$domains_verifikator = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->verifikator_domains_id));							
													$domains_verifikator_arr = Array();
													foreach($domains_verifikator->result_array() as $domain_verifikator_row)
													{array_push($domains_verifikator_arr,$domain_verifikator_row['name']);}
													sort($domains_verifikator_arr);
													
													$domains_observer = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->observer_domains_id));							
													$domains_observer_arr = Array();
													foreach($domains_observer->result_array() as $domain_observer_row)
													{array_push($domains_observer_arr,$domain_observer_row['name']);}
													sort($domains_observer_arr);
													$monitor_id_encode = $this->encrypt->encode($row->id);
													echo "
													<tr>
													<td style='width: 33%'>$row->name</td>
													<td style='width: 30%'>".implode(', ',$domains_verifikator_arr)."</td>
													<td style='width: 30%'>".implode(', ',$domains_observer_arr)."</td>
													<td style='width: 7%' class='text-center' style='display: inline-block'>
													<a href='".site_url($link)."/".$this->encrypt->encode($row->id)."' class='tip-top' data-original-title='Detail Monitor' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>
													</td>
													</tr>";
													$i++;
												}
												echo "
												</tbody>
												</table>
												</div>";
											}
											else
											{
												echo "
												<blockquote>
													<p>
														<b>Tidak terdapat monitor arsip</b>
													</p>
												</blockquote>";
											}
										?>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3">
										<i class='fa fa-link'></i> <b>Instansi / Unit Kerja Koordinasi</b>
										</a>
									</h4>
								</div>
								<div id="collapse_3" class="panel-collapse collapse">
									<div class="panel-body">
										<ul class="feeds">
											<?php 
											if($instansi_koordinasi->num_rows() > 0){
												foreach($instansi_koordinasi->result() as $row){
													echo "
													<li>
														<a href='".base_url('monitor/monitor-unit/'.$this->encrypt->encode($row->kriteria_penanggung_jawab).'')."'>
														<div class='col1'>
															<div class='cont'>
																<div class='cont-col1'>
																	<div class='label label-sm label-info'>
																		<i class='fa fa-building-o'></i>
																	</div>
																</div>
																<div class='cont-col2'>
																	<div class='desc'>
																		<font color='black'><strong>".$row->domain_name."</strong></font>
																	</div>
																</div>
															</div>
														</div>
														</a>
													</li>
													";
												}
											}
											else{
												echo "
													<blockquote>
														<p>
															<b>Tidak terdapat Instansi / Unit Kerja Koordinasi</b>
														</p>
													</blockquote>
												";
											}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
