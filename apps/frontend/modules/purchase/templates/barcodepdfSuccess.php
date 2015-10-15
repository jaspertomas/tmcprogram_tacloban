<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-08-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */

require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');

// create new PDF document
//$pdf = new TCPDF("P", PDF_UNIT, "GOVERNMENTLEGAL", true, 'UTF-8', false);
$pdf = new TCPDF("P", PDF_UNIT, "LETTER", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Tradewind Mdsg Corp Daily Sales Report');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(7.5, 4, 5,5);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);

$pos=array(
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      array(-1,-1,-1),
      );

$print=-1;
$detailcount=count($details);
foreach(range(0,32) as $count)
{
  if($start==$count)
  {
    $print++;

    //if end of last detail is reached, reset
    if($print==$detailcount)break;
    $start+=$qty[$print];
  }
  $row=$count/3;
  $col=$count%3;
  $pos[$row][$col]=$print;
}


//barcode height
$h=11;
//column width
$w=70;

foreach($pos as $line)
{
  if(array_key_exists(0,$line) and array_key_exists(0,$line) and $line[0]>=0)
    $pdf->write1DBarcode(MyBarcode::standardize($products[$line[0]]->getId().str_pad($purchase->getPono(),5,"0",STR_PAD_LEFT)), 'EAN13', '12.5', '', '', $h, 0.4, $style, 'T');
  if(array_key_exists(1,$line) and array_key_exists(1,$line) and $line[1]>=0)
    $pdf->write1DBarcode(MyBarcode::standardize($products[$line[1]]->getId().str_pad($purchase->getPono(),5,"0",STR_PAD_LEFT)), 'EAN13', '82.5', '', '', $h, 0.4, $style, 'T');
  if(array_key_exists(2,$line) and array_key_exists(2,$line) and $line[2]>=0)
    $pdf->write1DBarcode(MyBarcode::standardize($products[$line[2]]->getId().str_pad($purchase->getPono(),5,"0",STR_PAD_LEFT)), 'EAN13', '152.5', '', '', $h, 0.4, $style, 'T');

  $pdf->write1DBarcode('4800529501110', 'EAN13', '500', '', '', $h, 0.4, $style, 'N');
  if(array_key_exists(0,$line) and array_key_exists(0,$line) and $line[0]>=0)
    $pdf->Cell($w, 0, html_entity_decode($products[$line[0]]->getName()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(1,$line) and array_key_exists(1,$line) and $line[1]>=0)
    $pdf->Cell($w, 0, html_entity_decode($products[$line[1]]->getName()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(2,$line) and array_key_exists(2,$line) and $line[2]>=0)
    $pdf->Cell($w, 0, html_entity_decode($products[$line[2]]->getName()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  $pdf->ln();

  if(array_key_exists(0,$line) and $line[0]>=0)
    $pdf->Cell($w, 0, $details[$line[0]]->getSellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(1,$line) and $line[1]>=0)
    $pdf->Cell($w, 0, $details[$line[1]]->getSellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(2,$line) and $line[2]>=0)
    $pdf->Cell($w, 0, $details[$line[2]]->getSellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);


  $pdf->ln();

  if(array_key_exists(0,$line) and $line[0]>=0)
    $pdf->Cell($w, 0, MyTMC::encode($details[$line[0]]->getUnittotal()).'     '.MyDateTime::frommysql($purchase->getDate())->toshortdate(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(1,$line) and $line[1]>=0)
    $pdf->Cell($w, 0, MyTMC::encode($details[$line[1]]->getUnittotal()).'     '.MyDateTime::frommysql($purchase->getDate())->toshortdate(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if(array_key_exists(2,$line) and $line[2]>=0)
    $pdf->Cell($w, 0, MyTMC::encode($details[$line[2]]->getUnittotal()).'     '.MyDateTime::frommysql($purchase->getDate())->toshortdate(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  $pdf->ln();


  $pdf->SetFont('dejavusans', '', 2, '', true);
    $pdf->ln();
  $pdf->SetFont('dejavusans', '', 8, '', true);
}



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

