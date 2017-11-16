<?php require_once("get_status_functions.php"); ?>

<img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" />
<img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />


<form method="post" action="startup_doit.php"  enctype="multipart/form-data" >
      <input type='hidden' name='Obsname' maxlength="50" value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Obsmail' maxlength="50" value="<?php echo getEmail(); ?>" />
      <input type='hidden' name='Uname' maxlength="50" value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Passwd' maxlength="50" value="<?php echo $_POST['Passwd']; ?>" />

      <div class="w3-row-padding">

        <div class="w3-third">
          <button onclick="myFunction('check_mail_info')" class="w3-btn w3-block w3-black w3-left-align">
            Read the emails
          </button>
          <div id="check_mail_info" class="w3-container w3-hide">
            Read the emails of the last 2 days that came over `fact-online@lists.phys.ethz.ch`
            <input type="checkbox" name="ticked_checks[]" value="all_emails_read">
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('check_site')" class="w3-btn w3-block w3-black w3-left-align">
            Check Site
          </button>
          <div id="check_site" class="w3-container w3-hide">
            No people inside fence?
            If FACT/MAGIC members, try to contact them. If tourists, call MAGIC shiftleader.
            <input type="checkbox" name="ticked_checks[]" value="parked">
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('check_mirrors')" class="w3-btn w3-block w3-black w3-left-align">
            Check Site
          </button>
          <div id="check_mirrors" class="w3-container w3-hide">
            Mirrors fallen off or loose? <br>
            Ice on structure? <br>
            ask MAGIC to have a look; if MAGICs can clear the situation: observe; else: don't observe.
            <input type="checkbox" name="ticked_checks[]" value="mirrors_good">
          </div>
        </div>

      </div>


      <div class="w3-row-padding">

        <div class="w3-third">
          <button onclick="myFunction('check_lid')" class="w3-btn w3-block w3-black w3-left-align">
            Check camera Lid: <?php echo lid_status(); ?>
          </button>
          <div id="check_lid" class="w3-container w3-hide">
            <input type="checkbox" name="ticked_checks[]" value="lid_closed">
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('check_orm_alerts_info')" class="w3-btn w3-block w3-black w3-left-align">
            Check ORM alerts
          </button>
          <div id="check_orm_alerts_info" class="w3-container w3-hide">
            <a href="http://www.iac.es/eno.php?op1=2&op2=5&op3=58&lang=en" target="_blank">
              ORM status report
            </a>
            <input type="checkbox" name="ticked_checks[]" value="orm_alerts">
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('check_dummy_alert_info')" class="w3-btn w3-block w3-black w3-left-align">
            Check SH Dummy Alert
          </button>
          <div id="check_dummy_alert_info" class="w3-container w3-hide">
            <a target="_blank" href="https://shifthelper.app.tu-dortmund.de">shifthelper webinterface</a>
            <input type="checkbox" name="ticked_checks[]" value="dummy_alert">
            If it does not work: Call SH developers: mnoethe or dneise.
          </div>
        </div>

      </div>



      <div class="w3-row-padding">

        <div class="w3-third">
          <button onclick="myFunction('check_schedule_info')" class="w3-btn w3-block w3-black w3-left-align">
            Check Observation Schedule
          </button>
          <div id="check_schedule_info" class="w3-container w3-hide">
            <a target="_blank" href="https://www.fact-project.org/schedule/">Observation Scheduler</a>
            <input type="checkbox" name="ticked_checks[]" value="schedule_filled">
            If not filled, fill it. If in doubt, ask Daniela Dorner how to do it.
            <br>
            Are there Swift observations?
            <a target="_blank" href="http://fact-project.org/dch/scheduling.php">scheduling.php</a>
            Fill them in the schedule.
            <br>
            If in doubt, ask Daniela Dorner how to do it.
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('check_factpp_programs_info')" class="w3-btn w3-block w3-black w3-left-align">
            Check FACT++ programs
          </button>
          <div id="check_factpp_programs_info" class="w3-container w3-hide">
            (green or yellow on this page)?
            <a target="_blank" href="https://fact-project.org/smartfact/index.html?#status">smartfact</a>
            <br>
            Are there at least 1.5TB diskspace? (last two rows)
            <input type="checkbox" name="ticked_checks[]" value="servers_online">
            If not, Call expert.
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('make_log_entry_info')" class="w3-btn w3-block w3-black w3-left-align">
            Make a logbook entry for the night.
          </button>
          <div id="make_log_entry_info" class="w3-container w3-hide">
            <input type="checkbox" name="ticked_checks[]" value="has_prepared_logbook_entry">
            <a href="https://www.fact-project.org/logbook/calendar.php?action=addevent&calendar=1" target="_blank">
              make a new entry for tonight
            </a>
          </div>
        </div>

      </div>



      <div class="w3-row-padding">

        <div class="w3-third">
          <button onclick="myFunction('switch_on_drive_info')" class="w3-btn w3-block w3-black w3-left-align">
            Switch the drive on and Unlock the drive
          </button>
          <div id="switch_on_drive_info" class="w3-container w3-hide">
            <input type="checkbox" name="ticked_checks[]" value="has_drive_switched_on">
            <input type="checkbox" name="ticked_checks[]" value="has_drive_unlocked">
            <a href="http://fact-project.org/smartfact/index.html?sound#dodrivetoggle" target="_blank">
              toggle drive
            </a>
            <?php echo drive_status(); ?>
            <a href="http://fact-project.org/smartfact/index.html?sound#dodriveunlock" target="_blank">
              unlock drive
            </a>
          </div>
        </div>

        <div class="w3-third">
          <button onclick="myFunction('star_info')" class="w3-btn w3-block w3-black w3-left-align">
            Start Data Taking
          </button>
          <div id="star_info" class="w3-container w3-hide">
            <?php echo dim_server_status(); ?>
            <a href="http://fact-project.org/smartfact/index.html?sound#control-main" target="_blank">Start Data Taking</a>>
            <input type="checkbox" name="ticked_checks[]" value="has_started_data_taking">
          </div>
        </div>

      </div>

   <h3> Submission: </h3> <?php echo submitter(); ?>
   <input type='submit' name='formSubmit' value='Submit' />
</form>
