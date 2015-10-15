<?php use_helper('I18N', 'Date') ?>
<h1>Invoice Edit</h1>
<?php slot('transaction_id', $invoice->getId()) ?>
<?php slot('transaction_type', "Invoice") ?>

<table>
  <tr valign=top>
    <td>
      <table>
        <tr>
          <td>Date</td>
          <td><?php echo $invoice->getDate() ?></td>
        </tr>
        <tr>
          <td>Inv no.</td>
          <td><?php echo $invoice->getInvoiceTemplate()." ".$invoice->getInvno() ?></td>
        </tr>
        <tr>
          <td>PO No.</td>
          <td><?php echo $invoice->getPonumber() ?></td>
        </tr>
        <tr>
          <td>Customer</td>
          <td><?php echo link_to($invoice->getCustomer(),"customer/edit?id=".$invoice->getCustomerId()) ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td><?php echo $invoice->getCash()."+".$invoice->getChequeamt()."+".$invoice->getCredit()."=".$invoice->getTotal() ?></td>
        </tr>
        <tr>
          <td><?php echo link_to("Edit","invoice/edit?id=".$invoice->getId()) ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>Sale Type</td>
          <td><?php echo $invoice->getSaleType() ?></td>
        </tr>
        <tr>
          <td>Due date</td>
          <td><?php echo $invoice->getDuedate() ?></td>
        </tr>
        <tr>
          <td>Sales Representative</td>
          <td><?php echo $invoice->getEmployee() ?></td>
        </tr>
        <tr>
          <td>Discount Rate</td>
          <td><?php echo $invoice->getDiscrate() ?></td>
        </tr>
        <tr>
          <td>Discount Amount</td>
          <td><?php echo $invoice->getDiscamt() ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td>Cash</td>
          <td><?php echo $invoice->getCash() ?></td>
        </tr>
        <tr>
          <td>Cheque</td>
          <td><?php echo $invoice->getChequeAmt() ?></td>
        </tr>
        <tr>
          <td>Account</td>
          <td><?php echo $invoice->getCredit() ?></td>
        </tr>
        <tr>
          <td>Terms</td>
          <td><?php echo $invoice->getTerms() ?></td>
        </tr>
        <tr>
          <td>Notes</td>
          <td><?php echo $invoice->getNotes() ?></td>
        </tr>
      </table>
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
				<!--tr>
					<td>Cheque No</td>
					<td><?php //echo $purchase->getChequeno() ?></td>
				</tr>
				<tr>
					<td>Cheque Date</td>
					<td><?php //echo $purchase->getChequedate() ?></td>
				</tr>
				<tr>
					<td>Cheque Amount</td>
					<td><?php //echo $purchase->getCheque() ?></td>
				</tr-->
				<tr>
					<td>Cheque Data</td>
        <?php $cheques=explode(", ",$invoice->getChequedata());foreach($cheques as $cheque)  {?>
					<td><?php echo $cheque?></td>				
			  </tr>
				<tr>
					<td></td>				
			  <?php } ?>
				</tr>
			</table>
    </td>
  </tr>
</table>
          <td><?php echo link_to("Cheque Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=ChequeCollect") ?></td>
          <td><?php echo link_to("Cash Collection","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=CashCollect") ?></td>
          <td><?php echo link_to("Bank Expense","event/new?parent_class=Invoice&parent_id=".$invoice->getId()."&type=BankExp") ?></td>
          <td><?php echo link_to("Cancel","invoice/cancel?id=".$invoice->getId()) ?></td>
          <td><?php if($invoice->getSaletype()!="Cash")echo link_to("Cash sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Cash") ?></td>
          <td><?php if($invoice->getSaletype()!="Cheque")echo link_to("Cheque sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Cheque") ?></td>
          <td><?php if($invoice->getSaletype()!="Credit")echo link_to("Account sale","invoice/adjustsaletype?id=".$invoice->getId()."&type=Account") ?></td>
<br>
          <td><?php echo link_to("View Details","invoice/view?id=".$invoice->getId()) ?></td>
          <td><?php echo link_to("View Events","invoice/events?id=".$invoice->getId()) ?></td>
          <td><?php echo link_to("View Accounting","invoice/accounting?id=".$invoice->getId()) ?></td>



<br>
<br><b>Account Entries:</b>
<table border=1>
  <tr>
    <td></td>
    <td>Type</td>
    <td>Description</td>
    <td>Income</td>
    <td>Cash</td>
    <td>In Cheque</td>
    <td>Receivable</td>
  </tr>
  <?php foreach($accountentries as $detail)if($detail->getQty()!=0){?>
  <tr>
    <td><?php echo $detail->getRef() ?></td>
    <td><?php echo $detail->getDescription() ?></td>
    <td><?php echo $detail->getType() ?></td>
    <?php $invoice->getAccountIds(); ?>
    <td align=right><?php if($detail->getAccountId()==$invoice->accountids['account_id_salesincome'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$invoice->accountids['account_id_cash_on_hand'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$invoice->accountids['account_id_inchecks'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td align=right><?php if($detail->getAccountId()==$invoice->accountids['account_id_receivables'])echo MyDecimal::format($detail->getQty()) ?></td>
    <td><?php //echo link_to("Edit","event/edit?id=".$detail->getId()) ?></td>
    <td><?php //echo link_to($detail->getDate(),"event/edit?id=".$detail->getId()) ?></td>
  </tr>
  <?php }?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$invoice->accountids['account_id_salesincome']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$invoice->accountids['account_id_cash_on_hand']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$invoice->accountids['account_id_inchecks']])?></td>
    <td align=right><?php echo MyDecimal::format($totalsbyaccount[$invoice->accountids['account_id_receivables']])?></td>
    <td></td>
  </tr>
</table>

