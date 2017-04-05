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
          <td>Check</td>
          <td>Status</td>
          <td> Checked? </td>
          <td> If not good - try ONCE ONLY </td>
          <td> If still not, call: </td>
        </tr>
        <tr>
          <td>Telescope Parked?</td>
          <td><img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="parked"> </td>
          <td>
            <ul>
              <li> Switch Drive On again </li>
              <li> <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">The "park telescope" button</a> </li>
              <li> Switch Drive Off again </li>
              <li> see also <a href="https://trac.fact-project.org/wiki/TroubleShootingDrivectrl%20"> 
                    Trouble Shooting Drive </a> </li>
            </ul>
          </td>
          <td> Call expert! --> Call MAGIC shift leader!</td>
        </tr>
        <tr>
          <td>Drive Locked?</td>
          <td><?php echo drive_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="is_locked"> </td>
          <td>
            <ul>
              <li> Switch Drive On again </li>
              <li> <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">The "park telescope" button</a> </li>
              <li> Switch Drive Off again </li>
              <li> see also <a href="https://trac.fact-project.org/wiki/TroubleShootingDrivectrl%20"> 
                    Trouble Shooting Drive </a> </li>                 
            </ul>
          </td>
          <td> Call expert </td>
        </tr>
        <tr>
          <td>Bias VoltageOff</td>
          <td> [not yet implemented] </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="is_bias_VoltageOff"> </td>
          <td> - </td>
          <td> call expert</td>
        </tr>
        <tr>
          <td>Bias Disconnected</td>
          <td><?php echo bias_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="bias_off"> </td>
          <td> - </td>
          <td> call expert </td>
        </tr>
        <tr>
          <td>Trigger Valid</td>
          <td><?php echo trigger_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="trigger_off"> </td>
          <td> - </td>
          <td> email to fact-online </td>
        </tr>
        <tr>
          <td>Camera Lid Closed</td>
          <td>
            <img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />
            <br>
            <?php echo lid_status(); ?>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="lid_closed"> </td>
          <td> "Close lid" on <a href="http://fact-project.org/smartfact/index.html?sound#control-lid">smartfact</a> </td>
          <td> if stormy: call expert (something might damage window); else just an email to fact-online. </td>
        </tr>
        <tr>
          <td>Drive Off ?</td>
          <td><?php echo drive_power(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="drive_off"> </td>
          <td> "Toggle Drive" on <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">smartfact</a>  - wait a bit.</td>
          <td> call expert </td>
        </tr>
        <tr>
          <td>TPoint Camera Off?</td>
          <td> check if TPoint cam is Off on <a href="http://10.0.100.230/ov.html">This power switch - port 2</a>. </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="tpoint_off"> </td>
          <td> switch it off - VPN needed.</td>
          <td> call expert </td>
        </tr>
      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
