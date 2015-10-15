<?php use_helper('I18N', 'Date') ?>
<?php echo form_tag_for(new InvoiceForm(),"invoice/commission")?>
<?php 
$thismonth=MyDateTime::frommysql($form->getObject()->getDate()); 
$lastmonth=MyDateTime::frommysql($form->getObject()->getDate()); 
$lastmonth->adddays(-1);
$nextmonth=MyDateTime::frommysql($form->getObject()->getDate()); 
$nextmonth->adddays(45);
?>
<table>
  <tr>
    <td>Date</td>
    <td><?php echo $form["date"] ?></td>
    <td><input type=submit value=View ></td>
  </tr>
</table>
    <?php echo link_to("Last Month","invoice/commission?invoice[date][day]=".$lastmonth->getDay()."&invoice[date][month]=".$lastmonth->getMonth()."&invoice[date][year]=".$lastmonth->getYear()); ?>
    <?php echo link_to("Next Month","invoice/commission?invoice[date][day]=".$nextmonth->getDay()."&invoice[date][month]=".$nextmonth->getMonth()."&invoice[date][year]=".$nextmonth->getYear()); ?>
    <?php echo link_to("PDF","invoice/commissionpdf?invoice[date][day]=".$thismonth->getDay()    ."&invoice[date][month]=".$thismonth->getMonth()."&invoice[date][year]=".$thismonth->getYear()); ?>

</form><h1>Commission Report: <?php echo $date->getshortmonth()." ".$date->getYear()?></h1>

Total Commission: <?php echo MyDecimal::format($grandtotalcommission)?>

<table>
<?php

foreach($employees as $employee)
{
  echo "<tr>";
    echo "<td >".$employee->getName()."</td>";
    echo "<td align=right>".MyDecimal::format($commissiontotals[$employee->getId()])."</td>";
  echo "</tr>";
}


?>
</table>
<?php

foreach($empinvoices as $empid=>$employeedata)
{
  echo "<hr>";
  echo "<table>";

  //paid and cancelled records at the top
  $count=0;
  $statusesbydate=array();
  foreach($employeedata as $invoiceindex=>$invoice)if($invoice->getStatus()!="Pending")
  {

/*
DISPLAY "CHECK TO CLEAR" IF CHECKCLEARDATE NOT REACHED
  if status=paid,
    if checkcleardate > today, 
      status = pending. 
    else 
      status = paid
*/
if($invoice->getStatus()=="Paid"){
$today=MyDateTime::today();
$checkcleardate=MyDateTime::frommysql($invoice->getCheckcleardate());
$status="Paid";
if($checkcleardate->islaterthan($today))$status="Check to clear on ".$checkcleardate->toshortdate();
}
else $status=$invoice->getStatus();
$statusesbydate[$invoiceindex]=$status;
if($status!="Paid")continue;

    $count++;
    echo "<tr ".($invoice->getStatus()=="Cancelled"?"bgcolor=yellow":"").">";
      echo "<td >".$count."</td>";
      echo "<td >".$employees[$empid]."</td>";
      echo "<td >".$invoice->getInvno()."</td>";
      echo "<td align=right>".MyDecimal::format($invoice->getTotal())."</td>";
      echo "<td align=right>".($invoice->getStatus()!="Cancelled"?MyDecimal::format($invoice->getCommissionTotal($employees[$empid])):0)."</td>";
      echo "<td align=right>".($invoice->getStatus()!="Cancelled"?MyDecimal::format($invoice->getCommission($employees[$empid])):0)."</td>";
      echo "<td align=right>".link_to("view","invoice/view?id=".$invoice->getId())."</td>";
      echo "<td >".$statusesbydate[$invoiceindex]."</td>";
    echo "</tr>";
  }
  echo "</table>";
  
  //all pending records at the bottom
  echo "<table>";
  foreach($employeedata as $invoiceindex=>$invoice)if($invoice->getStatus()=="Pending" or $statusesbydate[$invoiceindex]!="Paid")
  {
    $count++;
    echo "<tr bgcolor=lightgreen>";
      echo "<td >".$count."</td>";
      echo "<td >".$employees[$empid]."</td>";
      echo "<td >".$invoice->getInvno()."</td>";
      echo "<td align=right>".MyDecimal::format($invoice->getTotal())."</td>";
      echo "<td align=right>".($invoice->getStatus()!="Cancelled"?MyDecimal::format($invoice->getCommissionTotal($employees[$empid])):0)."</td>";
      echo "<td align=right>".($invoice->getStatus()!="Cancelled"?MyDecimal::format($invoice->getCommission($employees[$empid])):0)."</td>";
      echo "<td align=right>".link_to("view","invoice/view?id=".$invoice->getId())."</td>";
      echo "<td >".($statusesbydate[$invoiceindex]?$statusesbydate[$invoiceindex]:$invoice->getStatus())."</td>";
    echo "</tr>";
  }
  echo "</table>";
}

?>

