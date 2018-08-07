
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
							<a data-toggle='modal' data-target='#myModal' onclick='prioritas_add("<?php echo $monitor_encode;?>")'><button class='btn blue btn-xs'>
								Tambah Prioritas <i class='fa fa-plus-circle'></i>
							</button></a>
						</div>
					</div>
				</div>
			</div>
			<textarea class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
			</div>
		</div>
	</div>
</div>
</div>


