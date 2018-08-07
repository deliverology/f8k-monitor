<script> 
    // wait for the DOM to be loaded 
    jQuery(document).ready(function() {
		
		$('#verifikasi').ajaxForm(function(data) {
			if(data == 'success') {
				location.reload();
				} else {
				var container = $('#myModal');
				container.html(data);
			}
		}); 
		$(".textarea").wysihtml5();
	}); 
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
if($uc->num_rows() > 0)
{
	$uc_detil = $uc->row();
	$ukuran = $u_type->row();
}
?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Ubah Verifikasi Capaian</b></h4>
		</div>
		<div class="modal-body">
			<?php 
				if(isset($data_dukung))$lampiran = "<br>Tidak ada data dukung";
				else $lampiran = "";
				if(validation_errors() || isset($data_dukung)){
					echo "
					<div class='form-group'>
					<label class='control-label col-md-12'><div class='alert alert-danger'>
					<button class=close data-close='alert'></button>
					<div class='text-center'>".validation_errors()."$lampiran</div>
					</div></label>
					</div>";
				}
			?>
			<?=form_open('monitor/verifikasi_update/'.$uc_id_encode.'', 'id="verifikasi"', array('class'=>'form-horizontal'));?>
			<div class="form-body">
				<div class="scroller" data-always-visible="1" data-rail-visible1="1">
					<div class="form-group">
						<label class="control-label col-md-3">Verifikasi <?php if($ukuran->type == 2) echo "keseluruhan";?> Sebelumnya
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" class="form-control" disabled name="capaian" value="<?php echo set_value('capaian',$uc_detil->capaian) ?>"/><span class="input-group-addon"><strong>%</strong></span>
							</div>
						</div>
					</div>
					<?php 
					if($ukuran->type == 2)
					{
						echo "
						<br><br>
						<div class='form-group'>
							<label class='control-label col-md-3'>Verifikasi Realisasi Keuangan Sebelumnya
								<span class='required'>
									*
								</span>
							</label>
							<div class='col-md-3'>
								<div class='input-group'>
									<span class='input-group-addon'><strong>Rp</strong></span>
									<input type='text' class='form-control' disabled name='realisasi_keuangan' value='".set_value('realisasi_keuangan',number_format($uc_detil->realisasi_keuangan,0,',','.'))."'/>
								</div>
							</div>
						</div>
						<br><br>
						<div class='form-group'>
							<label class='control-label col-md-3'>Verifikasi Realisasi Fisik Sebelumnya
								<span class='required'>
									*
								</span>
							</label>
							<div class='col-md-3'>
								<div class='input-group'>
									<input type='text' class='form-control' disabled name='realisasi_fisik' value='".set_value('realisasi_fisik',$uc_detil->realisasi_fisik)."'/><span class='input-group-addon'><strong>%</strong></span>
								</div>
							</div>
						</div>
						";
					}
					?>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Ubah Hasil Verifikasi <?php if($ukuran->type == 2) echo "keseluruhan";?>
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" class="form-control" name="capaian_verifikasi" value="<?php echo set_value('capaian_verifikasi',$uc_detil->capaian) ?>"/><span class="input-group-addon"><strong>%</strong></span>
							</div>
						</div>
					</div>
					<?php 
					if($ukuran->type == 2)
					{
						echo "
						<br><br>
						<div class='form-group'>
							<label class='control-label col-md-3'>Ubah Hasil Verifikasi Realisasi Keuangan
								<span class='required'>
									*
								</span>
							</label>
							<div class='col-md-3'>
								<div class='input-group'>
									<span class='input-group-addon'><strong>%</strong></span>
									<input type='text' class='form-control text-right' onkeyup='formatangka(this);replaceChars(document.f.a.value);' name='ubah_verifikasi_realisasi_keuangan' value='".set_value('ubah_verifikasi_realisasi_keuangan',number_format($uc_detil->realisasi_keuangan,0,',','.'))."'/>
								</div>
							</div>
						</div>
						<br><br>
						<div class='form-group'>
							<label class='control-label col-md-3'>Ubah Hasil Verifikasi Realisasi Fisik
								<span class='required'>
									*
								</span>
							</label>
							<div class='col-md-3'>
								<div class='input-group'>
									<input type='text' class='form-control' name='ubah_verifikasi_realisasi_fisik' value='".set_value('ubah_verifikasi_realisasi_fisik',$uc_detil->realisasi_fisik)."'/><span class='input-group-addon'><strong>%</strong></span>
								</div>
							</div>
						</div>
						";
					}
					?>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">
						</label>
						<div class="col-md-9"><i>Penulisan desimal menggunakan tanda titik (.) Contoh 95.50</i>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Keterangan / Kendala
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea name="keterangan" value="" class="textarea" placeholder="Keteranga / Kendala.." style="width: 590px; height: 150px"><?php echo set_value('ketarangan',$uc_detil->keterangan);?></textarea><br>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">Data Dukung
							<span class="required">
								*
							</span>
						</label>
						<div class="col-md-9">
							<div class="input-icon right">
									<input type="file" name="userfile" id="upload_btn" />
								<div class="uploadify-queue" id="file-queue"></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">
						</label>
						<div class="form-group col-md-9">
							<div class="input-icon right">
								<div id="files"></div>
							</div>
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-3">
							<i><small><span class="required">*</span> Harus diisi</small></i>
						</label>
						<div class="col-md-9"></div>
					</div>
						<input type="hidden" name="uc_id_encode" value="<?php echo set_value('uc_id_encode',$uc_id_encode); ?>"/>
						<input type="hidden" name="ukuran_type" value="<?php echo set_value('ukuran_type',$ukuran->type); ?>"/>
			</div>
			</div>
			<div class="modal-footer">
				<?=form_submit('ubah', 'Ubah', 'class="btn blue"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type='text/javascript' >
				$(function() {
					$('#upload_btn').uploadify({
						'debug'   : false,
						
						'swf'   : '<?php echo base_url('assets/plugins/uplodify/uploadify.swf');?>',
						'uploader'  : '<?php echo base_url('upload/lapor_update').'/'.$this->encrypt->encode($uc_detil->id);?>',
						'cancelImage' : '<?php echo base_url('assets/plugins/uplodify/uploadify-cancel.png'); ?>',
						'queueID'  : 'file-queue',
						'buttonClass'  : 'button',
						'buttonText' : "Upload",
						'multi'   : true,
						'auto'   : true,
						
						'fileTypeExts' : '*.jpg; *.JPG; *.png; *.PNG; *.gif; *.GIF; *.jpeg; *.JPEG; *.tiff ; *.TIFF; *.bmp ; *.BMP; *.doc ; *.DOC; *.docx ; *.DOCX; *.ppt ; *.PPT; *.pptx ; *.PPTX; *.odp ; *.ODP; *.pdf ; *.PDF; *.pps ; *.PPS; *.ppsx ; *.PPSX; *.txt ; *.TXT; *.xlsx ; *.XLSX; *.xls ; *.XLS; *.csv ; *.CSV; *.7z ; *.7Z; *.zip ; *.ZIP; *.rar ; *.RAR; *.gzip ; *.GZIP; ',
						'fileTypeDesc' : 'All Files',
						
						'method'  : 'post',
						'fileObjName' : 'userfile',
						
						'queueSizeLimit': 40,
						'uploadLimit': 50,
						'fileSizeLimit'  : '35MB',
						'formData' : {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
						'onUploadSuccess' : function(file, data, response) {
						var data_files = "<?php echo site_url('monitor/files_list/'.$this->encrypt->encode($uc_detil->id).'');?>";
						$("#files").load(data_files);;
						},
						/*'onUploadComplete' : function(file) {
						alert('The file ' + file.name + ' finished processing.');
						},*/
						'onQueueFull': function(event, queueSizeLimit) {
						alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
						return false;
						},
						});
						});
						jQuery(document).ready(function() { 
							var data_files = "<?php echo site_url('monitor/files_list/'.$this->encrypt->encode($uc_detil->id).'');?>";
							$("#files").load(data_files);
						});
						function file_delete(id){
							$.ajax({
							'url' : base_url + 'monitor' + '/file_delete/' + id,
							'type' : 'GET',
							'success' : function(data){ 
							if(data == 'success'){
								var data_files = "<?php echo site_url('monitor/files_list/'.$this->encrypt->encode($uc_detil->id).'');?>";
								$("#files").load(data_files);;
							}
							}
							});
						}
					</script>