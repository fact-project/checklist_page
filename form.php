<?php require_once("get_status_functions.php"); ?>

<form method="post" action="doit.php"  enctype="multipart/form-data" >
      <input type='hidden' name='Obsname' maxlength="50" value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Obsmail' maxlength="50" value="<?php echo getEmail(); ?>" />
      <input type='hidden' name='Uname' maxlength="50" value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Passwd' maxlength="50" value="<?php echo $_POST['Passwd']; ?>" />

      <style>
          table, td {
              border: 1px solid grey;
              border-collapse: collapse;
          }
      </style>

      <table style="width:600">
        <tr>
          <td>Telescope Parked?</td>
          <td><img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="parked"> </td>
        </tr>
        <tr>
          <td>Drive Locked?</td>
          <td><?php echo drive_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="is_locked"> </td>
        </tr>
        <tr>
          <td>Bias Disconnected</td>
          <td><?php echo bias_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="bias_off"> </td>
        </tr>
        <tr>
          <td>Trigger Valid</td>
          <td><?php echo trigger_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="trigger_off"> </td>
        </tr>
        <tr>
          <td>Camera Lid Closed</td>
          <td>
            <img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />
            <br>
            <?php echo lid_status(); ?>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="lid_closed"> </td>
        </tr>
        <tr>
          <td>Drive Off ?</td>
          <td><?php echo drive_power(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="drive_off"> </td>
        </tr>
        <tr>
          <td>TPoint Camera Off?</td>
          <td> - check manually -  </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="tpoint_off"> </td>
        </tr>
        <tr>
          <td>Nominated Checker's Email</td>
          <td> <input type='text' name='Email' /> </td>
        </tr>
      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
