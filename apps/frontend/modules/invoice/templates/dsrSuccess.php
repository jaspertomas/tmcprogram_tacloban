<?php use_helper('I18N', 'Date') ?>
<?php echo form_tag_for(new InvoiceForm(),"invoice/dsr")?>
<?php 
$today=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday->adddays(-1);
$tomorrow=MyDateTime::frommysql($form->getObject()->getDate()); 
$tomorrow->adddays(1);
?>
<table>
  <tr>
    <td>Date</td>
    <td><?php echo $form["date"] ?></td>
    <td><input type=submit value=View ></td>
  </tr>
</table>
    <?php echo link_to("Yesterday","invoice/dsr?invoice[date][day]=".$yesterday->getDay()."&invoice[date][month]=".$yesterday->getMonth()."&invoice[date][year]=".$yesterday->getYear()); ?>
    <?php echo link_to("Tomorrow","invoice/dsr?invoice[date][day]=".$tomorrow->getDay()."&invoice[date][month]=".$tomorrow->getMonth()."&invoice[date][year]=".$tomorrow->getYear()); ?>
    <?php echo link_to("Go to DSR Multi Date","invoice/dsrmulti?invoice[date][day]=".$today->getDay()."&invoice[date][month]=".$today->getMonth()."&invoice[date][year]=".$today->getYear()."&purchase[date][day]=".$today->getDay()."&purchase[date][month]=".$today->getMonth()."&purchase[date][year]=".$today->getYear()); ?>


</form><h1>Daily Sales Report </h1>
Date: <?php echo $form->getObject()->getDate(); $datearray=explode("-",$form->getObject()->getDate());?>

<br>Cash Sales: <?php echo MyDecimal::format($cashtotal)?>
<br>Cheque Sales: <?php echo MyDecimal::format($chequetotal)?>
<br>Credit Sales: <?php echo MyDecimal::format($credittotal)?>
<br>Total Sales: <?php echo MyDecimal::format($total)?>
<br><?php echo link_to("Print","invoice/dsrpdf?invoice[date][year]=".$datearray[0]."&invoice[date][month]=".$datearray[1]."&invoice[date][day]=".$datearray[2]);?>


<br>
<br>
<table border=1>
  <tr>
    <td>Form</td>
    <td>Customer</td>
    <td>Tin No</td>
    <td>Reference</td>
    <td>Code</td>
    <td>Item Description</td>
    <td>Terms</td>
    <td>Cash</td>
    <td>Cheque</td>
    <td>Acct Sales</td>
    <td>Discount</td>
    <td>Salesman</td>
    <td>Remarks</td>
  </tr>
  <?php $addresses=array();?>
  <?php foreach(array(2,4,1,3) as $template_id){?>
    <?php foreach($events as $event){
      $invoice=$event->getParent();
      if($invoice and $invoice->getTemplateId()==$template_id){
        //catch addresses if present
        if($invoice->getCustomer()->getAddress()!="")
        {
          $addresses[]=array(
            $invoice->getCustomer()." ".$invoice->getCustomerName(),
            $invoice->getInvno(),
            $invoice->getCustomer()->getAddress(),
          );
        }
      
      ?>
    <tr>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo $invoice->getCustomer()->getTinNo() ?></td>
      <td><?php echo link_to($invoice->getInvno(),"invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php echo $invoice->getDate() ?></td>
      <td><?php echo $event->getType().": ".$event->getDetail1().": ".$event->getDetail2() ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("cashamt");?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("chequeamt");?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("creditamt");?></td>
      <td></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getStatus() ?></td>
      <td><?php echo $event->getNotes() ?></td>
      <td><?php echo link_to("Edit","event/edit?id=".$event->getId()) ?></td>
    </tr>
    <?php }?>
    <?php }?>
    <?php foreach($invoices as $invoice)
    if($invoice->getIsTemporary()==0){
    if($invoice->getTemplateId()==$template_id){
      //catch addresses if present
      if($invoice->getCustomer()->getAddress()!="")
      {
        $addresses[]=array(
          $invoice->getCustomer()." ".$invoice->getCustomerName(),
          $invoice->getInvno(),
          $invoice->getCustomer()->getAddress(),
        );
      }
    
    ?>
    <tr>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo $invoice->getCustomer()->getTinNo() ?></td>
      <td><?php echo link_to($invoice->getInvno(),"invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td><?php echo $invoice->getParticularsString().($invoice->getCheque()?("; Check No.:".$invoice->getCheque().": ".$invoice->getChequedate()):"") ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td align=right><?php if($invoice->getCash()!=0 and $invoice->getStatus()!="Cancelled")echo $invoice->getCash() ?></td>
      <td align=right><?php if($invoice->getChequeamt()!=0 and $invoice->getStatus()!="Cancelled")echo $invoice->getChequeamt() ?></td>
      <td align=right><?php if($invoice->getCredit()!=0 and $invoice->getStatus()!="Cancelled")echo $invoice->getCredit() ?></td>
      <td align=right><?php echo $invoice->getDiscamt() ?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php 
/*
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
echo $status;

}
else echo $invoice->getStatus();

?></td>
      <td><?php echo $invoice->getNotes() ?></td>
      <td><?php echo link_to("Edit","invoice/edit?id=".$invoice->getId()) ?></td>
      <td>
        <?php if($invoice->getHidden()==0)echo link_to("Hide ","invoice/hide?id=".$invoice->getId()) ?>
	  <?php if($invoice->getHidden()==1)echo link_to("Unhide ","invoice/unhide?id=".$invoice->getId()) ?>
      </td>
      <td>
        <?php if($invoice->getIsInspected()==0)echo "<font color=red>Not Verified</font>" ?>
	  <?php if($invoice->getIsInspected()==1)echo "<font color=green>Verified</font>" ?>
      </td>
    </tr>
    <?php }?>
    <?php }?>
    <tr>
      <td></td>
    </tr>
  <?php }?>
</table>
<br>

<table>
  <tr>
    <td>Customer</td>
    <td>Invoice No.</td>
    <td>Address</td>
  </tr>
<?php foreach($addresses as $address){ ?>
  <tr>
    <td><?php echo $address[0]?></td>
    <td><?php echo $address[1]?></td>
    <td><?php echo $address[2]?></td>
  </tr>
  <?php } ?>
</table>



