<?php use_helper('I18N', 'Date') ?>
<?php $form=new InvoicedetailForm(); ?>

<?php echo form_tag("purchase/barcodepdf"); ?>
<input type=hidden name=id value="<?php echo $purchase->getId()?>">
<br>
Start: <input name=start value="<?php echo $start?>">
<br>
<br>
<table>
  <tr>
    <td>Product:</td>
    <td>Qty:</td>
    <td>Sellprice:</td>
  </tr>
  <?php foreach($details as $detail){?>
  <tr>
    <td><?php echo $detail->getProduct()->getName(); ?></td>
    <td><input name=qty[] value=<?php echo $detail->getQty();?>></td>
    <td><?php echo $detail->getQty();?></td>
  </tr>
  <?php }?>
  <tr>
    <td></td>
    <td><input type=submit value="Create Barcodes PDF"></td>
  </tr>
</table>


</form>
