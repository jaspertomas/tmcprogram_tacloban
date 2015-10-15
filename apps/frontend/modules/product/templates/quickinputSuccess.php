<?php use_helper('I18N', 'Date') ?>
<h1>Product Quick Input</h2>

<font color=red>
<?php foreach($errors as $error)echo $error."<br>"; ?>
</font>
<font color=green>
<?php foreach($messages as $message)echo $message."<br>"; ?>
</font>

<?php echo form_tag_for(new ProductForm(),"product/quickinput")?>

Paste from spreadsheet:
<br>
<input name=submit type=submit value="Test">
<?php 
  if($tested and count($errors)==0)
    echo "<input name=submit type=submit value='Save'>"; 
?>

<br><textarea rows=15 cols=80 name=inputstring ><?php echo $inputstring?></textarea>
</form>



