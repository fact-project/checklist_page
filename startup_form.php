<img src="../cam/ircam_with_date.jpg" width="320" alt="cam picture" />
<img src="../cam/lidcam_with_date.jpg" width="320" alt="lid picture" />

<form method="post" action="doit.php"  enctype="multipart/form-data" >
      <input type='hidden' name='Uname' value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Passwd' value="<?php echo $_POST['Passwd']; ?>" />
      <input type='hidden' name='startup_or_shutdown' value="<?php echo $_POST['startup_or_shutdown']; ?>">

      <table class="w3-table-all">
        <tr>
          <td>
            Read the news
            <button onclick="document.getElementById('read_email_help').style.display='block'"
              class="w3-button" type="button">
              &#x1F6C8;
            </button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="all_emails_read"></td>
        </tr>

        <tr>
          <td>
            Check Site free <button onclick="document.getElementById('check_site_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="parked"></td>
        </tr>

        <tr>
          <td>
              Mirrors fine?
            <button onclick="document.getElementById('mirrors_good_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="mirrors_good"></td>
        </tr>

        <tr>
          <td>
              Check camera Lid: <?php echo lid_status(); ?>
            <button onclick="document.getElementById('lid_closed_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="lid_closed"></td>
        </tr>

        <tr>
          <td>
              Check ORM alerts
            <button onclick="document.getElementById('orm_alerts_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="orm_alerts"></td>
        </tr>

        <tr>
          <td>
            Check SH Dummy Alert
            <button onclick="document.getElementById('dummy_alert_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="dummy_alert"></td>
        </tr>

        <tr>
          <td>
            Check Observation Schedule
            <button onclick="document.getElementById('schedule_filled_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="schedule_filled"></td>
        </tr>

        <tr>
          <td>
            Check FACT++ programs
            <button onclick="document.getElementById('servers_online_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="servers_online"></td>
        </tr>

        <tr>
          <td>
            Make a logbook entry for the night.
            <button onclick="document.getElementById('has_prepared_logbook_entry_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="has_prepared_logbook_entry"></td>
        </tr>

        <tr>
          <td>
              Switch on and unlock the drive
            <button onclick="document.getElementById('has_drive_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="has_drive"></td>
        </tr>

        <tr>
          <td>
            Start Data Taking: <?php echo dim_server_status(); ?>
            <button onclick="document.getElementById('has_started_data_taking_help').style.display='block'"
              class="w3-button" type="button">&#x1F6C8;</button>
          </td>
          <td><input type="checkbox" name="ticked_checks[]" value="has_started_data_taking"></td>
        </tr>

      </table>

  <button type='submit' name='formSubmit' class="w3-btn w3-block w3-teal">Submit</button>
</form>

<!-- Help pages -->

<div id="read_email_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('read_email_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      Read the emails of the last 2 days that came over `fact-online@lists.phys.ethz.ch`
      <br>
      and read the read the
      <a href="https://www.fact-project.org/logbook/forumdisplay.php?fid=5" target="_blank">
              shift forum
      </a>.
    </div>
  </div>
</div>

<div id="check_site_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('check_site_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      No people inside fence? <br/>
      If FACT/MAGIC members, try to contact them. If tourists, call MAGIC shiftleader.
    </div>
  </div>
</div>

<div id="mirrors_good_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('mirrors_good_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Mirrors fallen off or loose? <br>
            Ice on structure? <br>
            ask MAGIC to have a look; if MAGICs can clear the situation: observe; else: don't observe.
    </div>
  </div>
</div>


<div id="orm_alerts_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('orm_alerts_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Read the ORM weather alerts on <br>
            <a href="http://www.iac.es/eno.php?op1=2&op2=5&op3=58&lang=en" target="_blank">
              ORM status report
            </a>
            <br>
            QUESTION: Under what conditions should shifters not even start???
    </div>
  </div>
</div>

<div id="dummy_alert_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('dummy_alert_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Go to
            <a target="_blank" href="https://shifthelper.app.tu-dortmund.de">shifthelper webinterface</a>
            and press "Dummy Alert" button <br>
            If it does not work: Call SH developers: <br>
            mnoethe or dneise.
    </div>
  </div>
</div>

<div id="schedule_filled_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('schedule_filled_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Check the
            <a target="_blank" href="https://www.fact-project.org/schedule/">Observation Scheduler</a> <br>
            If not filled, fill it. <br>
            <br>
            Are there Swift observations? Check the
            <a target="_blank" href="http://fact-project.org/dch/scheduling.php">scheduling.php</a> <br>

            If there are Swift Observations: Fill them into schedule.
            <br>
            If in doubt, ask Daniela Dorner how to do it.
            <br>
            QUESTION: If we want to fill swift observations always into our schedule, why
            don't we do it automatically???
    </div>
  </div>
</div>


<div id="servers_online_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('servers_online_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Look at the
            <a target="_blank" href="https://fact-project.org/smartfact/index.html?#status">smartfact</a>
            website<br>
            Make sure all servers green or yellow on the status page. <br>
            Are there at least 1.5TB diskspace? (last two rows)
            If not, Call expert.
    </div>
  </div>
</div>

<div id="has_prepared_logbook_entry_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('has_prepared_logbook_entry_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            Go to our logbook and <br>
            <a href="https://www.fact-project.org/logbook/calendar.php?action=addevent&calendar=1" target="_blank">
              make a new entry for tonight
            </a>

    </div>
  </div>
</div>



<div id="has_drive_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('has_drive_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
            You can use these direct links: <br>
             <ul>
              <li>
                <a href="http://fact-project.org/smartfact/index.html?sound#dodrivetoggle" target="_blank">
                  toggle drive
                </a>
              </li>
              <li><a href="http://fact-project.org/smartfact/index.html?sound#dodriveunlock" target="_blank">
              unlock drive
              </a></li>
            </ul>
    </div>
  </div>
</div>



<div id="has_started_data_taking_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('has_started_data_taking_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        You can use this direct link to the smartfact page: <br>
        <a href="http://fact-project.org/smartfact/index.html?sound#control-main" target="_blank">Start Data Taking</a>>
    </div>
  </div>
</div>







