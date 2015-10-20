<?php use_helper('I18N', 'Date') ?>
<h1>Temporary Invoices (Checked Out) <?php echo link_to("Refresh","invoice/listcheckedout")?></h1>

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
  <?php foreach($invoices as $invoice)if($invoice->getIsTemporary()==1){?>
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
<hr>
<h2>Temporary Invoices (New) </h2>
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
  <?php foreach($invoices as $invoice)if($invoice->getIsTemporary()==2){?>
  <tr>
      <td><?php echo $invoice->getInvno() ?></td>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getParticularsString().($invoice->getCheque()?("; Check No.:".$invoice->getCheque().": ".$invoice->getChequedate()):"") ?></td>
      <td><?php echo $invoice->getTotal() ?></td>
      <td><?php echo $invoice->getNotes() ?></td>
  </tr>
  <?php }?>
</table>
<hr>
<hr>
<h2>Closed Invoices</h2>
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
  <?php foreach($invoices as $invoice)if($invoice->getIsTemporary()==0){?>
  <tr>
      <td><?php echo $invoice->getInvno() ?></td>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getParticularsString().($invoice->getCheque()?("; Check No.:".$invoice->getCheque().": ".$invoice->getChequedate()):"") ?></td>
      <td><?php echo $invoice->getTotal() ?></td>
      <td><?php echo $invoice->getNotes() ?></td>
  </tr>
  <?php }?>
</table>
