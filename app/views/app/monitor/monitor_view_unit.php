<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function export_data(id){
	$.ajax({
	'url' : base_url + controller + '/export_unit/' + id,
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
	}
	if($domain->num_rows()>0)
	{
		$domain_detil = $domain->row();
	}
?>
<script type='text/javascript' src='<?php echo base_url('assets/plugins/googlechart.js')?>'></script>
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<b><?php if(isset($domain_detil->name))echo "$domain_detil->name";?></b>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url();?>">
					Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<?php if(isset($monitor_detil->name)&&!$this->tank_auth->has_role(5)) 
				echo "
				<li>
					<a href='".site_url('monitor/monitor-unit/'.$this->uri->rsegment(4).'')."'>Monitor Unit</a>
					<i class='fa fa-angle-right'></i>
				</li>
				";
				?>
				<li>
					<?php if(isset($monitor_detil->name))echo $monitor_detil->name;?>
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
						
						<i class="fa fa-desktop"></i> <b><?php if(isset($monitor_detil->name))echo $monitor_detil->name;?></b>
					</div>
					<div class='caption pull-right'>
						<div class="btn-group">
							<a data-toggle='modal' data-target='#myModal' onclick='export_data("<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4);?>")'>
								<button class='btn default blue-stripe btn-xs'>
									Export
								</button>
                            </a>
						</div>
					</div>
				</div>
				<div class="portlet-body">
					<b>
					<div class="tabbable">
						<?php
						if(isset($statistik) && !empty($statistik)){
							echo "<ul class='nav nav-tabs'>";
							$i = 1;
							foreach($statistik as $row_tab){
								if($i == 1)$tab = "class = 'active'";
								else $tab = "";
								if($row_tab['week'] != null) $week = "-M".$row_tab['week'];
								else $week = "";
								echo"
								<li ".$tab.">
									<a href='#tab_".$i."' data-toggle='tab'>
										 T".$row_tab['year']."-B".sprintf('%02d',$row_tab['month']).$week."
									</a>
								</li>
								";
								$i++;
							}
							echo "</ul>";
						}
						?>
						<?php
						if(isset($statistik) && !empty($statistik)){
							echo "
							<div class='tab-content'>
							";
							$count = count($statistik);
							$i = 1;
							foreach($statistik as $row_tab_content){
								if(isset($row_tab_content['tidak_ada_target'])) {
									$tidak_ada_target = count($row_tab_content['tidak_ada_target']);
									$link_tidak_ada_target = implode('_',$row_tab_content['tidak_ada_target']);
								}else {
									$tidak_ada_target = 0;
									$link_tidak_ada_target = '';
								}
								if(isset($row_tab_content['target_akhir_tidak_tercapai'])) {
									$target_akhir_tidak_tercapai = count($row_tab_content['target_akhir_tidak_tercapai']);
									$link_target_akhir_tidak_tercapai = implode('_',$row_tab_content['target_akhir_tidak_tercapai']);
								} else {
									$target_akhir_tidak_tercapai = 0;
									$link_target_akhir_tidak_tercapai = '';
								}
								if(isset($row_tab_content['tidak_lapor'])) {
									$tidak_lapor = count($row_tab_content['tidak_lapor']); 
									$link_tidak_lapor = implode('_',$row_tab_content['tidak_lapor']); 
								} else {
									$tidak_lapor = 0;
									$link_tidak_lapor = '';
								}
								if(isset($row_tab_content['verifikasi'])) {
									$verifikasi = count($row_tab_content['verifikasi']); 
									$link_verifikasi = implode('_',$row_tab_content['verifikasi']); 
								} else {
									$verifikasi = 0;
									$link_verifikasi = '';
								}
								if(isset($row_tab_content['target_akhir_tercapai'])) {
									$target_akhir_tercapai = count($row_tab_content['target_akhir_tercapai']); 
									$link_target_akhir_tercapai = implode('_',$row_tab_content['target_akhir_tercapai']); 
								} else {
									$target_akhir_tercapai = 0;
									$link_target_akhir_tercapai = '';
								}
								if(isset($row_tab_content['target_antara_tidak_sempurna'])) {
									$target_antara_tidak_sempurna = count($row_tab_content['target_antara_tidak_sempurna']); 
									$link_target_antara_tidak_sempurna = implode('_',$row_tab_content['target_antara_tidak_sempurna']); 
								} else {
									$target_antara_tidak_sempurna = 0;
									$link_target_antara_tidak_sempurna = '';
								}
								if(isset($row_tab_content['target_antara_tercapai'])) {
									$target_antara_tercapai = count($row_tab_content['target_antara_tercapai']);
									$link_target_antara_tercapai = implode('_',$row_tab_content['target_antara_tercapai']);
								} else {
									$target_antara_tercapai = 0;
									$link_target_antara_tercapai = '';
								}
								if(isset($row_tab_content['melampaui_target_antara'])) {
									$melampaui_target_antara = count($row_tab_content['melampaui_target_antara']); 
									$link_melampaui_target_antara = implode('_',$row_tab_content['melampaui_target_antara']); 
								} else {
									$melampaui_target_antara = 0;
									$link_melampaui_target_antara = '';
								}
								if(isset($row_tab_content['target_antara_tidak_tercapai'])) {
									$target_antara_tidak_tercapai = count($row_tab_content['target_antara_tidak_tercapai']); 
									$link_target_antara_tidak_tercapai = implode('_',$row_tab_content['target_antara_tidak_tercapai']); 
								} else {
									$target_antara_tidak_tercapai = 0;
									$link_target_antara_tidak_tercapai = '';
								}
								
								$hasil_akhir_hijau = $target_akhir_tercapai;
								$hasil_akhir_merah = $target_akhir_tidak_tercapai+$tidak_lapor;
								$hasil_akhir_abu = $tidak_ada_target+$verifikasi;
								$total_akhir = $hasil_akhir_hijau+$hasil_akhir_merah+$hasil_akhir_abu;
								
								$hasil_antara_biru = $melampaui_target_antara;
								$hasil_antara_hijau = $target_akhir_tercapai+$target_antara_tercapai;
								$hasil_antara_kuning = $target_antara_tidak_sempurna;
								$hasil_antara_merah = $target_akhir_tidak_tercapai+$tidak_lapor+$target_antara_tidak_tercapai;
								$hasil_antara_abu= $tidak_ada_target+$verifikasi; 
								$total_antara = $hasil_antara_biru+$hasil_antara_hijau+$hasil_antara_kuning+$hasil_antara_merah+$hasil_antara_abu;
								if($i == 1)$tab = " active";
								else $tab = "";
								if($row_tab_content['week'] != null) $week = "Minggu ke-".$row_tab_content['week'].", ";
								else $week = "";
								$result = $row_tab_content['month']."/1/20".$row_tab_content['year'];
								$month = $this->general->convert_date_id(date('M',strtotime($result)));
								$year = date('Y',strtotime($result));
								echo"
								<div class='tab-pane".$tab."' id='tab_".$i."'>
									<div class='form-group'>";
										if($i == $count){
										echo "
										<div class='col-md-6 col-sm-6'>
											<div class='portlet box blue'>
												<div class='portlet-title'>
													<div class='caption'>
														<i class='fa fa-bar-chart-o'></i>Statistik
													</div>
												</div>
												<div class='portlet-body'>
													<div style='height: 400px;'>
													<p class='text-center'>".$week.$month." ".$year."</p>
													<table>
														<tr>
															<td><div class='score-box green'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_akhir_hijau."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																	".($target_akhir_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_akhir_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_akhir_tercapai.' Target akhir tercapai</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box red'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_akhir_merah."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																	".($target_akhir_tidak_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_akhir_tidak_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_akhir_tidak_tercapai.' Target akhir tidak tercapai</a></li>')."
																	".($tidak_lapor == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_tidak_lapor).'/'.$this->uri->segment(4).'').'">'.$tidak_lapor.' Tidak melapor</a></li>')."
																	</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box gray'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_akhir_abu."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																   ".($tidak_ada_target == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_tidak_ada_target).'/'.$this->uri->segment(4).'').'">'.$tidak_ada_target.' Tidak ada target</a></li>')."
																   ".($verifikasi == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_verifikasi).'/'.$this->uri->segment(4).'').'">'.$verifikasi.' Menunggu verifikasi</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><hr color='black'></td>
															<td><hr color='black'></td>
														</tr>
														<tr>
															<td style='font-size:150%;'>Total</td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$total_akhir."</td>
														</tr>
														<tr>
															<td colspan='2'><br><br><br><br><br>
																<span class='tip-top' data-html='true' data-original-title='Target Antara :<br>Biru (x &gt; 100)<br>Hijau (100 &ge; x &gt; 75)<br>Kuning (75 &ge; x &gt; 50)<br>Merah (50 &ge; x)<br><br> Target Akhir : <br>Hijau (x &ge; 100)<br>Merah (100 &gt; x)'><i>*) Keterangan</i></span>
															</td>
														</tr>
													</table>
													</div>
												</div>
											</div>
										</div>
										<div class='col-md-6 col-sm-6'>
											<div class='portlet box blue'>
												<div class='portlet-title'>
													<div class='caption'>
														<i class='fa fa-bar-chart-o'></i>Grafik
													</div>
												</div>
												<div class='portlet-body'>
													<div style='height: 400px;'>
														<script type='text/javascript'>
															$(function () {
																$(document).ready(function () {
																	Highcharts.setOptions({
																	 colors: ['#5ab710','#ED1C24','#999999']
																	});
																	// Build the chart
																	$('#container".$i."').highcharts({
																		chart: {
																			plotBackgroundColor: null,
																			plotBorderWidth: null,
																			plotShadow: false,
																			type: 'pie'
																		},
																		title: {
																			text: '".$week.$month." ".$year."',
																			style: {'fontSize': '13px'},
																		},
																		tooltip: {
																			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
																		},
																		plotOptions: {
																			pie: {
																				allowPointSelect: true,
																				cursor: 'pointer',
																				dataLabels: {
																					enabled: false
																				},
																				showInLegend: true
																			}
																		},
																		credits: {enabled: false},
																		series: [{
																			name: 'Capaian',
																			colorByPoint: true,
																			data: [{
																				name: 'Hijau',
																				y: ".$hasil_akhir_hijau.",
																			}, {
																				name: 'Merah',
																				y: ".$hasil_akhir_merah."
																			}, {
																				name: 'Abu-abu',
																				y: ".$hasil_akhir_abu."
																			}]
																		}]
																	});
																});
															});
														</script>
														<div id='container".$i."' style='width: 310px; height: 400px; margin: 0 auto'></div>
													</div>
												</div>
											</div>
										</div>
										";	
										}
										else{
										echo "
										<div class='col-md-6 col-sm-6'>
											<div class='portlet box blue'>
												<div class='portlet-title'>
													<div class='caption'>
														<i class='fa fa-bar-chart-o'></i>Statistik
													</div>
												</div>
												<div class='portlet-body'>
													<div style='height: 425px;'>
													<p class='text-center'>".$week.$month." ".$year."</p>
													<table>
														<tr>
															<td style='vertical-align:middle;'><div class='score-box blue'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_antara_biru."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																 ".($melampaui_target_antara == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_melampaui_target_antara).'/'.$this->uri->segment(4).'').'">'.$melampaui_target_antara.' Melampaui target</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box green'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_antara_hijau."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																	 ".($target_akhir_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_akhir_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_akhir_tercapai.' Target akhir tercapai</a></li>')."
																	 ".($target_antara_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_antara_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_antara_tercapai.' Target antara tercapai</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box yellow'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_antara_kuning."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																	".($target_antara_tidak_sempurna == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_antara_tidak_sempurna).'/'.$this->uri->segment(4).'').'">'.$target_antara_tidak_sempurna.' Capaian belum sempurna</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box red'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_antara_merah."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																	".($target_akhir_tidak_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_akhir_tidak_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_akhir_tidak_tercapai.' Target akhir tidak tercapai</a></li>')."
																	".($target_antara_tidak_tercapai == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_target_antara_tidak_tercapai).'/'.$this->uri->segment(4).'').'">'.$target_antara_tidak_tercapai.' Target antara tidak tercapai</a></li>')."
																	".($tidak_lapor == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_tidak_lapor).'/'.$this->uri->segment(4).'').'">'.$tidak_lapor.' Tidak melapor</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><div class='score-box gray'></div></td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$hasil_antara_abu."</td>
															<td style='vertical-align:middle;padding:5px;'>
																<ul>
																  ".($verifikasi == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_verifikasi).'/'.$this->uri->segment(4).'').'">'.$verifikasi.' Menunggu verifikasi</a></li>')."
																  ".($tidak_ada_target == 0 ? '' : '<li><a href="'.site_url('monitor/statistics-detil-unit/'.$this->encrypt->encode($monitor_detil->id).'/'.$this->encrypt->encode($link_tidak_ada_target).'/'.$this->uri->segment(4).'').'">'.$tidak_ada_target.' Tidak terdapat target</a></li>')."
																</ul>
															</td>
														</tr>
														<tr>
															<td><hr color='black'></td>
															<td><hr color='black'></td>
														</tr>
														<tr>
															<td style='font-size:150%;'>Total</td>
															<td style='vertical-align:middle;padding:10px;font-size:200%;'>".$total_antara."</td>
														</tr>
														<tr>
															<td colspan='2'>
																<span class='tip-top' data-html='true' data-original-title='Target Antara :<br>Biru (x &gt; 100)<br>Hijau (100 &ge; x &gt; 75)<br>Kuning (75 &ge; x &gt; 50)<br>Merah (50 &ge; x)<br><br> Target Akhir : <br>Hijau (x &ge; 100)<br>Merah (100 &gt; x)'><i>*) Keterangan</i></span>
															</td>
														</tr>
													</table>
													</div>
												</div>
											</div>
										</div>
										<div class='col-md-6 col-sm-6'>
											<div class='portlet box blue'>
												<div class='portlet-title'>
													<div class='caption'>
														<i class='fa fa-bar-chart-o'></i>Grafik
													</div>
												</div>
												<div class='portlet-body'>
													<div style='height: 425px;'>
														<script type='text/javascript'>
															$(function () {
																$(document).ready(function () {
																	Highcharts.setOptions({
																	 colors: ['#0073ea', '#5ab710', '#d8b900','#ED1C24','#999999']
																	});
																	// Build the chart
																	$('#container".$i."').highcharts({
																		chart: {
																			plotBackgroundColor: null,
																			plotBorderWidth: null,
																			plotShadow: false,
																			type: 'pie'
																		},
																		title: {
																			text: '".$week.$month." ".$year."',
																			style: {'fontSize': '13px'},
																		},
																		tooltip: {
																			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
																		},
																		plotOptions: {
																			pie: {
																				allowPointSelect: true,
																				cursor: 'pointer',
																				dataLabels: {
																					enabled: false
																				},
																				showInLegend: true
																			}
																		},
																		credits: {enabled: false},
																		series: [{
																			name: 'Capaian',
																			colorByPoint: true,
																			data: [{
																				name: 'Biru',
																				y: ".$hasil_antara_biru."
																			}, {
																				name: 'Hijau',
																				y: ".$hasil_antara_hijau.",
																			}, {
																				name: 'Kuning',
																				y: ".$hasil_antara_kuning."
																			}, {
																				name: 'Merah',
																				y: ".$hasil_antara_merah."
																			}, {
																				name: 'Abu-abu',
																				y: ".$hasil_antara_abu."
																			}]
																		}]
																	});
																});
															});
														</script>
														<div id='container".$i."' style='width: 310px; height: 400px; margin: 0 auto'></div>
													</div>
												</div>
											</div>
										</div>
										";
										}
									echo "
										
									</div>	
								</div>	
								";
								$i++;
							}
							echo "
							</div>
							";
						}
						else
						{
						echo "
							<ul class='nav nav-tabs'>
								<li class = 'active'>
									<a href='#tab_empty' data-toggle='tab'>Tidak ada data
									</a>
								</li>
							</ul>
							<div class='tab-pane active' id='tab_empty'>
							<div class='form-group'>
								<div class='col-md-6 col-sm-6'>
									<div class='portlet box blue'>
										<div class='portlet-title'>
											<div class='caption'>
												<i class='fa fa-bar-chart-o'></i>Grafik
											</div>
										</div>
										<div class='portlet-body'>
											<div style='height: 400px;'>
											<p>Tidak ada datat</p>
											<table>
												<tr>
													<td><div class='score-box green'></div></td>
													<td style='vertical-align:middle;padding:10px;font-size:200%;'>0</td>
													<td style='vertical-align:middle;padding:5px;'>
													</td>
												</tr>
												<tr>
													<td><div class='score-box red'></div></td>
													<td style='vertical-align:middle;padding:10px;font-size:200%;'>0</td>
													<td style='vertical-align:middle;padding:5px;'>
													</td>
												</tr>
												<tr>
													<td><div class='score-box gray'></div></td>
													<td style='vertical-align:middle;padding:10px;font-size:200%;'>0</td>
													<td style='vertical-align:middle;padding:5px;'>
													</td>
												</tr>
												<tr>
													<td><hr color='black'></td>
													<td><hr color='black'></td>
												</tr>
												<tr>
													<td style='font-size:150%;'>Total</td>
													<td style='vertical-align:middle;padding:10px;font-size:200%;'>0</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class='col-md-6 col-sm-6'>
									<div class='portlet box blue'>
										<div class='portlet-title'>
											<div class='caption'>
												<i class='fa fa-bar-chart-o'></i>Grafik
											</div>
										</div>
										<div class='portlet-body'>
											<div style='height: 400px;'>
											<script type='text/javascript'>
													$(function () {
														$(document).ready(function () {
															Highcharts.setOptions({
															 colors: ['#999999']
															});
															// Build the chart
															$('#empty').highcharts({
																chart: {
																	plotBackgroundColor: null,
																	plotBorderWidth: null,
																	plotShadow: false,
																	type: 'pie'
																},
																title: {
																	text: 'Tidak ada data',
																	style: {'fontSize': '13px'},
																},
																tooltip: {
																	pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
																},
																plotOptions: {
																	pie: {
																		allowPointSelect: true,
																		cursor: 'pointer',
																		dataLabels: {
																			enabled: false
																		},
																		showInLegend: true
																	}
																},
																credits: {enabled: false},
																series: [{
																	name: 'Capaian',
																	colorByPoint: true,
																	data: [{
																		name: 'Abu-abu',
																		y: 0
																	}]
																}]
															});
														});
													});
												</script>
												<div id='empty' style='width: 310px; height: 400px; margin: 0 auto'></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						";	
						}
						?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
						
					</div>
				</div>
				</b>
				<hr width="100%">
					<div class="caption">
						<h4><i class="fa fa-file-text"></i> <b>Output</b></h4>
					</div>
					<ul class="feeds">
						<?php 
						if($renaksi->num_rows() > 0){
							foreach($renaksi->result() as $row){
								echo "
								<li>
									<a href='".base_url('monitor/renaksi-view-unit/'.$this->encrypt->encode($row->renaksi_id).'/'.$this->uri->segment(4).'')."'>
									<div class='col1'>
										<div class='cont'>
											<div class='cont-col1'>
												<div class='label label-sm label-info'>
													<i class='fa fa-list-ul'></i>
												</div>
											</div>
											<div class='cont-col2'>
												<div class='desc'>
													<b>".$row->monitor_code.$row->prioritas_serial."P".$row->program_serial."A".$row->renaksi_serial." $row->renaksi_name <i>($row->sub_renaksi Sub Output)</i></b>
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
								<li>
									<div class='col-md-10'>
										<blockquote>
											<h5>Tidak terdapat output</h5>
										</blockquote>
									</div>
								</li>
							";
						} 
						?>
					</ul>
			</div>
		</div>
	</div>
