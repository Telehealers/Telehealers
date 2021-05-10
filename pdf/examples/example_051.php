<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

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
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

/* set background image  */

	$bMargin = $pdf->getBreakMargin();
	$auto_page_break = $pdf->getAutoPageBreak();
	$pdf->SetAutoPageBreak(false, 0);
	$img_file = 'https://www.telehealers.in//web_assets2/images/aajay.jpg';
	$pdf->Image($img_file, 0, 14.5, 210, 280, '', '', '', false, 300, '', false, false, 0);
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	$pdf->setPageMark();

/* top header start */

	/* section one */
	
	$html = '<span color="red">Date : 07-May-2021 18:07:09pm Friday</span><br />';
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section two */
	
	$html = '<span color="red">Patient Id: P210E4JS, Appointment Id: </span><br />';
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=90, $y=18, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	/* section three */

	$html = '<span color="red">History</span><br />';
	$pdf->SetFont('dejavusans', '', 14);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=170, $y=17, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* top header end */

/* doctor details */
	/* section one */
	$html = '<span color="red">Dr. Utpal Patel- (DMC/R/13756)</span>';
	$pdf->SetFont('dejavusans', '', 15);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=30, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

	/* section two  */
	$html = '<span color="red">MBBS (AIIMS ,New Delhi) , MD Dermatology (AIIMS New Delhi)</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=38, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


	/* sectoin three */
	$html = '<span color="red">COVID Telehealer</span><br /><span>Online</span>';
	$pdf->SetFont('dejavusans', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=105, $y=50, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* header two patient details */

	$html = '<span color="red">Patient Name: raghuveer singh,   Age : ,  Gender : Male,  Patient Weight : 23,  Patient BP : 35</span><br />';
	$pdf->SetFont('dejavusans', '', 10);
	$pdf->SetFillColor(4,158,141);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->writeHTMLCell(210, 11, 0, +61, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=12, $y=64, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* complaint section  */
	$html = '<span color="red">Patient complaint</span>';
	$pdf->SetFont('dejavusans', '', 16);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="red">. Patient CC come here</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y=85, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* history section */
	$html = '<span color="red">History</span>';
	$pdf->SetFont('dejavusans', '', 16);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=95, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="red">. History here</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y=105, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


/* temp section */
	$html = '<span color="red">Temperature : 354°C</span>';
	$pdf->SetFont('dejavusans', '', 16);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=115, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="red">O/Ex</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=125, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
			$html = '<span color="red">. O/Ex</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=0, $h=0, $x=25, $y=132, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<span color="red">PD</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(4,158,141);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=140, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


			$html = '<span color="red">. PD</span>';
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->SetTextColor(0,0,0);
			$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
			$pdf->writeHTMLCell($w=0, $h=0, $x=25, $y=147, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);



/* test section */
	$html = '<span color="red">Test</span>';
	$pdf->SetFont('dejavusans', '', 16);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=157, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="red">. Test one </span><br /><span>. Test two</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=25, $y=165, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

/* advice section */
	$html = '<span color="red">Advice</span>';
	$pdf->SetFont('dejavusans', '', 16);
	$pdf->SetTextColor(4,158,141);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=10, $y=174, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

		$html = '<span color="red">. advice here </span><br /><span>. advice here</span>';
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=25, $y=184, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		
/* advice section */
	$html = '<span color="red">SL</span>&nbsp;&nbsp;<span color="red">Type</span>&nbsp;&nbsp;&nbsp;<span color="red">Medicine Name</span>&nbsp;&nbsp;&nbsp;&nbsp;<span color="red">Mg/Ml</span>&nbsp;&nbsp;&nbsp;<span color="red">Dose</span>&nbsp;&nbsp;&nbsp;<span color="red">Day</span>&nbsp;&nbsp;<span color="red">Comments</span>';
	$pdf->SetFont('dejavusans', '', 11);
	$pdf->SetTextColor(0,0,0);
	$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
	$pdf->writeHTMLCell($w=0, $h=0, $x=70, $y=75, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
	
		$html = '<span color="red">1</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Tab</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Dexamethasone</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>6mg</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>OD</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>5</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>continue for total 10 days</span>';
		$pdf->SetFont('dejavusans', '', 9);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=72, $y=83, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

				
		

$pdf->Output('example_051.pdf', 'I');