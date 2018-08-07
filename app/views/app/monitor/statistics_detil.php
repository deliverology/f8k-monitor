<?php
	if($statistic->num_rows()>0)
	{
		$statistic_detil = $statistic->row();
		$monitor_encode = $this->encrypt->encode($statistic_detil->monitor_id);
		$monitor_name = $statistic_detil->monitor_name;
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
					<a href="<?php if(isset($monitor_encode)) echo site_url('monitor/monitor-view')."/".$monitor_encode;?>">
					<?php if(isset($monitor_name))echo $monitor_name;?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Detail Statistik
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
						<i class="fa fa-desktop"></i><?php if(isset($monitor_name))echo $monitor_name;?> 
					</div>
				</div>
				<div class="portlet-body">
					<div class='table-responsive'>												
						<table class='table table-striped table-bordered table-advance table-hover'>
							<thead>
								<tr>
									<th style="width: 5%"><strong>Kode</strong></th>
									<th style="width: 88%"><strong>Nama Output</strong></th>
									<th style="width: 7%"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($statistic->num_rows() > 0)
									{
										$i=1;
										foreach ($statistic->result() as $row)
										{
											$renaksi_id_encode = $this->encrypt->encode($row->renaksi_id);
											echo "
											<tr>
											<td style='width: 5%' class='text-left'>".$row->monitor_code.$row->prioritas_serial."P".$row->program_serial."A".$row->renaksi_serial."</td>
											<td style='width: 88%'>".$row->renaksi_name."<i> (".$row->jmlh_sub_renaksi." Sub Output)</i></td>
											<td style='width: 7%' class='text-center'>
											<a href='".site_url('monitor/renaksi-view')."/".$renaksi_id_encode."' class='tip-top' data-original-title='Detail Renaksi' data-toggle='tooltip'><i class='fa fa-file fa-lg'></i></a>
											</td>
											</tr>
											";
										}
									}else echo "
									<blockquote>
									<p>
									<b>Tidak terdapat data rencana aksi</b>
									</p>
									</blockquote>
									";
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
