<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
	
	class Pdf extends TCPDF
	{
		function __construct()
		{
			parent::__construct();
		}
		var $_hData  = '';

		function setHeaderData($custom_header)
		{
			$this->_hData = $custom_header;
		}
		public function Header() {

        $this->writeHTMLCell('', '', '', '', $this->_hData, 0, 0, 0, true, 'J', true);	
		}
		public function setCanvas($header_height){
			$this->SetCreator(PDF_CREATOR);
			$this->SetAuthor('monevkkp');
			$this->SetTitle('monevkkp');
			$this->SetSubject('monevkkp');
			$this->SetKeywords('monevkkp, monev, kkp, kkp.go.id, kinerja');
			
			$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$this->SetMargins(PDF_MARGIN_LEFT, $header_height, PDF_MARGIN_RIGHT);
			$this->SetHeaderMargin(PDF_MARGIN_HEADER);
			$this->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$this->setLanguageArray($l);
			}
		
			$this->SetFont('times', '', 10);
		}
	}	