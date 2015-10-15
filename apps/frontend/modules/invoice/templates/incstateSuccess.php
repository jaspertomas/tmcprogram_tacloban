<?php use_helper('I18N', 'Date') ?>
<h1>Income Statement</h1>

<table>
  <?php foreach($bymonth as $date=>$day){?>
  <tr valign=top>
    <td ><?php echo $date?></td>
    <td ><?php echo $day["cash"]?></td>
    <td ><?php echo $day["cheque"]?></td>
    <td ><?php echo $day["credit"]?></td>
  </tr>
  <?php }?>
  <tr valign=top>
    <td ></td>
    <td ><?php echo $cashtotal?></td>
    <td ><?php echo $chequetotal?></td>
    <td ><?php echo $credittotal?></td>
  </tr>
</table>


