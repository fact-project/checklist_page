<img src="/cam/cam.php?t=<?php echo time() ?>"  width="320" alt="cam picture" />
<img src="/cam/lidcam.php?t=<?php echo time() ?>" width="320" alt="lid picture" />
<img src="http://fact-project.org/tpoint_cam/_now.png.png" width="320" alt="tpoint_cam" />


<form method="post" action="doit.php"  enctype="multipart/form-data" >
      <input type='hidden' name='Uname' value="<?php echo $_POST['Uname']; ?>" />
      <input type='hidden' name='Passwd' value="<?php echo $_POST['Passwd']; ?>" />
      <input type='hidden' name='startup_or_shutdown' value="<?php echo $_POST['startup_or_shutdown']; ?>">

      <table class="w3-table-all">

        <tr>
          <td>
            Telescope Parked? --- drive status: <?php echo drive_status(); ?>
            <button onclick="document.getElementById('parked_help').style.display='block'" class="w3-button" type="button">
            ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="parked"></td>
        </tr>
        <tr>
          <td>
              Drive Locked? --- drive status: <?php echo drive_status(); ?>
            <button onclick="document.getElementById('is_locked_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="is_locked"></td>
        </tr>
        <tr>
          <td>
              Bias VoltageOff --- median voltage: <?php echo median_voltage(); ?> V
            <button onclick="document.getElementById('is_bias_VoltageOff_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="is_bias_VoltageOff"></td>
        </tr>
        <tr>
          <td>
              Bias Disconnected --- bias status: <?php echo bias_status(); ?>
            <button onclick="document.getElementById('bias_off_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="bias_off"></td>
        </tr>
        <tr>
          <td>
              Trigger Valid --- trigger status: <?php echo trigger_status(); ?>
            <button onclick="document.getElementById('trigger_off_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="trigger_off"></td>
        </tr>
        <tr>
          <td>
              Camera Lid Closed --- lid status: <?php echo lid_status(); ?>
            <button onclick="document.getElementById('lid_closed_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="lid_closed"></td>
        </tr>
        <tr>
          <td>
              Drive Off? --- drive power: <?php echo drive_power(); ?>
            <button onclick="document.getElementById('drive_off_help').style.display='block'" class="w3-button" type="button">
          ???</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="drive_off"></td>
        </tr>
        <tr>
          <td>
              Is TPoint Camera Off?
            <button onclick="document.getElementById('tpoint_off_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="tpoint_off"></td>
        </tr>
        <tr>
          <td>
              Main.js Off?
            <button onclick="document.getElementById('mainjs_off_help').style.display='block'" class="w3-button" type="button">
          ?help?</button></td>
          <td><input type="checkbox" name="ticked_checks[]" value="mainjs_off"></td>
        </tr>

      </table>

   <button type='submit' name='formSubmit' class="w3-btn w3-block w3-teal">Submit</button>
</form>

<!-- Help pages -->

<div id="parked_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('parked_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>

      If the telescope is not parked, it could be the drive was already powered off.<br>
      So in order to park it, follow this procedure:<br>
            <ul>
              <li> Switch Drive On again </li>
              <li> <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">The "park telescope" button</a> </li>
              <li> Switch Drive Off again </li>
              <li> see also <a href="https://trac.fact-project.org/wiki/TroubleShootingDrivectrl%20">
                    Trouble Shooting Drive </a> </li>
            </ul>
      <br>
      If it does not work: Call a FACT expert.<br>
      If the sun might soon shine into the reflector --> Call MAGIC shift leader!
    </div>
  </div>
</div>


<div id="is_locked_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('is_locked_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      If the drive is not locked, it could be the drive was already powered off.<br>
      So in order to lock it, follow this procedure:<br>
            <ul>
              <li> Switch Drive On again </li>
              <li> <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">The "park telescope" button</a> </li>
              <li> Switch Drive Off again </li>
              <li> see also <a href="https://trac.fact-project.org/wiki/TroubleShootingDrivectrl%20">
                    Trouble Shooting Drive </a> </li>
            </ul>
      <br>
      If it does not work: Call a FACT expert.<br>
    </div>
  </div>
</div>


<div id="is_bias_VoltageOff_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('is_bias_VoltageOff_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        If the bias voltage is not switched off, <br>
        but the lid is closed, there is not much danger.
        <br>
        Chances are that in such a case main.js was not able to finish the entire
        shutdown procedure, so restarting main.js to repeat the shutdown, might be a good idea.
        <br>
        If it is only the bias voltage which is not off, you can switch it off
        via the ssh-dim-console. Ask an expert for help.
    </div>
  </div>
</div>


<div id="bias_off_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('bias_off_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        If the voltage is off, just biasctrl is still connected,
        there is no danger at all
        <br>
        Just write an email to the list, so an expert can have a look.
    </div>
  </div>
</div>


<div id="trigger_off_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('trigger_off_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        If the shutdown was done correctly, but the trigger is still on,
        there is no danger at all.
        <br>
        Just write an email to the list, so an expert can have a look.
    </div>
  </div>
</div>


<div id="lid_closed_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('lid_closed_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        You can try to close the Lid again manually on this
        <a href="http://fact-project.org/smartfact/index.html?sound#control-lid">smartfact</a>
        page. <br>

        If it does not work and it is stormy
        call expert (something might damage window); else just an email to fact-online.
    </div>
  </div>
</div>

<div id="drive_off_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('drive_off_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        If the telescope is nicely parked, but the drive is still on, you can
        manually switch it off, via the "Toggle Drive" button on: <br>
        <a href="http://fact-project.org/smartfact/index.html?sound#control-drive">smartfact</a>
        <br>
        Wait a bit after you pressed that button and check the status of the drive
        on the smartfact status page.
        <br>
        If you cannot switch the drive off, call an expert.
    </div>
  </div>
</div>

<div id="tpoint_off_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('tpoint_off_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        The T-point cam is off, when its image above is all grey.
        If is not off, you can switch if off via this <br>
        <a href="http://10.0.100.230/ov.html">Gude Power Switch 10.0.100.230</a>
        <br>
        You need to be connected via VPN to the internal network.

        If you cannot switch it off, Call Daniela.
    </div>
  </div>
</div>

<div id="mainjs_off_help" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('mainjs_off_help').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
        To switch main.js off, go to
        <br>
        <a href="http://fact-project.org/smartfact/index.html?sound#fact">smartfact</a>
        <br>
        and click the little-X in the lower right
    </div>
  </div>
</div>
