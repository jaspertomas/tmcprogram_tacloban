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
$pdf = new TCPDF("L", PDF_UNIT, "GOVERNMENTLEGAL", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Tradewind Mdsg Corp Period Purchase Report');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(10, 10, 10,5);

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

$pdf->write(0,MyDateTime::frommysql($form->getObject()->getDate())->toshortdate(),
'',false,'',true,0,false,false,0,0);

$contents=array();
$contents[]=array(
          "Cash Purchase: ",
          MyDecimal::format($cashsales),
          " ",
          "Cheque Purchase: ",
          MyDecimal::format($chequesales),
          " ",
          "Credit Purchase: ",
          MyDecimal::format($creditsales),
          " ",
          "Total Purchase: ",
          MyDecimal::format($cashsales+$chequesales+$creditsales),
          );
$contents[]=array(
          "Other Cash: ",
          MyDecimal::format($cashother),
          " ",
          "Other Cheque: ",
          MyDecimal::format($chequeother),
          " ",
          "Other Credit: ",
          MyDecimal::format($creditother),
          " ",
          "Total Other: ",
          MyDecimal::format($cashother+$chequeother+$creditother),
          );
$contents[]=array(
          "Total Cash: ",
          MyDecimal::format($cashtotal),
          " ",
          "Total Cheque: ",
          MyDecimal::format($chequetotal),
          " ",
          "Total Credit: ",
          MyDecimal::format($credittotal),
          " ",
          "Total: ",
          MyDecimal::format($total),
          );
$contents[]=array(
          "Less Deductions: ",
          MyDecimal::format($deducttotal*-1),
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          );
$contents[]=array(
          "Total Cash: ",
          MyDecimal::format($cashtotal-$deducttotal),
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          " ",
          );

$widths=array(30,30,20,30,30,20,30,30,20,30,30,);
$height=1;
foreach($contents as $content)
{
  $pdf->MultiCell($widths[0], $height, $content[0], 0, 'L', 0, 0, '', '', true);
  $pdf->MultiCell($widths[1], $height, $content[1], 0, 'R', 0, 0, '', '', true);
  $pdf->MultiCell($widths[2], $height, $content[2], 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell($widths[3], $height, $content[3], 0, 'L', 0, 0, '', '', true);
  $pdf->MultiCell($widths[4], $height, $content[4], 0, 'R', 0, 0, '', '', true);
  $pdf->MultiCell($widths[5], $height, $content[5], 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell($widths[6], $height, $content[6], 0, 'L', 0, 0, '', '', true);
  $pdf->MultiCell($widths[7], $height, $content[7], 0, 'R', 0, 0, '', '', true);
  $pdf->MultiCell($widths[8], $height, $content[8], 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell($widths[9], $height, $content[9], 0, 'L', 0, 0, '', '', true);
  $pdf->MultiCell($widths[10], $height, $content[10], 0, 'R', 0, 1, '', '', true);
}

//$pdf->write(5,"\n\n");



/*
method Write [line 6138]
mixed Write( float $h, string $txt, [mixed $link = ''], [boolean $fill = false], [string $align = ''], [boolean $ln = false], [int $stretch = 0], [boolean $firstline = false], [boolean $firstblock = false], [float $maxh = 0], [float $wadj = 0])
*/


// Set some content to print
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
// Multicell test
$widths=array(25,40,20,120,20,20,20,20,20);
$height=5;

$content=array(
    'Date'
    ,'Particulars'
    ,'Ref'
    ,'Item Description'
    ,'Cash'
    ,'Cheque'
    ,'Acct Purchase'
    ,'Salesman'
    ,'Remarks'
          );
$pdf->MultiCell($widths[0], $height, $content[0], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[1], $height, $content[1], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[2], $height, $content[2], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[3], $height, $content[3], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[4], $height, $content[4], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[5], $height, $content[5], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[6], $height, $content[6], 1, 'R', 0, 0, '', '', true);
$pdf->MultiCell($widths[7], $height, $content[7], 1, 'R', 0, 0, '', '', true);
$pdf->MultiCell($widths[8], $height, $content[8], 1, 'R', 0, 1, '', '', true);

foreach(array(1,2,3,4,5) as $template_id)
{
  $pdf->SetFont('dejavusans', '', 14, '', true);
  $pdf->MultiCell(290, 0, PurchaseTemplateTable::fetch($template_id), 1, 'L', 0, 1, '', '', true);
  $pdf->SetFont('dejavusans', '', 8, '', true);
  foreach($events as $event)
  {
    $purchase=$event->getParent();
    if($purchase->getTemplateId()==$template_id)
    {
      $content=array(
        MyDateTime::frommysql($event->getDate())->toshortdate(),
        $purchase->getVendor()." ".$purchase->getVendorName(),
        $purchase->getPono()." (".MyDateTime::frommysql($purchase->getDate())->toshortdate().")",
        $event->getType().": ".$event->getDetail1().": ".$event->getDetail2(),
        ($event->getDetail("cashamt") and $purchase->getStatus()!="Cancelled")?$event->getDetail("cashamt"):" ",
        ($event->getDetail("cheque") and $purchase->getStatus()!="Cancelled")?$event->getDetail("cheque"):" ",
        ($event->getDetail("creditamt") and $purchase->getStatus()!="Cancelled")?$event->getDetail("creditamt"):" ",
        $purchase->getEmployee()?$purchase->getEmployee():" ",
        $purchase->getStatus()?$purchase->getStatus():($event->getDetail("status")?$event->getDetail("status"):" "),
        );
      $height=1;
      foreach($content as $index=>$txt)
      {
        $numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
        if($height<$numlines)$height=$numlines;
      }
      $height*=4.5;
      $pdf->MultiCell($widths[0], $height, $content[0], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[1], $height, $content[1], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[2], $height, $content[2], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[3], $height, $content[3], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[4], $height, $content[4], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[5], $height, $content[5], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[6], $height, $content[6], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[7], $height, $content[7], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[8], $height, $content[8], 1, 'C', 0, 1, '', '', true,0,true);
    }
  }
  foreach($purchases as $purchase)if($purchase->getTemplateId()==$template_id)
  {
			$particularsstring=$purchase->getParticularsString()?$purchase->getParticularsString():" ";
			if($purchase->getCheque())$particularsstring=implode("; ",array($particularsstring,"Cheque no.: ".$purchase->getCheque().", ".MyDateTime::frommysql($purchase->getChequeDate())->toshortdate()));

			$chequestring=$purchase->getCheque()>0?$purchase->getCheque():" ";
			//if($purchase->getCheque())$chequestring=implode("; ",array($chequestring,"Cheque no.: ".$purchase->getCheque().", ".MyDateTime::frommysql($purchase->getChequeDate())->toshortdate()));
  
      $content=array(
        MyDateTime::frommysql($purchase->getDate())->toshortdate(),
       $purchase->getVendor()." ".$purchase->getVendorName(),
      
      $purchase->getPono()?$purchase->getPono():" ",
     
      
       $particularsstring,
      ($purchase->getCash()>0 and $invoice->getStatus()!="Cancelled")?$purchase->getCash():" ",
      $purchase->getStatus()!="Cancelled"?$chequestring:" ",
      ($purchase->getCredit()>0 and $purchase->getStatus()!="Cancelled")?$purchase->getCredit():" ",
       $purchase->getEmployee()?$purchase->getEmployee():" ",
       $purchase->getStatus()=="Paid Check"?$purchase->getCheque():($purchase->getStatus()?$purchase->getStatus():" "),
      );
      $height=1;
      foreach($content as $index=>$txt) 
      {
        $numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
        if($height<$numlines)$height=$numlines;
      }
      $height*=4.5;
      $pdf->MultiCell($widths[0], $height, $content[0], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[1], $height, $content[1], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[2], $height, $content[2], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[3], $height, $content[3], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[4], $height, $content[4], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[5], $height, $content[5], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[6], $height, $content[6], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[7], $height, $content[7], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[8], $height, $content[8], 1, 'C', 0, 1, '', '', true,0,true);
  }
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
