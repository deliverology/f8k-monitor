<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#kriteria_add').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
		$(".textarea").wysihtml5();
	}); 
</script>  
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Tambah Kriteria Keberhasilan</b></h4>
		</div>
		<div class="modal-body">
			<?php 
				if(validation_errors()){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>Form (*) harus diisi</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('monitor/kriteria_add/"'.$renaksi.'"', 'id="kriteria_add"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-12"><b>Kriteria Keberhasilan</b>
							<span class="required">
								*
							</span>
						</label>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea name="name" class="textarea" placeholder="Kriteria Keberhasilan.." style="width: 795px; height: 150px"><?php echo set_value('name');?></textarea>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-12"><b>Penanggung Jawab</b>
							<span class="required">
								*
							</span>
						</label>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" id="input_penanggung_jawab" name="penanggung_jawab" value="<?php echo set_value('verifikator') ?>"/>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-12"><b>Instansi / Unit Kerja Koordinasi</b>
						</label>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" id="input_instansi_terkait" name="instansi_terkait"/>
							</div>
						</div>
					</div>
					<br><br>
					<input type="hidden" name="renaksi_id" value="<?php echo set_value('renaksi_id',$renaksi); ?>"/>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('tambah', 'Tambah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/multiple-select/js/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/multiple-select/css/token-input-facebook.css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#input_penanggung_jawab").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		tokenLimit: 1,
		prePopulate: []	
		});
		$("#input_instansi_terkait").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1
		});
		});
	</script>		