<?php use_helper('I18N', 'Date') ?>
<?php echo form_tag_for(new purchaseForm(),"purchase/dsr")?>
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
    <?php echo link_to("Yesterday","purchase/dsr?purchase[date][day]=".$yesterday->getDay()."&purchase[date][month]=".$yesterday->getMonth()."&purchase[date][year]=".$yesterday->getYear()); ?>
    <?php echo link_to("Tomorrow","purchase/dsr?purchase[date][day]=".$tomorrow->getDay()."&purchase[date][month]=".$tomorrow->getMonth()."&purchase[date][year]=".$tomorrow->getYear()); ?>
    <?php echo link_to("Go to DSR Multi Date","purchase/dsrmulti?invoice[date][day]=".$today->getDay()."&invoice[date][month]=".$today->getMonth()."&invoice[date][year]=".$today->getYear()."&purchase[date][day]=".$today->getDay()."&purchase[date][month]=".$today->getMonth()."&purchase[date][year]=".$today->getYear()); ?>

</form><h1>Daily Purchases Report </h1>
Date: <?php echo $form->getObject()->getDate(); $datearray=explode("-",$form->getObject()->getDate());?>


<br>Cash Purchases: <?php echo MyDecimal::format($cashtotal)?>
<br>Cheque Purchases: <?php echo MyDecimal::format($chequetotal)?>
<br>Credit Purchases: <?php echo MyDecimal::format($credittotal)?>
<br>Total Purchases: <?php echo MyDecimal::format($total)?>
<br><?php echo link_to("Print","purchase/dsrpdf?purchase[date][year]=".$datearray[0]."&purchase[date][month]=".$datearray[1]."&purchase[date][day]=".$datearray[2]);?>


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
    <td>Acct Purchases</td>
    <td>Salesman</td>
    <td>Remarks</td>
  </tr>
  <?php foreach(array(1,2,3,4,5) as $template_id){?>
    <?php foreach($events as $event){
      $purchase=$event->getParent();
      if($purchase->getTemplateId()==$template_id){?>
    <tr>
      <td><?php echo $purchase->getPurchaseTemplate() ?></td>
      <td><?php echo $purchase->getVendor()//." ".$purchase->getVendorName() ?></td>
      <td><?php echo link_to($purchase->getPono(),"purchase/view?id=".$purchase->getId()) ?></td>
      <td><?php echo $purchase->getDate() ?></td>
      <td><?php echo $event->getType().": ".$event->getDetail1().": ".$event->getDetail2() ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("cashamt");?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("chequeamt");?></td>
      <td align=right><?php if($purchase->getStatus()!="Cancelled")echo $event->getDetail("creditamt");?></td>
      <td><?php echo $purchase->getEmployee() ?></td>
      <td><?php echo $purchase->getStatus() ?></td>
      <td><?php //echo $event->getNotes() ?></td>
      <td><?php echo link_to("Edit","event/edit?id=".$event->getId()) ?></td>
    </tr>
    <?php }?>
    <?php }?>
    <?php foreach($purchases as $purchase)if($purchase->getTemplateId()==$template_id){?>
    <tr>
      <td><?php echo $purchase->getPurchaseTemplate() ?></td>
      <td><?php echo $purchase->getVendor()//." ".$purchase->getVendorName() ?></td>
      <td><?php echo link_to($purchase->getPono(),"purchase/view?id=".$purchase->getId()) ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td><?php echo $purchase->getParticularsString().($purchase->getCheque()?("; Check No.:".$purchase->getCheque().": ".$purchase->getChequedate()):"") ?></td>
      <td><?php //echo $purchase->getTotal() ?></td>
      <td align=right><?php if($purchase->getCash()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCash() ?></td>
      <td align=right><?php if($purchase->getCheque()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCheque() ?></td>
      <td align=right><?php if($purchase->getCredit()>0 and $purchase->getStatus()!="Cancelled")echo $purchase->getCredit() ?></td>
      <td><?php echo $purchase->getEmployee() ?></td>
      <td><?php echo $purchase->getStatus() ?></td>
      <td><?php //echo $purchase->getNotes() ?></td>
      <td><?php echo link_to("Edit","purchase/edit?id=".$purchase->getId()) ?></td>
      <td>
        <?php if($purchase->getIsInspected()==0)echo "<font color=red>Not Inspected</font>" ?>
	  <?php if($purchase->getIsInspected()==1)echo "<font color=green>Inspected</font>" ?>
      </td>
    </tr>
    <?php }?>
    <tr>
      <td></td>
    </tr>
  <?php }?>
</table>


