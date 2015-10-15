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
$pdf = new TCPDF("P", PDF_UNIT, "GOVERNMENTLEGAL", true, 'UTF-8', false);

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
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      array(0,0,0),
      );

$print=0;

foreach(range(0,23) as $count)
{
  if($start==$count)$print=1;
  if($end==$count)$print=0;
  $row=$count/3;
  $col=$count%3;
  $pos[$row][$col]=$print;
}


//barcode height
$h=11;
//column width
$w=67.5;

foreach($pos as $line)
{
  if($line[0])
    $pdf->write1DBarcode(($product->getBarcode()?$product->getBarcode():$product->getId()).str_pad("",5,"0",STR_PAD_LEFT), 'EAN13', '12.5', '', '', $h, 0.4, $style, 'T');
  if($line[1])
    $pdf->write1DBarcode(($product->getBarcode()?$product->getBarcode():$product->getId()).str_pad("",5,"0",STR_PAD_LEFT), 'EAN13', '80', '', '', $h, 0.4, $style, 'T');
  if($line[2])
    $pdf->write1DBarcode(($product->getBarcode()?$product->getBarcode():$product->getId()).str_pad("",5,"0",STR_PAD_LEFT), 'EAN13', '147.5', '', '', $h, 0.4, $style, 'T');

  $pdf->write1DBarcode('4800529501110', 'EAN13', '500', '', '', $h, 0.4, $style, 'N');

  if($line[0])
    $pdf->Cell($w, 0, $product->getName(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[1])
    $pdf->Cell($w, 0, $product->getName(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[2])
    $pdf->Cell($w, 0, $product->getName(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  $pdf->ln();

  if($line[0])
    $pdf->Cell($w, 0, $product->getMaxsellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[1])
    $pdf->Cell($w, 0, $product->getMaxsellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[2])
    $pdf->Cell($w, 0, $product->getMaxsellprice(), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);


  $pdf->ln();

  if($line[0])
    $pdf->Cell($w, 0, MyTMC::encode($product->getMaxbuyprice()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[1])
    $pdf->Cell($w, 0, MyTMC::encode($product->getMaxbuyprice()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  if($line[2])
    $pdf->Cell($w, 0, MyTMC::encode($product->getMaxbuyprice()), 0, 0);
  else
    $pdf->Cell($w, 0, '', 0, 0);

  $pdf->ln();


  $pdf->SetFont('dejavusans', '', 2, '', true);
    $pdf->ln();
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

