<?php use_helper('I18N', 'Date') ?>
<?php if ($sf_user->hasFlash('msg')): ?>
  <div class="flash_msg"><font color=green><?php echo $sf_user->getFlash('msg') ?></font></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><font color=red><?php echo $sf_user->getFlash('error') ?></font></div>
<?php endif ?>
<h1>
	Invoice Payments
</h1>
<?php slot('transaction_id', $invoice->getId()) ?>
<?php slot('transaction_type', "Invoice") ?>

<table>
  <tr valign=top>
    <td>
      <table>
        <tr>
          <td>Inv no.</td>
          <td>
            <?php echo $invoice->getInvoiceTemplate()." ".$invoice->getInvno(); ?>
          </td>
        </tr>
        <tr>
          <td>Date</td>
          <td><?php echo $invoice->getDate() ?></td>
        </tr>
        <!--tr>
          <td>PO No.</td>
          <td><?php //echo $invoice->getPonumber() ?></td>
        </tr-->
        <tr>
          <td>Customer</td>
          <td><?php echo link_to($invoice->getCustomer(),"customer/view?id=".$invoice->getCustomerId(),array("target"=>"edit_customer"))." (".$invoice->getCustomer()->getTinNo().")"; ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>Sale Type</td>
          <td><?php echo $invoice->getSaleType() ?></td>
        </tr>
        <!--tr>
          <td>Due date</td>
          <td><?php //echo $invoice->getDuedate() ?></td>
        </tr-->
        <tr>
          <td>Sales Representative</td>
          <td><?php echo $invoice->getEmployee() ?></td>
        </tr>
        <!--tr>
          <td>Discount Rate</td>
          <td><?php //echo $invoice->getDiscrate() ?></td>
        </tr>
        <tr>
          <td>Discount Amount</td>
          <td><?php //echo $invoice->getDiscamt() ?></td>
        </tr-->
        <tr>
          <td>Total</td>
          <td><?php echo $invoice->getCash()."+".$invoice->getChequeamt()."+".$invoice->getCredit()."=".$invoice->getTotal() ?></td>
        </tr>
      </table>
    </td>
    <td>
    </td>
    <td>
			<table>
		<tr>
		<td>Status</td>
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
		</tr>
        <tr>
          <td>Notes</td>
          <td><?php echo $invoice->getNotes() ?></td>
        </tr>
				<!--tr>
					<td>Cheque Data</td>
        <?php //$cheques=explode(", ",$invoice->getChequedata());foreach($cheques as $cheque)  {?>
					<td><?php //echo $cheque?></td>				
			  </tr>
				<tr>
					<td></td>				
			  <?php //} ?>
				</tr-->
        <tr>
          <td><?php echo link_to("Edit","invoice/edit?id=".$invoice->getId(),array("id"=>"invoice_edit")) ?></td>
        </tr>
		</table>
    </td>
  </tr>
</table>

<br><b>Events:</b>
<table border=1>
  <tr>
    <td>Date</td>
    <td>Type</td>
    <td>Amount</td>
    <td>Check No</td>
    <td>Check Date</td>
  </tr>
  <?php foreach($invoice->getEvents() as $detail){?>
  <tr>
    <td><?php echo link_to($detail->getDate(),"event/edit?id=".$detail->getId()) ?></td>
    <td><?php echo $detail->getType() ?></td>
    <td><?php echo $detail->getAmount() ?></td>
    <td><?php echo $detail->getDetail1() ?></td>
    <td><?php echo $detail->getDetail2() ?></td>
    <td><?php echo link_to("Edit","event/edit?id=".$detail->getId()) ?></td>
    <td>
<?php echo link_to(
  'Delete',
  'event/delete?id='.$detail->getId(),
  array('method' => 'delete', 'confirm' => 'Are you sure?')
) ?>

    </td>
  </tr>
  <?php }?>
</table>
<br>
<table>
	<tr>
          <td><?php echo link_to("View Details","invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php echo link_to("Cash Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=CashCollect") ?></td>
      <td><?php echo link_to("Cheque Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=ChequeCollect") ?></td>
      <td><?php //echo link_to("Bank Expense","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=BankExp") ?></td>
	</tr>
</table>

<script>
var manager_password="<?php 
	    $setting=Doctrine_Query::create()
	        ->from('Settings s')
	      	->where('name="manager_password"')
	      	->fetchOne();
      	if($setting!=null)echo $setting->getValue();
?>";
$('#invoice_edit').click(function(event) {
    event.preventDefault();
    var pass=prompt("ENTER MANAGER PASSWORD","");
    //if password is correct
    if (pass==manager_password){
       window.location = $(this).attr('href');
    }
    //if cancelled
    else if(pass==null){}
    else
    {
        	alert("WRONG PASSWORD");
    }
    
});
</script>
