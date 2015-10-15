        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_invoice_id">
        <div>
      <label for="invoicedetail_product_id">Invoice No.</label>
      <div class="content">
      <?php 
        $invoice=$form->getObject()->getInvoice();
        echo link_to($invoice,"invoice/view?id=".$invoice->getId());
        echo " ";
        echo link_to("(Edit)","invoice/edit?id=".$invoice->getId());
      ?>
             
      <input type="hidden" name="invoicedetail[invoice_id]" value="<?php echo $invoice->getId()?>" id="invoicedetail_invoice_id" ?>
      </div>
      </div>

