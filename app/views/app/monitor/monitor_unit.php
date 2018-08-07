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
<?php
	if($domain->num_rows()>0)
	{
		$domain_detil = $domain->row();
	}
?>
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b><?php if(isset($domain_detil->name))echo "$domain_detil->name";?></b>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href='<?php echo site_url()?>'>
					<i class="fa fa-home"></i>
					Beranda
					</a>
					<?php if(!$this->tank_auth->has_role(5)) echo "<i class='fa fa-angle-right'></i>";?>
				</li>
				<?php
				if(!$this->tank_auth->has_role(5)){
					echo "
					<li>	
						Monitor Unit
					</li>
					";
				}
				?>
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
					<div class="tools">
						<a href="javascript:;" class="reload">
						</a>
					</div>
				</div>
				<div class="portlet-body">
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
													if($row->monitor_type == 1) $link = 'monitor/monitor-view-unit';
													elseif($row->monitor_type == 2) $link = 'monitor-anggaran/monitor-view';
													$this->load->model('m_monitor');
													$domains_verifikator = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->monitor_verifikator));							
													$domains_verifikator_arr = Array();
													foreach($domains_verifikator->result_array() as $domain_verifikator_row)
													{array_push($domains_verifikator_arr,$domain_verifikator_row['name']);}
													sort($domains_verifikator_arr);
													
													$domains_observer = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->monitor_observer));							
													$domains_observer_arr = Array();
													foreach($domains_observer->result_array() as $domain_observer_row)
													{array_push($domains_observer_arr,$domain_observer_row['name']);}
													sort($domains_observer_arr);
													$monitor_id_encode = $this->encrypt->encode($row->monitor_id);
													echo "
													<tr>
													<td style='width: 33%'>$row->monitor_name</td>
													<td style='width: 30%'>".implode(', ',$domains_verifikator_arr)."</td>
													<td style='width: 30%'>".implode(', ',$domains_observer_arr)."</td>
													<td style='width: 7%' class='text-center' style='display: inline-block'>
													<a href='".site_url($link)."/".$this->encrypt->encode($row->monitor_id)."/".$this->encrypt->encode($row->kriteria_penanggung_jawab)."' class='tip-top' data-original-title='Detail Monitor' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>
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
													if($row->monitor_type == 1) $link = 'monitor/monitor-view-unit';
													elseif($row->monitor_type == 2) $link = 'monitor-anggaran/monitor-view';
													$this->load->model('m_monitor');
													$domains_verifikator = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->monitor_verifikator));							
													$domains_verifikator_arr = Array();
													foreach($domains_verifikator->result_array() as $domain_verifikator_row)
													{array_push($domains_verifikator_arr,$domain_verifikator_row['name']);}
													sort($domains_verifikator_arr);
													
													$domains_observer = $this->m_monitor->get_domains_verifikator($this->encrypt->encode($row->monitor_observer));							
													$domains_observer_arr = Array();
													foreach($domains_observer->result_array() as $domain_observer_row)
													{array_push($domains_observer_arr,$domain_observer_row['name']);}
													sort($domains_observer_arr);
													$monitor_id_encode = $this->encrypt->encode($row->monitor_id);
													echo "
													<tr>
													<td style='width: 33%'>$row->monitor_name</td>
													<td style='width: 30%'>".implode(', ',$domains_verifikator_arr)."</td>
													<td style='width: 30%'>".implode(', ',$domains_observer_arr)."</td>
													<td style='width: 7%' class='text-center' style='display: inline-block'>
													<a href='".site_url($link)."/".$this->encrypt->encode($row->monitor_id)."/".$this->encrypt->encode($row->kriteria_penanggung_jawab)."' class='tip-top' data-original-title='Detail Monitor' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
