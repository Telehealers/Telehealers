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

				
		/* Sign of doctor  */

	//$pdf->Image('https://www.telehealers.in/./assets/uploads/doctor/Whats2.jpeg', 157, 227, 30, 20, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
	$picture3 = '[removed]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';
	
	$sign= str_replace('[removed]','data:image/png;base64,',$picture3); 
	
	$img = '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $sign) . '">';
	
	$img = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '', $sign));
    
	//$pdf->Image("@".$img, 155, 218, 25, 25);
	
	$pdf->Image("@".$img, 155, 218, 25, '', '', 'http://www.tcpdf.org', '', false, 300);
	

		
		$html = '<span>------------------------</span><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Signature</span>';
		$pdf->SetFont('dejavusans', '', 14);
		$pdf->SetTextColor(0,0,0);
		$pdf->writeHTMLCell(210, 11, 0, +14, '', '', '', $html, 'LRTB', 1, 1, true, 'C', true);
		$pdf->writeHTMLCell($w=0, $h=0, $x=150, $y=245, $html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);
		

$pdf->Output('example_051.pdf', 'I');