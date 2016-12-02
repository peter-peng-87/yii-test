<?php
//============================================================+
// File name   : example_020.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 020 for TCPDF class
//               Two columns composed by MultiCell of different
//               heights
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
* Creates an example PDF TEST document using TCPDF
* @package com.tecnick.tcpdf
* @abstract TCPDF - Example: Two columns composed by MultiCell of different heights
* @author Nicola Asuni
* @since 2008-03-04
*/
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once('../include/TableRow.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
    
	public function MultiRow($left, $right, $middle) {
		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)

		$page_start = $this->getPage();
		$y_start = $this->GetY();
	
		// write the left cell
		// $w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='M'
		$m_height = $this->getStringHeight(100, $right, $reseth=false, $autopadding=true, 0, $border=1) + 3;
		$this->MultiCell(40, $m_height, $left, 1, 'R', 0, 2, '', '', true, 0, $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='T');
		//echo "M:$m_height<br/>";
		$page_end_1 = $this->getPage();
		$y_end_1 = $this->GetY();
		$this->setPage($page_start);
		$this->MultiCell(40, $m_height, $middle, 1, 'C', 0, 2, $this->GetX(), $y_start, true, 0,  $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='M');

		$page_end_2 = $this->getPage();
		$y_end_2 = $this->GetY();

		$this->setPage($page_start);

		// write the right cell
		$this->MultiCell(100, $m_height, $right, 1, 'L', 0, 1, $this->GetX() ,$y_start, true, 0, $ishtml=false, $autopadding=true, $maxh=$m_height, $valign='T');
	    //	$m_height = $this->getStringHeight(0, $right, $reseth=false, $autopadding=false, 0, $border=1);
		//echo "Y:$m_height";die;
		$page_end_3 = $this->getPage();
		$y_end_3 = $this->GetY();
		$ynew = max($y_end_1, $y_end_2, $y_end_3);
		// set the new row position by case 
		/**
		if (max($page_end_1,$page_end_2) == $page_start) {
			$ynew = max($y_end_1, $y_end_2);
		} elseif ($page_end_1 == $page_end_2) {
			$ynew = max($y_end_1, $y_end_2);
		} elseif ($page_end_1 > $page_end_2) {
			$ynew = $y_end_1;
		} else {
			$ynew = $y_end_2;
		}**/

		$this->setPage(max($page_end_1,$page_end_2, $page_end_3));
		$this->SetXY($this->GetX(),$ynew);
	}

}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 020');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 020', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 20);
// add a page
$pdf->AddPage();

// $pdf->Write(0, 'Example of text layout using Multicell()', '', 0, 'L', true, 0, false, false, 0);

$pdf->Ln(5);

$pdf->SetFont('times', '', 9);

//$pdf->SetCellPadding(0);
//$pdf->SetLineWidth(2);

// set color for background
$pdf->SetFillColor(255, 255, 200);
$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.

Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';
$pdftable = TableRow::install();
$pdftable->setOpObj($pdf);
$pdftable->setHeaderOption(['align' => 'C', 'valign' => 'T', 'width' => ['1' => 40, '2' => 40, '3'=> 100]]);
$pdftable->setBodyOption(['align' => 'L',   'valign' => 'M', 'width' => ['1' => 40, '2' => 40, '3'=> 100]]);
// print some rows just as example
$pdftable->setHeaderData(['1' => 'content', '2' => 'notice', 3 => 'desc']);
$data = [];
for ($i = 0; $i < 6; ++$i) {
	// $pdf->MultiRow('Row '.($i+1), $text."\n", "Man woman");
    $data[] = [
        '1' => 'Row' . ($i+1), 
        '2' => 'Man Woman' . ($i+1), 
        '3' =>  $text,
    ];
}
$pdftable->setBodyData($data);
$pdftable->writeTableText();
$pdf = $pdftable->getOpObj();
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_020.pdf', 'I');
//============================================================/===/===
// END OF FILE
//===================================================/===/===/===/===/===
