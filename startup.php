<!DOCTYPE HTML>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<title>Startup Checklist</title>

<body>
<div class="w3-container">

<h2>Accordions</h2>
<p>An accordion is used to show (and hide) HTML content:</p>

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
    db_create_startup_table_if_not_exists();

    load_lidcam_image();
    load_IR_image();
    require("startup_form.php");
?>
</body>
</html>

</div>

<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>






