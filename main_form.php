<form method="post" action=""  enctype="multipart/form-data" >
    <p>
        <h1>!Caution! <br> This will switch on the IR Leds</h1>
    </p>
    <input type="radio" name="startup_or_shutdown" value="startup" checked> Startup<br>
    <input type="radio" name="startup_or_shutdown" value="shutdown"> Shutdown<br>
   <p>
      User Name:    <input type='text' name='Uname' maxlength="50" /> <br>
      Password:     <input type='password' name='Passwd' maxlength="50" /> <br>
   </p>
   <input type='submit' name='formpSubmit' value='Submit' />
</form>
