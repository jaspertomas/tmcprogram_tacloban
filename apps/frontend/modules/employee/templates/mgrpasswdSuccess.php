<?php if ($sf_user->hasFlash('msg')): ?>
  <div class="flash_msg"><font color=green><?php echo $sf_user->getFlash('msg') ?></font></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><font color=red><?php echo $sf_user->getFlash('error') ?></font></div>
<?php endif ?>

<h1>Manager Password</h1>
<?php if($setting==null){echo "Manager Password not set";} else { ?>

<?php echo form_tag('employee/processmgrpasswd'); ?>
      <table>
        <tr>
          <td>Old password:</td>
          <td><input name="oldpass" autocomplete="off"></td>
        </tr>
        <tr>
          <td>New password:</td>
          <td><input name="newpass1" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Repeat new password:</td>
          <td><input name="newpass2" autocomplete="off"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type=submit value=Save></td>
        </tr>
      </table>
</form>

<?php } ?>

