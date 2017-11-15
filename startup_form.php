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
          <td>Check</td>
          <td>Status</td>
          <td> Checked? </td>
          <td> Reaction </td>
        </tr>

        <tr>
          <td> Read the emails of the last 2 days that came over `fact-online@lists.phys.ethz.ch`</td>
          <td> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="all_emails_read"> </td>
          <td> </td>
        </tr>

        <tr>
          <td>No people inside fence?</td>
          <td><img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="parked"> </td>
          <td> If FACT/MAGIC members, try to contact them. If tourists, call MAGIC shiftleader.</td>
        </tr>

        <tr>
         <td>Mirrors fallen off or loose? <br> Ice on structure?</td>
          <td><img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" /></td>
          <td> <input type="checkbox" name="ticked_checks[]" value="mirrors_good"> </td>
          <td> ask MAGIC to have a look; if MAGICs can clear the situation: observe; else: don't observe.</td>
        </tr>

        <tr>
          <td>Camera Looks okay?</td>
          <td>
            <img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />
            <br>
            <?php echo lid_status(); ?>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="lid_closed"> </td>
          <td> Call Expert </td>
        </tr>

        <tr>
          <td>Are there any ORM alerts?</td>
          <td>
            <a href="http://www.iac.es/eno.php?op1=2&op2=5&op3=58&lang=en" target="_blank">
              ORM status report
            </a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="orm_alerts"> </td>
        </tr>

        <tr>
          <td>Dummy Alert worked?</td>
          <td>
          <a target="_blank" href="https://shifthelper.app.tu-dortmund.de">shifthelper webinterface</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="dummy_alert"> </td>
          <td> Call SH developers: mnoethe or dneise.</td>
        </tr>


        <tr>
          <td>Is the schedule filled?</td>
          <td>
          <a target="_blank" href="https://www.fact-project.org/schedule/">Observation Scheduler</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="schedule_filled"> </td>
          <td> Fill it, in doubt ask ddorner.</td>
        </tr>

        <tr>
          <td>Are there Swift observations?</td>
          <td>
          <a target="_blank" href="http://fact-project.org/dch/scheduling.php">scheduling.php</a>
          </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="swift"> </td>
          <td> Fill them in the schedule, in doubt ask ddorner. </td>
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

          <td> Call expert. </td>
        </tr>

        <tr>
          <td> Make a logbook entry for the night.</td>
          <td> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="has_prepared_logbook_entry"> </td>
          <td> <a href="https://www.fact-project.org/logbook/calendar.php?action=addevent&calendar=1" target="_blank">make a new entry for tonight</a>></td>
        </tr>

        <tr>
          <td> Switch the drive on</td>
          <td> <?php echo drive_power(); ?> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="has_drive_switched_on"> </td>
          <td> <a href="http://fact-project.org/smartfact/index.html?sound#dodrivetoggle" target="_blank">toggle drive</a>></td>
        </tr>

        <tr>
          <td> Unlock the drive </td>
          <td> <?php echo drive_status(); ?> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="has_drive_unlocked"> </td>
          <td> <a href="http://fact-project.org/smartfact/index.html?sound#dodriveunlock" target="_blank">unlock drive</a>></td>
        </tr>

        <tr>
          <td> Start Data Taking </td>
          <td> <?php echo dim_server_status(); ?> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="has_started_data_taking"> </td>
          <td> <a href="http://fact-project.org/smartfact/index.html?sound#control-main" target="_blank">Start Data Taking</a>></td>
        </tr>

        <tr>
          <td> Enter a summary about the startup into the logbook entry </td>
          <td> </td>
          <td> <input type="checkbox" name="ticked_checks[]" value="has_made_startup_summary"> </td>
          <td> </td>
        </tr>

      </table>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
