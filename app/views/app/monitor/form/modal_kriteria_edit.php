<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#kriteria_edit').ajaxForm(function(data) {
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
<?php 
	if ($kriteria->num_rows() > 0)
	{
		$kriteria_detil = $kriteria->row();
		$kriteria_encode = $this->encrypt->encode($kriteria_detil->id);
		$this->load->model('m_monitor');
		$prepopulate_penanggung_jawab = $this->m_monitor->get_domains_prepopulate($kriteria_detil->penanggung_jawab);
		$prepopulate_instansi_terkait = $this->m_monitor->get_domains_prepopulate($kriteria_detil->instansi_terkait);
	}
	
?>
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
			<?=form_open('monitor/kriteria_edit/"'.$kriteria_encode.'"', 'id="kriteria_edit"', array('class'=>'form-horizontal'));?>
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
								<textarea name="name" class="textarea" placeholder="Kriteria Keberhasilan.." style="width: 795px; height: 150px"><?php echo set_value('name',$kriteria_detil->name);?></textarea>
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
					<input type="hidden" name="kriteria_id" value="<?php echo set_value('kriteria_id',$kriteria_encode); ?>"/>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('ubah', 'Ubah', 'class="btn blue"'); ?>
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
		prePopulate: <?php echo json_encode($prepopulate_penanggung_jawab);?>		
		});
		$("#input_instansi_terkait").tokenInput("<?php echo base_url();?>domains/json_domains",{
		theme: "facebook",
		preventDuplicates: true,
		searchDelay: 1,
		prePopulate: <?php echo json_encode($prepopulate_instansi_terkait);?>	
		});
		});
	</script>		