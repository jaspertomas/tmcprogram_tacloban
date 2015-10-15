<?php use_helper('I18N', 'Date') ?>
<?php $form=new InvoicedetailForm(); ?>
<?php echo form_tag("product/barcodepdf"); ?>

<table>
  <tr>
    <td>Product:</td>
    <td><?php echo $form["product_id"]?></td>
  </tr>
  <tr>
    <td>Start:</td>
    <td><input name=start></td>
  </tr>
  <tr>
    <td>Qty:</td>
    <td><input name=qty></td>
  </tr>
  <tr>
    <td></td>
    <td><input type=submit value=Create Barcodes></td>
  </tr>
</table>


</form>
