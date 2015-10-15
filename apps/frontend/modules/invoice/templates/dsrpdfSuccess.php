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
$pdf->SetTitle('Tradewind Mdsg Corp Daily Sales Report');

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
          "Cash Sales: ",
          MyDecimal::format($cashsales),
          " ",
          "Cheque Sales: ",
          MyDecimal::format($chequesales),
          " ",
          "Credit Sales: ",
          MyDecimal::format($creditsales),
          " ",
          "Total Sales: ",
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
$widths=array(40,18,20,120,20,20,20,20,20);
$height=5;

$content=array(
    'Particulars'
    ,'Tin No'
    ,'Ref'
    ,'Item Description'
    ,'Cash'
    ,'Cheque'
    ,'Acct Sales'
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

//===============================
$addresses=array();
foreach(array(2,4,1,3) as $template_id)
{
  $pdf->SetFont('dejavusans', '', 14, '', true);
  $pdf->MultiCell(298, 0, InvoiceTemplateTable::fetch($template_id), 1, 'L', 0, 1, '', '', true);
  $pdf->SetFont('dejavusans', '', 8, '', true);
  foreach($events as $event)
  {

    $invoice=$event->getParent();
    if($invoice and $invoice->getTemplateId()==$template_id)
    {
    
      //catch addresses if present
      if($invoice->getCustomer()->getAddress()!="")
      {
        $addresses[]=array(
          $invoice->getCustomer()." ".$invoice->getCustomerName(),
          $invoice->getCustomer()->getTinNo(),
          $invoice->getInvno(),
          $invoice->getCustomer()->getAddress(),
        );
      }
    
      $content=array(
        $invoice->getCustomer()." ".$invoice->getCustomerName(),
        $invoice->getCustomer()->getTinNo(),
        $invoice->getInvno()." (".MyDateTime::frommysql($invoice->getDate())->toshortdate().")",
        $event->getType().": ".$event->getDetail1().": ".$event->getDetail2(),
        ($event->getDetail("cashamt")!=0 and $invoice->getStatus()!="Cancelled")?$event->getDetail("cashamt"):" ",
        ($event->getDetail("chequeamt")!=0 and $invoice->getStatus()!="Cancelled")?$event->getDetail("chequeamt"):" ",
        ($event->getDetail("creditamt")!=0 and $invoice->getStatus()!="Cancelled")?$event->getDetail("creditamt"):" ",
        $invoice->getEmployee()?$invoice->getEmployee():" ",
        $invoice->getStatus()?$invoice->getStatus():($event->getDetail("status")?$event->getDetail("status"):" "),
        );
      $height=1;
      foreach($content as $index=>$txt)
      {
        @$numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
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
  foreach($invoices as $invoice)if($invoice->getIsTemporary()==0)if($invoice->getTemplateId()==$template_id)
  {
			$particularsstring=$invoice->getParticularsString()?$invoice->getParticularsString():" ";
			if($invoice->getCheque())$particularsstring=implode("; ",array($particularsstring,"Cheque no.: ".$invoice->getCheque().", ".MyDateTime::frommysql($invoice->getChequeDate())->toshortdate()));

			$chequestring=$invoice->getChequeamt()>0?$invoice->getChequeamt():" ";
			//if($invoice->getCheque())$chequestring=implode("; ",array($chequestring,"Cheque no.: ".$invoice->getCheque().", ".MyDateTime::frommysql($invoice->getChequeDate())->toshortdate()));
  
/*
DISPLAY "CHECK TO CLEAR" IF CHECKCLEARDATE NOT REACHED
  if status=paid,
    if checkcleardate > today, 
      status = pending. 
    else 
      status = paid
*/
      if($invoice->getStatus()=="Paid")
      {
        $today=MyDateTime::today();
        $checkcleardate=MyDateTime::frommysql($invoice->getCheckcleardate());
        $status="Paid";
        if($checkcleardate->islaterthan($today))$status="Check to clear on ".$checkcleardate->toshortdate();
      }
      else 
      {
        $status=$invoice->getStatus();
      }

      //catch addresses if present
      if($invoice->getCustomer()->getAddress()!="")
      {
        $addresses[]=array(
          $invoice->getCustomer()." ".$invoice->getCustomerName(),
          $invoice->getCustomer()->getTinNo(),
          $invoice->getInvno(),
          $invoice->getCustomer()->getAddress(),
        );
      }

      $content=array(
       $invoice->getCustomer()." ".$invoice->getCustomerName(),
        $invoice->getCustomer()->getTinNo(),
      $invoice->getInvno()?$invoice->getInvno():" ",
       $particularsstring,
      ($invoice->getCash()!=0 and $invoice->getStatus()!="Cancelled")?$invoice->getCash():" ",
      $invoice->getStatus()!="Cancelled"?$chequestring:" ",
      ($invoice->getCredit()!=0 and $invoice->getStatus()!="Cancelled")?$invoice->getCredit():" ",
       $invoice->getEmployee()?$invoice->getEmployee():" ",
       //$invoice->getStatus()=="Paid Check"?$invoice->getCheque():($invoice->getStatus()?$invoice->getStatus():" "),
       $status,
      );
      $height=1;
      foreach($content as $index=>$txt) 
      {
        @$numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
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

$pdf->write(5,"\n");
$widths=array(70,30,30,168);
foreach(array(array("Customer","Tin No.","Invoice No.","Address")) as $address)
{
      $height=4.5;
      $pdf->MultiCell($widths[0], $height, $address[0], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[1], $height, $address[1], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[2], $height, $address[2], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[3], $height, $address[3], 1, 'C', 0, 1, '', '', true,0,true);
}

foreach($addresses as $address)
{
      $height=1;
      foreach($address as $index=>$txt) 
      {
        @$numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
        if($height<$numlines)$height=$numlines;
      }
      $height*=4.5;
      $pdf->MultiCell($widths[0], $height, $address[0], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[1], $height, $address[1], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[2], $height, $address[2], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[3], $height, $address[3], 1, 'C', 0, 1, '', '', true,0,true);
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

