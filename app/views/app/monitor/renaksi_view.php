<script type="text/javascript">
	var controller = 'monitor';
	var base_url = '<?php echo site_url(); ?>';
	
	function kriteria_add(id){
		$.ajax({
		'url' : base_url + controller + '/kriteria_add/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function kriteria_edit(id){
		$.ajax({
		'url' : base_url + controller + '/kriteria_edit/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function kriteria_delete(id){
		$.ajax({
		'url' : base_url + controller + '/kriteria_delete/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function ukuran_add(id){
		$.ajax({
		'url' : base_url + controller + '/ukuran_add/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function ukuran_edit(id){
		$.ajax({
		'url' : base_url + controller + '/ukuran_edit/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function ukuran_delete(id){
		$.ajax({
		'url' : base_url + controller + '/ukuran_delete/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function lapor(id){
		$.ajax({
		'url' : base_url + controller + '/lapor/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function lapor_update(id){
		$.ajax({
		'url' : base_url + controller + '/lapor_update/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}

	function verifikasi(id){
		$.ajax({
		'url' : base_url + controller + '/verifikasi/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function verifikasi_update(id){
		$.ajax({
		'url' : base_url + controller + '/verifikasi_update/' + id,
		'type' : 'GET',
		'success' : function(data){ 
		var container = $('#myModal');
		if(data){
		container.html(data);
		}
		}
		});
	}
	function logs(id){
		$.ajax({
		'url' : base_url + controller + '/logs/' + id,
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
	if($renaksi_info->num_rows()>0)
	{
		$renaksi_info_detil = $renaksi_info->row();
		$monitor_encode = $this->encrypt->encode($renaksi_info_detil->monitor_id);
		$prioritas_encode = $this->encrypt->encode($renaksi_info_detil->prioritas_id);
		$program_encode = $this->encrypt->encode($renaksi_info_detil->program_id);
		$monitor_name = $renaksi_info_detil->monitor_name;
		$monitor_code = $renaksi_info_detil->monitor_code;
		$prioritas_serial = $renaksi_info_detil->prioritas_serial;
		$prioritas_name = $renaksi_info_detil->prioritas_name;
		$program_name = $renaksi_info_detil->program_name;
		$program_serial = $renaksi_info_detil->program_serial;
		$renaksi_id_encode = $this->encrypt->encode($renaksi_info_detil->renaksi_id);
		$renaksi_name = $renaksi_info_detil->renaksi_name;
		$renaksi_serial = $renaksi_info_detil->renaksi_serial;
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
					<a href="<?php echo site_url('monitor/program-browse')."/".$prioritas_encode;?>">
					Program
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo site_url('monitor/renaksi-browse')."/".$program_encode;?>">
					Output
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Detail
				</li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Detail Informasi
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<h4 class="form-section"><b>Output</b></h4>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group  label label-info full-width">
									<label class="control-label"><b>Monitor</b></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label text-left"><b>: <?php echo $monitor_name;?></b></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group label label-info full-width">
									<label class="control-label"><b>Prioritas</b></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label text-left"><b>: <?php echo $monitor_code.$prioritas_serial." - ".$prioritas_name;?></b></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group label label-info full-width">
									<label class="control-label"><b>Program</b></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label text-left"><b>: <?php echo "P".$program_serial." - ".$program_name;?></b></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group label label-info full-width">
									<label class="control-label"><b>Output</b></label>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label text-left"><b>: <?php echo "A".$renaksi_serial." - ".$renaksi_name;?></b></label>
								</div>
							</div>
						</div>
						<!--/Kriteria-->
						<hr width="100%">
						<div class="tabbable-custom ">
							<div class="caption pull-right">
								<div class='btn-group'>
									<?php
									if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1))
									echo "
										<a data-toggle='modal' data-target='#myModal' onclick='kriteria_add(\"$renaksi_id_encode\")'><button class='btn blue btn-xs'>
										Tambah Kriteria <i class='fa fa-plus-circle'></i>
									</button></a>
									";
									?>
								</div>
							</div>
							<br>
							<?php
								if ($kriteria->num_rows() > 0)
								{	
									echo "<ul class='nav nav-tabs'>";
									$kriteria_tab = 1;
									foreach ($kriteria->result() as $row)
									{
										echo "
										<li ".($kriteria_tab == 1 ? "class='active'":"").">
											<a href='#K".$kriteria_tab."' data-toggle='tab'>
											<b>K".$kriteria_tab."</b>
											</a>
										</li>
										";
										$kriteria_tab++;
									}
									echo "</ul>";
									echo "<div class='tab-content'>";
									$kriteria_content_tab = 1;
									foreach ($kriteria->result() as $row)
									{
										$kriteria_id_encode = $this->encrypt->encode($row->id);
										$ukuran_add = $monitor_encode.'/'.$kriteria_id_encode;
										if($kriteria_content_tab==1)$active = " active";
										else $active="";
										echo "
										<div class='tab-pane".$active."' id='K".$kriteria_content_tab."'>
											<div class='caption pull-right'>
												<div class='btn-group'>";
												if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1)) echo "<a href='' data-toggle='modal' data-target='#myModal' onclick='kriteria_edit(\"$kriteria_id_encode\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-2x'></i></a>";
												if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1)) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='kriteria_delete(\"$kriteria_id_encode\")' class='tip-top' data-original-title='Hapus'><i class='fa fa-trash-o fa-2x'></i></a>";
												echo "
												</div>
											</div>
										<p>
											<b><i>Kriteria Keberhasilan</i></b>
										</p>
										<p>
										".$row->name."
										</p>
										<hr width='100%'>
											<div class='row'>
												<div class='col-md-4'>
													<div class='form-group'>
														<label class='control-label'><b>Penanggung Jawab</b></label>
													</div>
												</div>
												<div class='col-md-8'>
													<div class='form-group'>
														<label class='control-label'><b>Instansi/Unit Kerja Koordinasi</b></label>
													</div>
												</div>
											</div>
											<div class='row' style ='background-color: #d9edf7;'>
												<div class='col-md-4'>
													<div class='form-group'>
														<label class='control-label'>".$row->domain_name."</label>
													</div>
												</div>
												<div class='col-md-8'>
													<div class='form-group'>
														<label class='control-label'>";
														$this->load->model('m_monitor');
														$domains = $this->m_monitor->get_instansi_koordinasi($row->instansi_terkait);
														if(isset($domains))echo implode(', ',$domains);
														echo"</label>
													</div>
												</div>
											</div>
											<hr width='100%'>
											<div class='tabbable-custom '>
												<div class='caption pull-right'>
													<div class='btn-group'>";
														if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1)) 
														echo "
															<a data-toggle='modal' data-target='#myModal' onclick='ukuran_add(\"$ukuran_add\")'>
																<button class='btn blue btn-xs'>
																	Tambah Ukuran <i class='fa fa-plus-circle'></i>
																</button>
															</a>";
													echo "
													</div>
												</div>
												<br>";
												$this->load->model('m_monitor');
												$ukuran = $this->m_monitor->get_ukuran_info($row->id);
												if($ukuran->num_rows() > 0){
													echo "<ul class='nav nav-tabs '>";
													$ukuran_tab = 1;
													foreach ($ukuran->result() as $row_ukuran){
														echo "
															<li ".($ukuran_tab == 1 ? "class='active'":"").">
																<a href='#U".$kriteria_content_tab.$ukuran_tab."' data-toggle='tab'>
																<b>U".$ukuran_tab."</b>
																</a>
															</li>
															";
															$ukuran_tab++;
													}
													echo"</ul>";
													echo"<div class='tab-content'>";
													$ukuran_content_tab = 1;
													foreach ($ukuran->result() as $row_ukuran){
														$ukuran_id_encode = $this->encrypt->encode($row_ukuran->id);
														echo"
														<div class='tab-pane".($ukuran_content_tab == 1 ? " active":"")."' id='U".$kriteria_content_tab.$ukuran_content_tab."'>
															<div class='caption pull-right'>
																<div class='btn-group'>";
																	if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1)) echo "<a href='' data-toggle='modal' data-target='#myModal' onclick='ukuran_edit(\"$ukuran_id_encode\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-2x'></i></a>";
																	if($this->acl->hasRole(1) || ($renaksi_info_detil->monitor_status == 1)) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='ukuran_delete(\"$ukuran_id_encode\")' class='tip-top' data-original-title='Hapus'><i class='fa fa-trash-o fa-2x'></i></a>";	
																echo "
																</div>
															</div>
															<p>
																<b><i>Ukuran Keberhasilan</i></b>
															</p>
															<p>
																".$row_ukuran->name."";
																if($row_ukuran->type == 2)
																{
																	echo "<br><b>Jumlah Anggaran:</b> Rp ".number_format($row_ukuran->anggaran,2,",",".");
																}
																echo "
															</p>
															<hr width='100%'>";
															$ukuran_checkpoint = $this->m_monitor->get_ukuran_checkpoint_info($row_ukuran->id);
															if($ukuran_checkpoint->num_rows()>0)
															{
																$i=0;
																$num_rows = $ukuran_checkpoint->num_rows();
																echo "
																<div class='table-responsive'>
																<table class='table table-condensed'>
																	<thead>
																		<tr>
																			<th width='10%'>Periode</th>
																			<th width='30%'>Target Capaian</th>
																			<th width='10%'>Capaian (%)</th> 
																			<th width='30%'>Keterangan / Kendala</th> 
																			<th width='20%'>Data Dukung</th> 
																		</tr>
																	</thead>
																	<tbody>
																";
																$x_axis = [];
																$y_target_keuangan = [];
																$y_target_fisik = [];
																$y_realisasi_keuangan = [];
																$y_realisasi_fisik = [];
																foreach($ukuran_checkpoint->result() as $row_ukuran_checkpoint){
																if($row_ukuran_checkpoint->status != 0 && $row_ukuran->type == 2)
																{
																	$x_axis[$i] = "'T".$row_ukuran_checkpoint->year."-B".sprintf('%02d',$row_ukuran_checkpoint->month).(isset($row_ukuran_checkpoint->week) && !empty($row_ukuran_checkpoint->week) ? "-M".sprintf("%02d", $row_ukuran_checkpoint->week)."":"")."'";
																	$y_target_keuangan[$i] = number_format($row_ukuran_checkpoint->target_keuangan,2,".",",");
																	$y_target_fisik[$i] = number_format($row_ukuran_checkpoint->target_fisik,2,".",",");
																}																
																if($row_ukuran_checkpoint->mc_status > 1 && $row_ukuran_checkpoint->status != 0 && $row_ukuran->type == 2)
																{
																	$y_realisasi_keuangan[$i] = number_format(($row_ukuran_checkpoint->realisasi_keuangan / $row_ukuran->anggaran *100),2,".",",");
																	$y_realisasi_fisik[$i] = number_format($row_ukuran_checkpoint->realisasi_fisik,2,".",",");
																}
																else
																{
																	$y_realisasi_keuangan[$i] = '';
																	$y_realisasi_fisik[$i] = '';
																}
																$uc_id_encode = $this->encrypt->encode($row_ukuran_checkpoint->id);
																if($num_rows-1 == $i)
																{
																	if($row_ukuran_checkpoint->status == 3)
																	{
																		if($row_ukuran_checkpoint->capaian >= 100)
																		{
																			$color = 'green';
																		}
																		else
																		{
																			$color = 'red';
																		}
																	}
																	elseif ($row_ukuran_checkpoint->status == 2)
																	{
																		$color = 'gray';
																	}
																	elseif ($row_ukuran_checkpoint->status == 1)
																	{
																		$color = 'red';
																	}
																}
																else
																{
																	if($row_ukuran_checkpoint->status == 3)
																	{
																		if($row_ukuran_checkpoint->capaian <= 50) $color = 'red';
																		elseif($row_ukuran_checkpoint->capaian > 50 && $row_ukuran_checkpoint->capaian <= 75) $color = 'yellow';
																		elseif($row_ukuran_checkpoint->capaian > 75 && $row_ukuran_checkpoint->capaian <= 100) $color = 'green';
																		elseif($row_ukuran_checkpoint->capaian > 100) $color = 'blue';
																	}
																	elseif ($row_ukuran_checkpoint->status == 2)
																	{
																		$color = 'gray';
																	}
																	elseif ($row_ukuran_checkpoint->status == 1)
																	{
																		$color = 'red';
																	}
																
																}
																echo "
																	<tr ".($i%2 == 0 ? "class='info'":"").">
																		<td>TA".$row_ukuran_checkpoint->year."-B".sprintf('%02d',$row_ukuran_checkpoint->month).(isset($row_ukuran_checkpoint->week) && !empty($row_ukuran_checkpoint->week) ? "-M".sprintf("%02d", $row_ukuran_checkpoint->week)."":"")."</td>
																		<td>".$row_ukuran_checkpoint->name."";
																			if($row_ukuran->type == 2)
																			{
																				echo "<br><br><strong>Progres Keuangan dan Fisik</strong><br>";
																				echo "Target Keuangan: ".number_format($row_ukuran_checkpoint->target_keuangan,2,",",".")." %<br>";
																				echo "Target Fisik: ".number_format($row_ukuran_checkpoint->target_fisik,2,",",".")." %";
																			}
																		echo "
																		</td>
																		<td align='center'><div class='score-box-detil ".$color."'>".$row_ukuran_checkpoint->capaian."</div></td>
																		<td>
																			<div class='btn-group'>";
																			if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 1 && $this->acl->hasRole(5) && ($this->acl->getUserDomains() == $row->penanggung_jawab || $this->acl->hasRole(1))){
																			echo "
																				<a data-toggle='modal' data-target='#myModal' class='tip-top' data-original-title='Lapor Capaian' onclick='lapor(\"$uc_id_encode\")'><button class='btn info btn-xs'>
																					<Strong>Lapor</Strong> <i class='fa fa-comment-o'></i>
																				</button></a>";
																			}
																			if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 2 && $this->acl->hasRole(5) && ($this->acl->getUserDomains() == $row->penanggung_jawab || $this->acl->hasRole(1))){
																			echo "
																				<a data-toggle='modal' data-target='#myModal' class='tip-top' data-original-title='Ubah Capaian' onclick='lapor_update(\"$uc_id_encode\")'><button class='btn info btn-xs'>
																					<Strong>Ubah Capaian</Strong> <i class='fa fa-comment-o'></i>
																				</button></a>";
																			}
																			if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 3 && $row_ukuran_checkpoint->status == 2 && ($this->acl->hasRole(1) || $this->acl->hasRole(2) || $this->acl->hasRole(3))){	
																			echo "
																				<a data-toggle='modal' data-target='#myModal' class='tip-top' data-original-title='Verifikasi Laporan' onclick='verifikasi(\"$uc_id_encode\")'><button class='btn info btn-xs'>
																					<Strong>Verifikasi</Strong> <i class='fa fa-eye'></i>
																				</button></a>";
																			}
																			if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 3 && $row_ukuran_checkpoint->status == 3 && ($this->acl->hasRole(1) || $this->acl->hasRole(2) || $this->acl->hasRole(3))){	
																			echo "
																				<a data-toggle='modal' data-target='#myModal' class='tip-top' data-original-title='Ubah Hasil Verifikasi' onclick='verifikasi_update(\"$uc_id_encode\")'><button class='btn info btn-xs'>
																					<Strong>Ubah Hasil Verifikasi</Strong> <i class='fa fa-eye'></i>
																				</button></a>";
																			}
																			echo "
																				<a data-toggle='modal' data-target='#myModal' class='tip-top' data-original-title='Catatan Aktivitas' onclick='logs(\"$uc_id_encode\")'><button class='btn info btn-xs'>
																					<Strong>Log</Strong> <i class='fa fa-info-circle'></i>
																				</button></a>
																			</div>
																			<br><br>
																			<div class='btn-group'>";
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 1 && $this->acl->hasRole(5) &&($this->acl->getUserDomains() == $row->penanggung_jawab || $this->acl->hasRole(1))){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-bullhorn'></i> <Strong>Silakan melapor</Strong>
																				</div>
																				";
																				}
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 1 && ($this->acl->hasRole(2) || $this->acl->hasRole(3) || $this->acl->hasRole(4))){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-bullhorn'></i> <Strong>Sedang proses pelaporan</Strong>
																				</div>
																				";
																				}
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 2 && $this->acl->getUserDomains() == $row->penanggung_jawab && $this->acl->hasRole(5)){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-bullhorn'></i> <Strong>Anda sudah melapor, Mohon menunggu proses verifikasi</Strong>
																				</div>
																				";
																				}
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 2 && $row_ukuran_checkpoint->status == 2 && ($this->acl->hasRole(1) || $this->acl->hasRole(2) || $this->acl->hasRole(3))){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-bullhorn'></i> <Strong>Penanggung jawab telah melaporkan capaian</Strong>
																				</div>
																				";
																				}
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 3 && $row_ukuran_checkpoint->status == 2){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-info-circle'></i> <Strong>Menunggu verifikasi</Strong>
																				</div>
																				";
																				}
																				if($renaksi_info_detil->monitor_status == 2 && $row_ukuran_checkpoint->mc_status == 3 && $row_ukuran_checkpoint->status == 3){
																				echo "
																				<div class='well' style='padding:5px;'>
																					<i class='fa fa-info-circle'></i> <Strong>Verifikasi telah dilakukan </Strong>
																				</div>
																				";
																				}
																			echo "
																			</div>
																			<hr>";		
																			if($row_ukuran->type == 2 && $renaksi_info_detil->monitor_status >= 2 && $row_ukuran_checkpoint->mc_status >= 2)
																			{	
																				echo "<strong>Progres Keuangan dan Fisik</strong>";
																				echo "<br>Realisasi Keuangan: ".number_format(($row_ukuran_checkpoint->realisasi_keuangan / $row_ukuran->anggaran * 100),2,",",".")." %";
																				echo "<br>Realisasi Fisik: ".number_format($row_ukuran_checkpoint->realisasi_fisik,2,",",".")." %<br><br>";
																			}
																			echo "
																			<strong>Keterangan:</strong><br>
																			".$row_ukuran_checkpoint->keterangan."
																		</td>
																		<td>
																		<ul>";
																			$files = $this->m_monitor->get_files($row_ukuran_checkpoint->id);
																			if($files->num_rows() > 0)
																			{
																				foreach($files->result() as $file)
																				{
																				echo "<li><a href='".site_url('download/files/'.$file->name.'')."'>$file->name</a></li>";	
																				}
																			}
																		echo"
																		</ul>
																		</td>
																	</tr>
																";
																$i++;
																}
																echo "
																	</tbody>
																</table>
																</div>
																";
															}
														if($row_ukuran->type == 2)
														{
															echo "
															<hr width='100%'>
															<h4><b>Progres Keuangan</b></h4>
																<br><br>
																<div align='center' id='line_keuangan".$kriteria_content_tab.$ukuran_content_tab."' style='max-width: 80%; height: 400px; margin: 0 auto'></div>
																<script>
																$(function () {
																	$('#line_keuangan".$kriteria_content_tab.$ukuran_content_tab."').highcharts({
																		title: {	
																			text: '<b>Progres Keuangan</b><br><b>Target dan Realisasi</b>',
																			x: -20 //center
																		},
																		chart: {
																			borderColor: '#4572A7',
																			borderWidth: 2,
																			type: 'line'
																		},
																		xAxis: {
																			title: {
																				text: '<b>Periode</b>'
																			},
																			categories: [".implode(',',$x_axis)."],
																			labels: {
																				style: {
																					color: '#525151',
																					font: '10px times',
																					fontWeight: 'bold'
																				}
																			},
																		},
																		yAxis: {
																			title: {
																				text: '<b>Persentase ( % )</b>'
																			},
																			min: 0,
																			max: 100,
																			tickInterval: 10,
																			plotLines: [{
																				value: 0,
																				width: 1,
																				color: '#808080'
																			}],
																			labels: {
																				style: {
																					color: '#525151',
																					font: '12px times',
																					fontWeight: 'bold'
																				}
																			}
																		},
																		credits: {enabled: false},
																		tooltip: {
																			valueSuffix: '%'
																		},
																		legend: {
																			layout: 'vertical',
																			align: 'center',
																			verticalAlign: 'bottom',
																			borderWidth: 0
																		},
																		series: [{
																			name: 'Target Keuangan',
																			data: [".implode(',',$y_target_keuangan)."]
																		}, {
																			name: 'Realisasi Keuangan',
																			data: [".implode(',',$y_realisasi_keuangan)."]
																		}]
																	});
																});
																</script>
															";
															echo "
															<hr width='100%'>
															<h4><b>Progres Fisik</b></h4>
																<br><br>
																<div align='center' id='line_fisik".$kriteria_content_tab.$ukuran_content_tab."' style='max-width: 80%; height: 400px; margin: 0 auto'></div>
																<script>
																$(function () {
																	$('#line_fisik".$kriteria_content_tab.$ukuran_content_tab."').highcharts({
																		title: {	
																			text: '<b>Progres Fisik</b><br><b>Target dan Realisasi</b>',
																			x: -20 //center
																		},
																		chart: {
																			borderColor: '#4572A7',
																			borderWidth: 2,
																			type: 'line'
																		},
																		xAxis: {
																			title: {
																				text: '<b>Periode</b>'
																			},
																			categories: [".implode(',',$x_axis)."],
																			labels: {
																				style: {
																					color: '#525151',
																					font: '10px times',
																					fontWeight: 'bold'
																				}
																			},
																		},
																		yAxis: {
																			title: {
																				text: '<b>Persentase ( % )</b>'
																			},
																			min: 0,
																			max: 100,
																			tickInterval: 10,
																			plotLines: [{
																				value: 0,
																				width: 1,
																				color: '#808080'
																			}],
																			labels: {
																				style: {
																					color: '#525151',
																					font: '12px times',
																					fontWeight: 'bold'
																				}
																			}
																		},
																		credits: {enabled: false},
																		tooltip: {
																			valueSuffix: '%'
																		},
																		legend: {
																			layout: 'vertical',
																			align: 'center',
																			verticalAlign: 'bottom',
																			borderWidth: 0
																		},
																		series: [{
																			name: 'Target Fisik',
																			data: [".implode(',',$y_target_fisik)."]
																		}, {
																			name: 'Realisasi Fisik',
																			data: [".implode(',',$y_realisasi_fisik)."]
																		}]
																	});
																});
																</script>
															";
														}
														echo"
														</div>
														";
														
														$ukuran_content_tab++;
													}
													echo"</div>";
												}
												echo"
												
											</div>	
										</div>
										";
										$kriteria_content_tab++;
									}
									echo "</div>";
								}
							?>
						</div>
						
					</div>
					<!-- END FORM-->
				</div>
			</div>
			<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
			</div>
		</div>
	</div>
</div>
</div>