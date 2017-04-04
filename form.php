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
          <td> Reaction </td>
        </tr>
        <tr>
          <td>Telescope Parked?</td>
          <td><img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="parked"> </td>
          <td> Call expert! --> Call MAGIC shift leader!</td>
        </tr>
        <tr>
          <td>Drive Locked?</td>
          <td><?php echo drive_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="is_locked"> </td>
          <td> Call expert </td>
        </tr>
        <tr>
          <td>Bias Disconnected</td>
          <td><?php echo bias_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="bias_off"> </td>
          <td> check <a href="http://www.fact-project.org/showlog/index.php?log=biasctrl#bottom">showlog biasctrl</a>
          if bias was "VoltageOff", before "Disconnected"; if yes, all good just report via email; if not call expert. </td>
        </tr>
        <tr>
          <td>Trigger Valid</td>
          <td><?php echo trigger_status(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="trigger_off"> </td>
          <td> report via email to fact-online </td>
        </tr>
        <tr>
          <td>Camera Lid Closed</td>
          <td>
            <img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />
            <br>
            <?php echo lid_status(); ?>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="lid_closed"> </td>
          <td> try to "Close lid" again using <a href="http://fact-project.org/smartfact/index.html?sound#control-lid">smartfact</a>.
          If it works, note problem in logbook. If it still does not work, call dneise.
          </td>
        </tr>
        <tr>
          <td>Drive Off ?</td>
          <td><?php echo drive_power(); ?></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="drive_off"> </td>
          <td> try to "Toggle Drive" again using <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">smartfact</a>.
          Wait a bit after the command. If it still does not work, but telescope is Locked report via email, else call expert.
          </td>
        </tr>
        <tr>
          <td>TPoint Camera Off?</td>
          <td> check if TPoint cam is Off on <a href="http://10.0.100.230/ov.html">This power switch - port 2</a>. </td>
          <td> If not Off, switch it off. If the page does not load - make sure you use VPN. if still not and you did not switch it on during the night; just report via email. If you think it might be on, because you used it, call expert.</td>
          <td> <input type="checkbox" name="ticked_checks[]" value="tpoint_off"> </td>
        </tr>
      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
