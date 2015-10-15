<?php use_helper('I18N', 'Date',"Text") ?>

<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); 
  for(var index = 0; index < boxes.length; index++) 
  { 
    box = boxes[index]; 
    if (box.type == 'checkbox') 
      box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked;
  } 
  return true;
}
/* ]]> */
</script>

<?php echo html_entity_decode($notes->getBreadcrumbs()); ?>
&nbsp;&nbsp;<?php if(!$notes->isRoot())echo link_to("(Edit)","notes/edit?id=".$notes->getId()) ?>
<hr>
<h1><?php echo $notes->getName() ?></h1>
<?php echo simple_format_text($notes->getContent()) ?>
<hr>

<?php echo form_tag("notes/view?id=".$notes->getId(),array("method"=>"get"))?>
View <input name=levels size=1 value=<?php echo $levels?>><input type=submit name=submit value=Levels />
</form>
<br>
<?php echo form_tag_for(new NotesForm(),"notes/massoper")?>
<table>
  <tr>
    <td>Id</td>
    <td><input id="sf_admin_list_batch_checkbox" onclick="checkAll();" type="checkbox"></td>
    <td>Name</td>
    <td>Description</td>
    <td>Status</td>
  </tr>

  <?php include_partial("showchildren",array("producttype"=>$notes,"children"=>$notes->getChildren(),"levels"=>$levels,"level"=>0)); ?>

</table>

<?php echo link_to("Add Child","notes/new?parent_id=".$notes->getId()) ?>
<br>
<br>
<input name=parent_id size=1 >
<input type=submit name=submit value=Move />
<input type=submit name=submit value=Copy />
</form>


