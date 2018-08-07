<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#ukuran_edit').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
		$(".textarea").wysihtml5();
	}); 
	$('input[type="radio"]').change(function(){
    if (this.checked){
        $('.showForm').toggle(this.value === '2');
    }
	}).change();
	function replaceChars(entry) {
		out = "."; // replace this
		add = ""; // with this
		temp = "" + entry; // temporary holder

		while (temp.indexOf(out)>-1) {
		pos= temp.indexOf(out);
		temp = "" + (temp.substring(0, pos) + add + 
		temp.substring((pos + out.length), temp.length));
		}
	}

	function trimNumber(s) {
	  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
	  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
	  return s;
	}

	function formatangka(objek) {
		a = objek.value;
		b = a.replace(/[^\d]/g,"");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
		c = b.substr(i-1,1) + "." + c;
		} else {
		c = b.substr(i-1,1) + c;
		}
		}
		objek.value = trimNumber(c);
	}
</script>
<?php
if($ukuran->num_rows() > 0){
	$ukuran_detil = $ukuran->row();
}
?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Edit Ukuran Keberhasilan</b></h4>
		</div>
		<div class="modal-body">
			<?php 
					if(validation_errors() || isset($error_validasi_keuangan) || isset($error_validasi_fisik) || isset($error_validasi_jmlh_anggaran)){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>".validation_errors()."";
					if(isset($error_validasi_keuangan)) echo $error_validasi_keuangan;
					if(isset($error_validasi_fisik)) echo $error_validasi_fisik;
					if(isset($error_validasi_jmlh_anggaran)) echo $error_validasi_jmlh_anggaran;
					echo "</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('monitor/ukuran_edit/'.$this->encrypt->encode($ukuran_detil->id).'', 'id="ukuran_edit"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-12"><b>Jenis Ukuran Keberhasilan</b>
						</label>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<div class="radio-list">
									<label>
									<input type="radio" name="type" id="type" value="1" <?php echo set_value('type', $ukuran_detil->type) == 1 ? "checked" : ""; ?> > Kinerja Program</label>
									<label>
									<input type="radio" name="type" id="type" value="2" <?php echo set_value('type', $ukuran_detil->type) == 2 ? "checked" : ""; ?>> Kinerja Program dan Anggaran</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-12"><b>Ukuran Keberhasilan</b>
						</label>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea name="ukuran_keberhasilan" class="textarea" placeholder="Ukuran Keberhasilan.." style="width: 795px; height: 150px">
									<?php 
										echo set_value('ukuran_keberhasilan',$ukuran_detil->name);
									?>
								</textarea>
							</div>
						</div>
					</div>
					<span class="showForm">
						<div class="form-group">
							<label class="control-label col-md-12">Jumlah Anggaran (Rp)
							</label>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<div class="input-group">
									<i class="fa"></i>
									<input type="text" onkeyup="formatangka(this);replaceChars(document.f.a.value);" class="form-control text-right" name="jmlh_anggaran" value="<?php echo set_value('jmlh_anggaran',number_format($ukuran_detil->anggaran,0,',','.'));?>"/>
								</div>
							</div>
						</div>
					</span>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-12"><b>Ukuran Capaian</b>
						</label>
					</div>
					<?php
						$this->load->model('m_monitor');
						$ukuran_capaian = $this->m_monitor->get_ukuran_capaian_detil($ukuran_detil->id);
						if($ukuran_capaian->num_rows() > 0){
							foreach ($ukuran_capaian->result() as $row){
								if(isset($row->mc_week) && !empty($row->mc_week)) $week = "-M".sprintf("%02d", $row->mc_week);
								else $week="";
								echo "
								<div class='form-group'>
									<label class='control-label col-md-12'><b>T".$row->mc_year."-B".sprintf("%02d",$row->mc_month).$week."</b>
									</label>
								</div>
								<div class='form-group'>
									<div class='col-md-12'>
										<div class='input-icon right'>
											<i class='fa'></i>
											<textarea name='ukuran_capaian[]' class='textarea' placeholder='Ukuran Capaian..' style='width: 795px; height: 150px'>".set_value('',$row->uc_name)."</textarea>
										</div>
									</div>
								</div>
								<span class='showForm'>
									<div class='form-group'>
										<label class='control-label col-md-12'>Target Keuangan
										</label>
									</div>
									<div class='form-group'>
										<div class='col-md-2'>
											<div class='input-group'>
												<input type='number' step='any' class='form-control' name='target_keuangan[]' value='".set_value('target_keuangan[]',$row->uc_target_keuangan)."' size='6' maxlength='6'/><span class='input-group-addon'><strong>%</strong></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='control-label col-md-12'>Target Fisik
										</label>
									</div>
									<div class='form-group'>
										<div class='col-md-2'>
											<div class='input-group'>
												<input type='number' step='any' class='form-control' name='target_fisik[]' value='".set_value('target_fisik[]',$row->uc_target_fisik)."' size='6' maxlength='6'/><span class='input-group-addon'><strong>%</strong></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='control-label col-md-12'>
										</label>
										<div class='col-md-9'><i> * Penulisan desimal menggunakan tanda titik (.) Contoh 95.50</i>
										</div>
									</div>
								</span>
								";
								echo "<input type='hidden' name='ukuran_capaian_id[]' value='".$this->encrypt->encode($row->uc_id)."'/>";
							}
						}
					?>
					<input type="hidden" name="ukuran_id" value="<?php echo set_value('ukuran_id',$this->encrypt->encode($ukuran_detil->id)); ?>"/>
				</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('ubah', 'Ubah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>