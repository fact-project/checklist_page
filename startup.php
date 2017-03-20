<!DOCTYPE HTML>
<html>
<?php require("head.html") ?>

<body>
<h1>FACT Startup Checklist</h1>
Images not updated? Try refreshing the page a couple of times?<br>

<?php
    require_once("login.php");
    if (!(login() == "")) {
        exit("username or password not found.");
    }

    $image_path = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/";
    if( !is_dir($image_path) ) {
        mkdir($image_path, 0777, true);
    }
    require_once("tools.php");
    require_once("compose_email_message.php");
    require_once("getEmail.php");
    require_once("db.php");
    db_create_startup_table(); // creates the table if it does not exist;

    load_lidcam_image();
    load_IR_image();
    require("startup_form.php");
?>
</body>
</html>
</body>
</html>
