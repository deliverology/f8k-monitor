<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Export extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			$this->general->checkLogin();
			$this->load->library('pdf');
            $this->load->library("phpexcel/Classes/PHPExcel");
			$this->load->model('m_monitor');
			$this->ci =& get_instance();
			backButtonHandle();
		}
		function export_renaksi($monitor_id_encode)
		{
			$type = $this->input->post('type');
			$periode = $this->input->post('periode');
			$prioritas = $this->input->post('prioritas');
			$penanggung_jawab = $this->input->post('penanggung_jawab');
			if($type == 1)
			{
				redirect('export/renaksi_pdf/'.$monitor_id_encode.'/'.$periode.'/'.$prioritas.'/'.$penanggung_jawab.'');
			}
			else
			{
				redirect('export/renaksi_xls/'.$monitor_id_encode.'/'.$periode.'/'.$prioritas.'/'.$penanggung_jawab.'');
			}
		}
		function renaksi_pdf($monitor_id_encode,$periode,$prioritas,$penanggung_jawab) {
			$monitor_id = $this->encrypt->decode($monitor_id_encode);
			$monitor = $this->m_monitor->export_data_monitor($monitor_id);
			$detil_monitor = $monitor->row();
			$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFooterData();
			$custom_header = '
			<table>
			<tr>
				<td align="center"><b>'.$detil_monitor->name.'</b></td>
			</tr><tr>
				<td align="center"><b>Pemerintah Provinsi DKI Jakarta</b></td>
			</tr>
			</table>
			';
			$pdf->setHeaderData($custom_header);
			$header_height = 20;
			$pdf->setCanvas($header_height);
			$content ='';
			$content.='
			<style>
			table{
			font-size:8; 
			border-style: 
			solid; 
			border:1px double black;
			}
			th{
			border:1px double black;
			}
			</style>
				<table>
					<thead>
						<tr style="text-align:left;background-color: #0039a6; color: #ffffff;">
							<th width="13%">OUTPUT</th>
							<th width="13%">PENANGGUNG JAWAB</th>
							<th width="13%">INSTANSI TERKAIT</th>
							<th width="12%">KRITERIA KEBERHASILAN</th>
							<th width="12%">UKURAN</th>
							<th width="12%">UKURAN KEBERHASILAN</th>
							<th width="8%">CAPAIAN (%)</th>
							<th width="12%">KETERANGAN</th>
							<th width="5%"></th>
						</tr>
						<tr style="text-align:left;background-color: #0039a6; color: #ffffff;">
							<th width="13%">1</th>
							<th width="13%">2</th>
							<th width="13%">3</th>
							<th width="12%">4</th>
							<th width="12%">5</th>
							<th width="12%">6</th>
							<th width="8%">7</th>
							<th width="12%">8</th>
							<th width="5%"></th>
						</tr>
					</thead>
			';
			$prioritas = $this->m_monitor->export_data_prioritas($monitor_id,$periode,$prioritas,$penanggung_jawab);
			if($prioritas->num_rows() > 0)
			{
				foreach($prioritas->result() as $row_prioritas)
				{
					$content .='
						<tr>
							<td colspan="9" style="background-color: #0072cf;color: #ffffff;border:1px double black"><b>'.$row_prioritas->monitor_code.$row_prioritas->prioritas_serial.' '.$row_prioritas->prioritas_name.'</b>
							</td>
						</tr>
					';
					$program = $this->m_monitor->export_data_program($periode,$row_prioritas->prioritas_id,$penanggung_jawab);
					if($program->num_rows() > 0)
					{
						foreach($program->result() as $row_program)
						{
							$content .='
								<tr>
									<td colspan="9" style="background-color: #0072cf;color: #ffffff;border:1px double black"><b>'.$row_program->monitor_code.$row_program->prioritas_serial.'P'.$row_program->program_serial.' '.$row_program->program_name.'</b>
									</td>
								</tr>
							';
							$renaksi = $this->m_monitor->export_data_renaksi($row_program->program_id,$penanggung_jawab);
							if($renaksi->num_rows() > 0)
							{
								$color = 0;
								$i = 1;
								$pre_renaksi = '';
								$pre_penanggung_jawab = '';
								$pre_instansi_terkait = '';
								$pre_kriteria = '';
								$pre_ukuran = '';
								$pre_ukuran_color = '';
								foreach($renaksi->result() as $row_renaksi)
								{
									if($row_renaksi->ukuran_finish_on == $row_renaksi->uc_id)
									{
										if($row_renaksi->uc_status == 3 && $row_renaksi->mc_status >1)
										{
											if($row_renaksi->uc_capaian >= 100)
											{
												$score = 'green';
											}
											else
											{
												$score = 'red';
											}
										}
										elseif ($row_renaksi->uc_status == 2 && $row_renaksi->mc_status >1)
										{
											$score = 'gray';
										}
										elseif ($row_renaksi->uc_status == 1 && $row_renaksi->mc_status >1)
										{
											$score = 'red';
										}
										else 
										{
											$score = 'white';
										}
									}
									else
									{
										if($row_renaksi->uc_status == 3 && $row_renaksi->mc_status >1)
										{
											if($row_renaksi->uc_capaian <= 50) $score = 'red';
											elseif($row_renaksi->uc_capaian > 50 && $row_renaksi->uc_capaian <= 75) $score = 'yellow';
											elseif($row_renaksi->uc_capaian > 75 && $row_renaksi->uc_capaian <= 100) $score = 'green';
											elseif($row_renaksi->uc_capaian > 100) $score = 'blue';
										}
										elseif ($row_renaksi->uc_status == 2 && $row_renaksi->mc_status >1)
										{
											$score = 'gray';
										}
										elseif ($row_renaksi->uc_status == 1 && $row_renaksi->mc_status >1)
										{
											$score = 'red';
										}
										else 
										{
											$score = 'white';
										}
									
									}
									if($score == 'white')
									{	
										$keterangan = '[Belum memasuki periode pelaporan]';
									}
									else $keterangan = '';
									$post_renaksi = $row_renaksi->renaksi_name;
									$post_penanggung_jawab = $row_renaksi->name;
									$post_instansi_terkait = $this->m_monitor->export_data_instansi_terkait($row_renaksi->kriteria_instansi_terkait);
									$post_kriteria = $row_renaksi->kriteria_name;
									$post_ukuran = $row_renaksi->ukuran_name;
									$post_ukuran_color = $row_renaksi->ukuran_id;
									if($post_ukuran_color != $pre_ukuran_color) $color++;
									if($i == $renaksi->num_rows()) $border = ';border-bottom:1px solid black';
									else $border = '';
									if($color%2 == 0 ) $background ='edf7ff';
									else $background = 'ffffff';
									
									
									if($pre_instansi_terkait != $post_instansi_terkait) $instansi_terkait = $post_instansi_terkait;
									else $instansi_terkait = '';
									
									if($pre_penanggung_jawab != $post_penanggung_jawab) $kriteria_penanggung_jawab = $post_penanggung_jawab;
									else $kriteria_penanggung_jawab = '';
									
									if($pre_renaksi != $post_renaksi) {
										$renaksi_name = '<b>'.$row_renaksi->monitor_code.$row_renaksi->prioritas_serial.'P'.$row_renaksi->program_serial.'A'.$row_renaksi->renaksi_serial.':</b><br>'.$row_renaksi->renaksi_name.'';
										$kriteria_penanggung_jawab = $row_renaksi->name;
										}
									else $renaksi_name = '';
									
									if($kriteria_penanggung_jawab != '') $instansi_terkait = $row_renaksi->name;
									
									if($pre_kriteria != $post_kriteria) $kriteria = $post_kriteria;
									else $kriteria = '';
									
									if($pre_ukuran != $post_ukuran) $ukuran = $post_ukuran;
									else $ukuran = '';
									
									$content .='
											<tr style="background-color: #'.$background.';">
											<td style="border-right:1px solid black'.$border.'" width="13%">'.$renaksi_name.'</td>
											<td style="border-right:1px solid black'.$border.'" width="13%">'.$kriteria_penanggung_jawab.'</td>
											<td style="border-right:1px solid black'.$border.'" width="13%">'.$instansi_terkait.'</td>
											<td style="border-right:1px solid black'.$border.'" width="12%">'.$kriteria.'</td>
											<td style="border-right:1px solid black'.$border.'" width="12%">'.$ukuran.'';
									
									$content .='</td>
											<td style="border-right:1px solid black'.$border.'" width="12%"><b>TA'.$row_renaksi->mc_year.'-B'.sprintf("%02d",$row_renaksi->mc_month).''.((isset($row_renaksi->mc_week) || !empty($row_renaksi->mc_week)) ? '-M'.sprintf("%02d",$row_renaksi->mc_week): '').': <br></b>'.$row_renaksi->uc_name.'';
									if($row_renaksi->ukuran_type == 2)
									{
									$content .='
											<br><br>
											<b>Jumlah Anggaran:</b> <br>Rp'.number_format($row_renaksi->ukuran_jumlah_anggaran,2,",",".").'
											<br>
											<b>Target keuangan: </b><br>'.number_format($row_renaksi->uc_target_keuangan,2,",",".").' %<br>
											<b>Target Fisik: </b><br>'.number_format($row_renaksi->uc_target_fisik,2,",",".").' % <br>
											';	
									}
									$content .='		
											</td>
											<td style="border-right:1px solid black'.$border.'" width="8%" align="center">'.$row_renaksi->uc_capaian.' %</td>
											<td style="border-right:1px solid black'.$border.'" width="12%">'.$row_renaksi->uc_keterangan.'<br><br>';
									if($row_renaksi->ukuran_type == 2)
									{
									$content .='
											<b>Realisasi keuangan:</b><br> '.number_format(($row_renaksi->uc_realisasi_keuangan/$row_renaksi->ukuran_jumlah_anggaran*100),2,",",".").' %<br>
											<b>Realisasi Fisik:</b><br> '.number_format($row_renaksi->uc_realisasi_fisik,2,",",".").' %
											';	
									}		
									$content .=''.$keterangan.'<br></td>
											<td align="center" style="border-right:1px solid black'.$border.'" width="5%"><br><br><img src="'.base_url('assets/css').'/'.$score.'.png"></td>
										</tr>
									';
									$pre_renaksi = $post_renaksi;
									$pre_penanggung_jawab = $post_penanggung_jawab;
									$pre_instansi_terkait = $post_instansi_terkait;
									$pre_kriteria = $post_kriteria;
									$pre_ukuran = $post_ukuran;
									$pre_ukuran_color = $row_renaksi->ukuran_id;
									$i++;
								}
							}
						}
					}
				}
			}
			
			$content .='
				</table>
			';
			$pdf->AddPage('L','A4');
			
			$html  = <<<EOD
			$content
EOD;
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			$pdf->Output(''.$detil_monitor->name.'.pdf', 'D'); 
			
		}
		function renaksi_xls($monitor_id_encode,$periode,$prioritas,$penanggung_jawab)
		{
			// new object PHPHexcel
			$objPHPExcel = new PHPExcel();
			
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$monitor = $this->m_monitor->export_data_monitor($monitor_id_decode);
			$detil_monitor = $monitor->row();
			
			// header title
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Monitor');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Prioritas');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Program');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Output');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Kriteria Keberhasilan');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Instansi Penanggung Jawab');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Instansi Induk');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Instansi Terkait');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Jenis Ukuran');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Ukuran');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Jumlah Anggaran (Rp)');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Target Keuangan (%)');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Target Fisik (%)');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Ukuran Keberhasilan');
			$objPHPExcel->getActiveSheet()->setCellValue('P1', 'Tahun');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Bulan');
			$objPHPExcel->getActiveSheet()->setCellValue('R1', 'Minggu');
			$objPHPExcel->getActiveSheet()->setCellValue('S1', 'Capaian');
			$objPHPExcel->getActiveSheet()->setCellValue('T1', 'Realisasi Keuangan (Rp)');
			$objPHPExcel->getActiveSheet()->setCellValue('U1', 'Realisasi Keuangan (%)');
			$objPHPExcel->getActiveSheet()->setCellValue('V1', 'Realisasi Fisik (%)');
			$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Keterangan');
			$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Warna');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Keterangan Warna');
			
			// data
			$i = 2;
			$renaksi = $this->m_monitor->export_data_renaksi_xls($monitor_id_decode,$periode,$prioritas,$penanggung_jawab);
			if($renaksi->num_rows() > 0)
			{
				foreach($renaksi->result() as $renaksi_rows)
				{
					//perhitungan warna
					if($renaksi_rows->ukuran_finish_on == $renaksi_rows->uc_id)
					{
						if($renaksi_rows->uc_status == 3)
						{
							if($renaksi_rows->uc_capaian >= 100)
							{
								$color = 'Hijau';
								$keterangan = 'Target akhir tercapai';
							}
							else
							{
								$color = 'Merah';
								$keterangan = 'Target akhir tidak tercapai';
							}
						}
						elseif ($renaksi_rows->uc_status == 2)
						{
							$color = 'Abu-abu';
							$keterangan = 'Menunggu verifikasi';
						}
						elseif ($renaksi_rows->uc_status == 1)
						{
							$color = 'Merah';
							$keterangan = 'Tidak melapor';
						}
						else 
						{
							$color = 'Abu-abu';
							$keterangan = 'Tidak ada target';
						}
					}
					else
					{
						if($renaksi_rows->uc_status == 3)
						{
							if($renaksi_rows->uc_capaian <= 50) 
							{
								$color = 'Merah';
								$keterangan = 'Target antara tidak tercapai';
							}
							elseif($renaksi_rows->uc_capaian > 50 && $renaksi_rows->uc_capaian <= 75) 
							{
								$color = 'Kuning';
								$keterangan = 'Capaian belum sempurna';
							}
							elseif($renaksi_rows->uc_capaian > 75 && $renaksi_rows->uc_capaian <= 100) 
							{
								$color = 'Hijau';
								$keterangan = 'Target antara tercapai';
							}
							elseif($renaksi_rows->uc_capaian > 100) 
							{
								$color = 'Biru';
								$keterangan = 'Melampaui target';
							}
						}
						elseif ($renaksi_rows->uc_status == 2)
						{
							$color = 'Abu-abu';
							$keterangan = 'Menunggu verifikasi';
						}
						elseif ($renaksi_rows->uc_status == 1)
						{
							$color = 'Merah';
							$keterangan = 'Tidak melapor';
						}
						else 
						{
							$color = 'Abu-abu';
							$keterangan = 'Tidak ada target';
						}
					
					}
					
					$kriteria_name = str_replace(array('<br>','</li>'),"\r",$renaksi_rows->kriteria_name);
					$kriteria_name = str_replace(array('<b>','</b>','<i>','</i>','<span>','<span >','</span>','<ol>','</ol>','<ul>','</ul>'),'',$kriteria_name);
					$kriteria_name = str_replace('&nbsp;',' ',$kriteria_name);
					$kriteria_name = str_replace('<li>',"- ",$kriteria_name);
					
					$renaksi_name = str_replace(array('<br>','</li>'),"\r",$renaksi_rows->renaksi_name);
					$renaksi_name = str_replace(array('<b>','</b>','<i>','</i>','<span>','</span>','<span >','<ol>','</ol>','<ul>','</ul>'),'',$renaksi_name);
					$renaksi_name = str_replace('&nbsp;',' ',$renaksi_name);
					$renaksi_name = str_replace('<li>',"- ",$renaksi_name);
					
					$ukuran_name = str_replace(array('<br>','</li>'),"\r",$renaksi_rows->ukuran_name);
					$ukuran_name = str_replace(array('<b>','</b>','<i>','</i>','<span>','</span>','<span >','<ol>','</ol>','<ul>','</ul>'),'',$ukuran_name);
					$ukuran_name = str_replace('&nbsp;',' ',$ukuran_name);
					$ukuran_name = str_replace('<li>',"- ",$ukuran_name);
					
					$uc_name = str_replace(array('<br>','</li>'),"\r",$renaksi_rows->uc_name);
					$uc_name = str_replace(array('<b>','</b>','<i>','</i>','<span>','</span>','<span >','<ol>','</ol>','<ul>','</ul>'),'',$uc_name);
					$uc_name = str_replace('&nbsp;',' ',$uc_name);
					$uc_name = str_replace('<li>',"- ",$uc_name);
					
					$uc_keterangan = str_replace(array('<br>','</li>'),"\r",$renaksi_rows->uc_keterangan);
					$uc_keterangan = str_replace(array('<b>','</b>','<i>','</i>','<span>','</span>','<span >','<ol>','</ol>','<ul>','</ul>'),'',$uc_keterangan);
					$uc_keterangan = str_replace('&nbsp;',' ',$uc_keterangan);
					$uc_keterangan = str_replace('<li>',"- ",$uc_keterangan);
					
					if($renaksi_rows->ukuran_type == 1)
					{
						$ukuran_type = 'F8K';
						$jmlh_anggaran = '';
						$target_keuangan_persen = '';
						$target_fisik_persen = '';
						$realisasi_keuangan_rp = '';
						$realisasi_keuangan_persen = '';
						$realisasi_fisik_persen = '';
					}
					else
					{
						$ukuran_type = 'F8K Extended';
						$jmlh_anggaran = $renaksi_rows->ukuran_jumlah_anggaran;
						$target_keuangan_persen = $renaksi_rows->uc_target_keuangan;
						$target_fisik_persen = $renaksi_rows->uc_target_fisik;
						$realisasi_keuangan_rp = $renaksi_rows->uc_realisasi_keuangan;
						$realisasi_keuangan_persen = '=T'.$i.'/L'.$i.'*100';
						$realisasi_fisik_persen = $renaksi_rows->uc_realisasi_fisik;
						
					}
					if((isset($renaksi_rows->mc_week) || !empty($renaksi_rows->mc_week)))
					{
						$week = 'M'.sprintf("%02d",$renaksi_rows->mc_week);
					}
					else
					{
						$week = '';
					}
					$instansi_terkait = $this->m_monitor->export_data_instansi_terkait($renaksi_rows->kriteria_instansi_terkait);
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $i-1);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $renaksi_rows->monitor_name);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $renaksi_rows->prioritas_name);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $renaksi_rows->program_name);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $renaksi_name);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $kriteria_name);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setWrapText(true);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $renaksi_rows->name);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $renaksi_rows->instansi_induk);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $instansi_terkait);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $ukuran_type);
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $ukuran_name);
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $jmlh_anggaran);
					$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $target_keuangan_persen);
					$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $target_fisik_persen);
					$objPHPExcel->getActiveSheet()->getStyle('O'.$i)->getAlignment()->setWrapText(true);
					$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $uc_name);
					$objPHPExcel->getActiveSheet()->getStyle('P'.$i)->getAlignment()->setWrapText(true);
					$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $renaksi_rows->mc_year);
					$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, 'B'.sprintf("%02d",$renaksi_rows->mc_month));
					$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $week);
					$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $renaksi_rows->uc_capaian);
					$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $realisasi_keuangan_rp);
					$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $realisasi_keuangan_persen);
					$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, $realisasi_fisik_persen);
					$objPHPExcel->getActiveSheet()->setCellValue('W'.$i, $uc_keterangan);
					$objPHPExcel->getActiveSheet()->setCellValue('X'.$i, $color);
					$objPHPExcel->getActiveSheet()->setCellValue('Y'.$i, $keterangan);
					$i++;
				}
			}
			$border = $i-1;
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y'.$border)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y'.$border)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y'.$border)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			
			//auto size column
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
			
			// worksheet name
			$objPHPExcel->getActiveSheet()->setTitle('Monev_KKP_'.date('Ymd').'');
			$objPHPExcel->setActiveSheetIndex(0);
			 
			header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// file name
			header('Content-Disposition: attachment;filename="Monev_KKP_'.date('Ymd').'.xlsx"');
			header('<a class="zem_slink" title="Web cache" href="http://en.wikipedia.org/wiki/Web_cache" target="_blank" rel="wikipedia">Cache-Control</a>: max-age=0');
			header('Cache-Control: max-age=1');
			 
			header ('Expires: Mon, 26 Jul 1997 05:00:00 <a class="zem_slink" title="Greenwich Mean Time" href="http://en.wikipedia.org/wiki/Greenwich_Mean_Time" target="_blank" rel="wikipedia">GMT</a>'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); 
			header ('Pragma: public');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

			exit;
         }
	}
