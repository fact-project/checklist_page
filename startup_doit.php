<!DOCTYPE HTML>
<html>
<?php require("head.html") ?>

<body>

<?php
    require_once("login.php");
    if (!(login() == "")) {
        exit("username or password not found.");
    }
    require_once("tools.php");
    require_once("db.php");
    db_create_startup_table(); // creates the table if it does not exist;
    db_user_filled_startup_checklist($_POST['Obsname']);
?>

</body>
</html>
</body>
</html>
