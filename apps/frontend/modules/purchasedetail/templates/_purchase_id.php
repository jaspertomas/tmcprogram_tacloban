        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_purchase_id">
        <div>
      <label for="purchasedetail_product_id">purchase No.</label>
      <div class="content">
      <?php 
        $purchase=$form->getObject()->getPurchase();
        echo link_to($purchase,"purchase/view?id=".$purchase->getId());
        echo " ";
        echo link_to("(Edit)","purchase/edit?id=".$purchase->getId());
      ?>
             
      <input type="hidden" name="purchasedetail[purchase_id]" value="<?php echo $purchase->getId()?>" id="purchasedetail_purchase_id" ?>
      </div>
      </div>

