<script type="text/javascript">
	var controller = 'checkpoint';
	var base_url = '<?php echo site_url(); ?>';
	
	function monitor_status(id){
	$.ajax({
	'url' : base_url + controller + '/monitor_status/' + id,
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
				<b>Monitor & Checkpoint</b>
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
					Monitor & Checkpoint
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
						<i class="fa fa-building"></i> <b>Daftar Monitor</b>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
					</div>
					<div class="portlet-body">
						<?=form_open('checkpoint/checkpoint-management-search');?>
							<div class="row">
								<div class="col-md-2">
										<input type="text" name="key" placeholder="Kata kunci" class="form-control">
								</div>
								<div class="col-md-2">
										<?php 
										$options_search = array(
											'1' => 'Monitor',
											'2' => 'Tipe Monitor',
										);
										echo form_dropdown('option', $options_search, set_value('option',1), 'class="form-control"');
										?>
								</div>
								<div class="col-md-1">
										<?=form_submit('search', 'Search', 'class="btn blue"'); ?>
								</div>
							</div>
						<?php echo form_close(); ?>
						<br>
						<?php
						if(isset($search)){
							if($option == 1) $option_name = "Monitor";
							elseif($option == 2) $option_name = "Tipe Monitor";
							else $option_name = "Tingkatan";
							echo "
							<div class='alert alert-info'>
								<i class='fa fa-search-plus'></i> Kata kunci pencarian $option_name: <strong>$key <a href='".site_url('checkpoint/checkpoint-management')."'>[Reset] </a></strong> 
							</div>
							";
						}
						?>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='39%'>
									 <strong>Nama Monitor</strong>
								</th>
								<th width ='38%'>
									 <strong>Tipe Monitor</strong>
								</th>
								<th width ='13%' class='text-center'>
									 <strong>Status Monitor</strong>
								</th>
								<th width ='10%'>
									 
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($monitor->num_rows() > 0){
								foreach ($monitor->result() as $monitor_row){
								if($monitor_row->status == 0) $monitor_status = "Tidak Aktif";
								elseif ($monitor_row->status == 1) $monitor_status = "Pengisian";
								elseif ($monitor_row->status == 2) $monitor_status = "Pelaporan";
								else $monitor_status = "Arsip";
								$monitor_id_encode = $this->encrypt->encode($monitor_row->id);
								echo "
								<tr>
									<td width ='39%'>$monitor_row->name</td>
									<td width ='38%'>$monitor_row->type</td>
									<td width ='15%' class='text-center'>$monitor_status</td>
									<td width ='8%' align='center'>";
									if($this->acl->hasRole(1)||$this->acl->hasPermission('mc_monitor_status')) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='monitor_status(\"$monitor_id_encode\")' class='tip-top' data-original-title='Ubah Status Monitor'><i class='fa fa-eye'></i></a>";
									echo " <a href='".site_url('checkpoint/checkpoint-list/'.$monitor_id_encode.'')."' class='tip-top' data-original-title='Checkpoint'><i class='fa fa-check-square-o'></i></a>";
									echo "
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=4 class='text-center'><strong>Tidak terdapat data monitor<strong></td>
							</tr>
							";	
							}
							?>
							</tbody>
							</table>
							<div class="margin-top-20 text-center">
								<?php echo $paging;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static">
			</div>
		</div>
	</div>
</div>
