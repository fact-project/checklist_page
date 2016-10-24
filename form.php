<?php require_once("get_status_functions.php"); ?>

<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data" >
      <input type='hidden' name='Obsname' maxlength="50" value="<?php echo $_POST['Uname']; ?>" /> <br>
      <input type='hidden' name='Obsmail' maxlength="50" value="<?php echo getEmail(); ?>" /> <br>

      <table style="width:100%">
        <tr>
          <th>Check:</th>
          <th>Current state:</th>
          <th>Wanted state:</th>
          <th>CheckBox:</th>
        </tr>
        <tr>
          <td>Telescope Parked?</td>
          <td><img src="../cam/snap2.jpg" width="320" height="250" alt="cam picture" /></td>
          <td> check visually if parked </td>
          <td> <input type="checkbox" name="ticked_checks" value="parked"> </td>
        </tr>
        <tr>
          <td>Drive Locked?</td>
          <td><?php echo drive_status(); ?></td>
          <td>Locked</td>
          <td> <input type="checkbox" name="ticked_checks" value="is_locked"> </td>
        </tr>
        <tr>
          <td>Bias Disconnected</td>
          <td><?php echo bias_status(); ?></td>
          <td>Disconnected</td>
          <td> <input type="checkbox" name="ticked_checks" value="bias_off"> </td>
        </tr>
        <tr>
          <td>Trigger Off</td>
          <td><?php echo trigger_status(); ?></td>
          <td>Valid</td>
          <td> <input type="checkbox" name="ticked_checks" value="trigger_off"> </td>
        </tr>
        <tr>
          <td>Camera Lid Closed</td>
          <td>
            <img src="../cam/lidcam2.jpg" width="320" height="250" alt="lid picture" />
            <?php echo lid_status(); ?>
          </td>
          <td>Closed</td>
          <td> <input type="checkbox" name="ticked_checks" value="lid_closed"> </td>
        </tr>
        <tr>
          <td>Drive Off</td>
          <td><?php echo drive_power(); ?></td>
          <td>DriveOff</td>
          <td> <input type="checkbox" name="ticked_checks" value="drive_off"> </td>
        </tr>
        <tr>
          <td>TPoint Camera Off?</td>
          <td> - </td>
          <td>it should be off</td>
          <td> <input type="checkbox" name="ticked_checks" value="tpoint_off"> </td>
        </tr>
        <tr>
          <td>Are you sure?</td>
          <td> </td>
          <td> </td>
          <td> <input type="checkbox" name="ticked_checks" value="affirmed"> </td>
        </tr>
        <tr>
          <td>Nominated Checker's Email</td>
          <td> </td>
          <td> </td>
          <td> <input type='text' name='Email' /> </td>
        </tr>
      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>