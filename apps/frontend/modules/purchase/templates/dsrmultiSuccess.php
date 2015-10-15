<?php use_helper('I18N', 'Date') ?>
<?php echo form_tag_for(new PurchaseForm(),"purchase/dsrmulti")?>
<?php 
$today=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday->adddays(-1);
$tomorrow=MyDateTime::frommysql($form->getObject()->getDate()); 
$tomorrow->adddays(1);
?>
<table>
  <tr>
    <td>From Date</td>
    <td><?php echo $form["date"] ?></td>
  </tr>
  <tr>
    <td>To Date</td>
    <td><?php echo $toform["date"] ?></td>
    <td><input type=submit value=View ></td>
  </tr>
</table>
    <?php echo link_to("Yesterday","purchase/dsr?purchase[date][day]=".$yesterday->getDay()."&purchase[date][month]=".$yesterday->getMonth()."&purchase[date][year]=".$yesterday->getYear()); ?>
    <?php echo link_to("Tomorrow","purchase/dsr?purchase[date][day]=".$tomorrow->getDay()."&purchase[date][month]=".$tomorrow->getMonth()."&purchase[date][year]=".$tomorrow->getYear()); ?>

</form><h1>Period Purchase Report </h1>
Date: <?php echo $form->getObject()->getDate(); $datearray=explode("-",$form->getObject()->getDate());?>

<br>Cash Purchase: <?php echo MyDecimal::format($cashtotal)?>
<br>Cheque Purchase: <?php echo MyDecimal::format($chequetotal)?>
<br>Credit Purchase: <?php echo MyDecimal::format($credittotal)?>
<br>Total Purchase: <?php echo MyDecimal::format($total)?>
<br><?php 
$datearray=explode("-",$form->getObject()->getDate());
$todatearray=explode("-",$toform->getObject()->getDate());
echo link_to("Print","purchase/dsrmultipdf?invoice[date][year]=".
                $datearray[0]."&invoice[date][month]=".
                $datearray[1]."&invoice[date][day]=".
                $datearray[2]."&purchase[date][year]=".
                $todatearray[0]."&purchase[date][month]=".
                $todatearray[1]."&purchase[date][day]=".
                $todatearray[2]);?>


<br>
<br>
<table border=1>
  <tr>
    <td>Form</td>
    <td>Particulars</td>
    <td>Reference</td>
    <td>Code</td>
    <td>Item Description</td>
    <td>Terms</td>
    <td>Cash</td>
    <td>Cheque</td>
    <td>Acct Purchase</td>
    <td>Salesman</td>
  </tr>
  <?php foreach(array(1,2,3,4,5) as $template_id){?>
    <?php foreach($events as $event){
      $purchase=$event->getParent();
      if($purchase->getTemplateId()==$template_id){?>
    <tr>
      <td><?php echo $purchase->getPurchaseTemplate() ?></td>
      <td><?php echo $purchase->getVendor()." ".$purchase->getVendorName() ?></td>
      <td><?php echo link_to($purchase->getPono(),"purchase/view?id=".$purchase->getId()) ?></td>
      <td><?php echo $purchase->getDate() ?></td>
      <td><?php echo $event->getType().": ".$event->getDetail1().": ".$event->getDetail2() ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("cashamt");?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("cheque");?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("creditamt");?></td>
      <td><?php echo $purchase->getEmployee() ?></td>
      <td><?php echo $purchase->getStatus() ?></td>
      <td><?php echo link_to("Edit","event/edit?id=".$event->getId()) ?></td>
      <td><?php echo $purchase->getDate() ?></td>
    </tr>
    <?php }?>
    <?php }?>
    <?php foreach($purchases as $purchase)if($purchase->getTemplateId()==$template_id){?>
    <tr>
      <td><?php echo $purchase->getPurchaseTemplate() ?></td>
      <td><?php echo $purchase->getVendor()." ".$purchase->getVendorName() ?></td>
      <td><?php echo link_to($purchase->getPono(),"purchase/view?id=".$purchase->getId()) ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td><?php echo $purchase->getParticularsString().($purchase->getCheque()?("; Check No.:".$purchase->getCheque().": ".$purchase->getChequedate()):"") ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td align=right><?php if($purchase->getCash()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCash() ?></td>
      <td align=right><?php if($purchase->getCheque()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCheque() ?></td>
      <td align=right><?php if($purchase->getCredit()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCredit() ?></td>
      <td><?php echo $purchase->getEmployee() ?></td>
      <td><?php echo $purchase->getStatus() ?></td>
      <td><?php echo link_to("Edit","purchase/edit?id=".$purchase->getId()) ?></td>
      <td><?php echo $purchase->getDate() ?></td>
    </tr>
    <?php }?>
    <tr>
      <td></td>
    </tr>
  <?php }?>
</table>


