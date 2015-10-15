<?php 
/*
if not new notes
show "autogenerate children from text" form
*/

if($form->getObject()->getId()){?>
<?php echo form_tag("notes/autogenchildren");?>
<input type=hidden name=id value=<?php echo $form->getObject()->getId();?> >
<textarea name=text id=text>

</textarea>
<br><input type=submit value="Auto Create Children">
</form>
<?php } ?>

