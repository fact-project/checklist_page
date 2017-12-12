<!DOCTYPE HTML>
<html>
<?php require("head.html") ?>

<body>
<h1>FACT Shutdown Checklist</h1>
Images not updated? Try refreshing the page a couple of times?<br>

<?php
    require_once("login.php");
    if (!(login() == "")) {
        exit("username or password not found.");
    }

    require_once("tools.php");
    require_once("compose_email_message.php");
    require_once("getEmail.php");
    require_once("db.php");
    ir_cam_leds_on();
    db_create_table(); // creates the table if it does not exist;

    load_lidcam_image();
    load_IR_image();
    require("form.php");
?>
</body>
</html>
</body>
</html>
