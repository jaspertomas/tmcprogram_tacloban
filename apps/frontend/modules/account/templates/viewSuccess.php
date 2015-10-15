<?php use_helper('I18N', 'Date') ?>
<h1>Accounting: <?php echo '"'.link_to($account->getName(),"account/view?id=".$account->getId()).'"'?></h1>

<table>
  <tr>
    <td>Current Quantity: </td>
    <td><?php echo $account->getCurrentqty()." as of ".MyDateTime::frommysql($account->getDate())->toshortdate()?></td>
  </tr>
  <!--tr>
    <td><?php //echo link_to("Calculate","account/calc?id=".$account->getId()) ?></td>
  </tr-->
</table>

<!--search by date-->
<?php echo form_tag("account/viewbydate"); ?>
<table>
	<tr>
		<td>Start Date</td>
		<td>End Date</td>
	</tr>
	<tr>
		<td><input name=startdate value=<?php echo $startdate ?>></td>
		<td><input name=enddate value=<?php echo $enddate ?>></td>
		<td><input type=hidden id=id name=id value=<?php echo $account->getId() ?>  ></td>
		<td><input type=submit name=submit value=Search  ></td>
	</tr>
</table>
</form>
<!---->
<br>
<?php //echo link_to("Add Detail","accountentry/new?account_id=".$account->getId()) ?>
<?php $form=new AccountentryForm(); ?>
<?php echo form_tag_for($form,"@accountentry"); ?>
<input type=hidden name=accountentry[account_id] value=<?php echo $account->getId()?>  >
    <?php echo $form->renderHiddenFields(false) ?>
<table>
	<tr>
		<td>Date</td>
		<td>Qty</td>
		<td>Type</td>
		<td>Description</td>
	</tr>
	<tr>
		<td><?php echo $form["date"]; ?></td>
		<td><input name="accountentry[qty]" id="accountentry_qty" type="text" value=1></td>
		<td><?php echo $form["type"]; ?></td>
		<td><?php echo $form["description"]; ?></td>
		<td><input type=submit name=submit value=Save  ></td>
	</tr>
</table>
</form>

<br>
<table border=1>
  <tr>
    <td>Date</td>
    <td>Account In</td>
    <td>Account Out</td>
    <td>Balance</td>
    <td>Ref</td>
    <td>Type</td>
    <td>Description</td>
  </tr>
  <?php foreach($accountentries as $detail){?>
  <tr>
    <td><?php echo MyDateTime::frommysql($detail->getDate())->toshortdate() ?></td>
    <td align=right><?php if($detail->getQty()>0)echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getQty()<0)echo MyDecimal::format($detail->getQty()*-1) ?></td>
    <td align=right><?php echo $detail->getBalance() ?></td>
    <td><?php 
      
      if($detail->getRefClass()=="Invoicedetail"){$ref=$detail->getRef();echo link_to($ref->getInvoice(),"invoice/view?id=".$ref->getInvoiceId());}
      else if($detail->getRefClass()=="Purchasedetail"){$ref=$detail->getRef();echo link_to($ref->getPurchase(),"purchase/view?id=".$ref->getPurchaseId());}
      else if($detail->getRefClass())echo link_to($detail->getRef(),strtolower($detail->getRefClass())."/view?id=".$detail->getRefId());
      ?></td>
    <td><?php echo $detail->getType() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php if($detail->getType())echo link_to('Delete','accountentry/delete?id='.$detail->getId(),array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
  </tr>
  <?php }?>
</table>


