        <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_stock_id">
        <div>
      <label for="stockentry_product_id">Account No.</label>
      <div class="content">
      <?php 
        $stock=$form->getObject()->getAccount();
        echo $form["stock_id"];
        echo link_to($stock->getProduct()." in ".$stock->getWarehouse(),"stock/view?id=".$stock->getId());
        echo " ";
        echo link_to("(Edit)","stock/edit?id=".$stock->getId());
      ?>
             
      </div>
      </div>

