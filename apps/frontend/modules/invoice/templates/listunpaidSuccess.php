<?php use_helper('I18N', 'Date') ?>
<h1>Unpaid Invoices <?php echo link_to("Refresh","invoice/listunpaid")?></h1>

<table border=1>
  <tr>
    <td>Date</td>
    <td>Type</td>
    <td>Customer</td>
    <td>Salesman</td>
    <td>Particulars</td>
    <td>Total Price</td>
    <td>Notes</td>
  </tr>
  <?php foreach($invoices as $invoice){?>
  <tr>
      <td><?php echo link_to($invoice->getInvno(),"invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getParticularsString().($invoice->getCheque()?("; Check No.:".$invoice->getCheque().": ".$invoice->getChequedate()):"") ?></td>
      <td><?php echo $invoice->getTotal() ?></td>
      <td><?php echo $invoice->getNotes() ?></td>
  </tr>
  <?php }?>
</table>