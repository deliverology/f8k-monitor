<script type="text/javascript">
	var controller = 'domains';
	var base_url = '<?php echo site_url(); ?>';
	
	function domain_add(){
	$.ajax({
	'url' : base_url + controller + '/domain_add',
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function domain_view(id){
	$.ajax({
	'url' : base_url + controller + '/domain_view/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function domain_edit(id){
	$.ajax({
	'url' : base_url + controller + '/domain_edit/' + id,
	'type' : 'GET',
	'success' : function(data){ 
	var container = $('#myModal');
	if(data){
	container.html(data);
	}
	}
	});
	}
	function domain_delete(id){
	$.ajax({
	'url' : base_url + controller + '/domain_delete/' + id,
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
				<b>Instansi / Unit Kerja</b>
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
					Instansi / Unit Kerja
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
						<i class="fa fa-building"></i> <b>Daftar Instansi / Unit Kerja</b>
					</div>
					<div class='caption pull-right'>
						<?php if($this->acl->hasRole(1))
							{
								echo 
								"	
								<div class='btn-group'>
								<a data-toggle='modal' data-target='#myModal' onclick='domain_add()'><button class='btn blue btn-sm'>
								Tambah Instansi / Unit Kerja <i class='fa fa-building'></i>
								</button></a>
								</div>
								";
							}
						?>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
					</div>
					<div class="portlet-body">
						<?=form_open('domains/domains-management-search');?>
							<div class="row">
								<div class="col-md-2">
										<input type="text" name="key" placeholder="Kata kunci" class="form-control">
								</div>
								<div class="col-md-2">
										<?php 
										$options_search = array(
											'1' => 'Instansi / Unit Kerja',
											'2' => 'Instansi / Unit Kerja Induk',
											'3' => 'Tingkatan'
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
							if($option == 1) $option_name = "Instansi / Unit Kerja";
							elseif($option == 2) $option_name = "Instansi / Unit Kerja Induk";
							else $option_name = "Tingkatan";
							echo "
							<div class='alert alert-info'>
								<i class='fa fa-search-plus'></i> Kata kunci pencarian $option_name: <strong>$key <a href='".site_url('domains/domains-management')."'>[Reset] </a></strong> 
							</div>
							";
						}
						?>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
							<tr>
								<th width ='31%'>
									 <strong>Instansi / Unit Kerja</strong>
								</th>
								<th width ='31%'>
									 <strong>Instansi / Unit Kerja Induk</strong>
								</th>
								<th width ='30%'>
									 <strong>Tingkatan</strong>
								</th>
								<th width ='8%'>
									 
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if($domains->num_rows() > 0){
								foreach ($domains->result() as $domain_row){
								$domains_id_encode = $this->encrypt->encode($domain_row->id);
								echo "
								<tr>
									<td width ='31%'>$domain_row->name</td>
									<td width ='31%'>$domain_row->parent_name</td>
									<td width ='30%'>$domain_row->type</td>
									<td width ='8%' align='center'>";
									echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='domain_view(\"$domains_id_encode\")' class='tip-top' data-original-title='Detil'><i class='fa fa-file fa-lg'></i></a>";
									if($this->acl->hasRole(1)) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='domain_edit(\"$domains_id_encode\")' class='tip-top' data-original-title='Edit'><i class='fa fa-pencil-square fa-lg'></i></a>";
									if($this->acl->hasRole(1)) echo " <a href='' data-toggle='modal' data-target='#myModal' onclick='domain_delete(\"$domains_id_encode\")' class='tip-top' data-original-title='Hapus'><i class='fa fa-trash-o fa-lg fa-lg'></i></a>";
									echo "
									</td>
								</tr>
								";
								}
							}
							else {
							echo "
							<tr>
								<td colspan=4 class='text-center'><strong>Tidak terdapat data Instansi / Unit Kerja<strong></td>
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
