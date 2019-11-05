<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<h1>FACT Checklists</h1>
<?php
    require_once("login.php");
    require_once("/home/factwww/sandbox/mnoethe/shift/ircam.php");
    require_once("/home/factwww/sandbox/mnoethe/shift/tools.php");
    require_once("db.php");

    if (login() == "") {
        $action = "";
        if( isset($_POST['startup_or_shutdown']) )
        {
            $action = $_POST['startup_or_shutdown'];
        }
        switch_ir_on();

        switch ($action) {
        case "startup":
            require("startup_form.php");
            break;
        case "shutdown":
            require("shutdown_form.php");
            break;
        }
    } else {
        require("main_form.php");
    }
?>
</body>
</html>




