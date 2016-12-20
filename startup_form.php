<?php require_once("get_status_functions.php"); ?>

<form method="post" action="startup_doit.php"  enctype="multipart/form-data" >
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
          <td>No tourists?</td>
          <td><img src="../cam/snap2.jpg" width="320" height="250" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="parked"> </td>
        </tr>

        <tr>
          <td>Camera Looks okay?</td>
          <td>
            <img src="../cam/lidcam2.jpg" width="320" height="250" alt="lid picture" />
            <br>
            <?php echo lid_status(); ?>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="lid_closed"> </td>
        </tr>

        <tr>
          <td>Dummy Alert worked?</td>
          <td>
          <a target="_blank" href="https://ihp-pc41.ethz.ch/">shifthelper webinterface</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="dummy_alert"> </td>
        </tr>


        <tr>
          <td>Ist the schedule filled?</td>
          <td>
          <a target="_blank" href="https://www.fact-project.org/schedule/">Observation Scheduler</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="schedule_filled"> </td>
        </tr>

        <tr>
          <td>Are there Swift observations?</td>
          <td>
          <a target="_blank" href="http://fact-project.org/dch/scheduling.php">scheduling.php</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="swift"> </td>
        </tr>

        <tr>
          <td>
            Do the FACT++ programs run
            <br>
            (green or yellow on this page)?
            <br>
            Are there at least 1.5TB diskspace? (last two rows)
          </td>
          <td>
            <a target="_blank" href="https://fact-project.org/smartfact/index.html?#status">smartfact</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="servers_online"> </td>
        </tr>

      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
