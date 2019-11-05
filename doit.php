<!DOCTYPE HTML>
<html>
<body>
<?php
    require_once("login.php");
    require_once("tools.php");
    require_once("db.php");
    switch_ir_off();

    if (login() == "") {
        $action = "";
        if( isset($_POST['startup_or_shutdown']) )
        {
            $action = $_POST['startup_or_shutdown'];
        }

        switch ($action) {
        case "startup":
            db_create_startup_table_if_not_exists();
            db_user_filled_startup_checklist($_POST['Uname']);
            break;
        case "shutdown":
            db_create_shutdown_table_if_not_exists();
            db_user_filled_checklist($_POST['Uname']);
            break;
        default:
            echo "This cannot happen ?!";
        }
    }
    header("refresh:5;url=index.php");
    echo "<h1>IR Leds have been switched off</h1><br>";
    echo "Thanks. you are done ... redirect back to start";
?>
</body>
</html>
</body>
</html>
