
<table border=1>
  <tr>
    <td>Id</td>
    <td>Product</td>
    <td>Max Sale Price</td>
    <td>Min Sale Price</td>
    <td>Max Buy Price</td>
    <td>Min Buy Price</td>
  </tr>
  <?php
foreach($products as $product){ 	?>
  <tr>
    <td><?php echo $product->getId() ?></td>
    <td><?php echo link_to($product->getName(),"product/view?id=".$product->getId()) ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMaxsellprice()==""?0:$product->getMaxsellprice()) ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMinsellprice()==""?0:$product->getMinsellprice()) ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMaxbuyprice()==""?0:$product->getMaxbuyprice()) ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMinbuyprice()==""?0:$product->getMinbuyprice()) ?></td>
    <td align=right><?php echo MyDecimal::format($product->getMinbuyprice()==0?0:$product->getMinsellprice()/$product->getMinbuyprice()) ?></td>
  </tr>
  <?php }?>
</table>
