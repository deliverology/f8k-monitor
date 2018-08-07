<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><b>Catatan Aktivitas Pelaporan</b></h4>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-advance table-hover">
					<thead>
					<tr>
						<th width ='25%'>
							 <strong>Tanggal</strong>
						</th>
						<th width ='35%'>
							 <strong>Keterangan</strong>
						</th>
						<th width ='15%' class='text-center'>
							 <strong>Capaian (%)</strong>
						</th>
						<th width ='25%' class='text-center'>
							 <strong>Pengguna</strong>
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if($logs->num_rows() > 0){
						foreach ($logs->result() as $row){
						echo "
						<tr>
							<th width ='25%'>$row->timestamp</th>
							<td width ='35%'>$row->name</td>
							<td width ='10%' class='text-center'>$row->capaian</td>
							<td width ='30%' class='text-center'>$row->username</td>
						</tr>
						";
						}
					}
					else {
					echo "
					<tr>
						<td colspan=4 class='text-center'><strong>Tidak terdapat data catatan aktivitas pelaporan<strong></td>
					</tr>
					";	
					}
					?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>