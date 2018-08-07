<?php
	if ($domain->num_rows() > 0)
	{
		$domains_detil = $domain->row();
	}
	?>   
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Detil Instansi / Unit Kerja</b></h4>
		</div>
		<div class="modal-body"><div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-4"><strong>Instansi / Unit Kerja</strong>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">: 
								<?php echo $domains_detil->name;?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4"><strong>Instansi / Unit Kerja Induk</strong>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">:
								<?php echo $domains_detil->parent_name;?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4"><strong>Tingkatan</strong>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">:
								<?php echo $domains_detil->type;?>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-4"><strong>Status Instansi / Unit Kerja</strong>
						</label>
						<div class="col-md-8">
							<div class="input-icon right">:
								<?php 
								if($domains_detil->verified == 1) echo "Telah diverifikasi";
								else echo "Belum diverifikasi";
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/multiple-select/js/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/multiple-select/css/token-input-facebook.css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#instansi").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: <?php echo json_encode($prepopulate_instansi);?>	
		});
		});
	</script>