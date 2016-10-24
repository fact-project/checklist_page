<!DOCTYPE HTML>
<html>
<?php require("head.html") ?>

<body>

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
    db_create_table(); // creates the table if it does not exist;

    if (!is_email_good()) {
        echo "<br> One of the above is wrong or you have entered the ";
        echo "wrong username/password\r\n";
        echo "Click <a href='index.html'>here</a> ";
        echo "to go back.\r\n";
        exit("");
    }
    
    db_user_filled_checklist($_POST['Obsname']);

    $message = compose_email_message();
    echo "<br>";
    echo nl2br($message);
    echo "<br>";

    $message2 = "You are today FACT backup!.\n ";
    $message2 .= "PLEASE in good time check the information ";
    $message2 .= "below is correct: \n\n";
    $message2 .= $message;

    $from = $_POST['Obsmail'];

    if (isset($from)) {
	if (!is_email_address_2($from)) {
	    echo "Invalid input";
	} else {
	    $subject = "FACT Shutdown ". date("Y-m-d");
/*
	    mail(
		"fact-online@lists.phys.ethz.ch",
		$subject,
		wordwrap($message, 70),
		"From: $from\n"
	    );
*/
	    mail(
		$_POST["Email"],
		$subject,
		wordwrap($message2, 70),
		"From: $from\n"
	    );
	    echo "<br>";
	    echo "Thank you";
	    echo "<br>";
	}
    } else {
	echo "<br>";
	echo "Mail not sent!!";
	echo "<br>";
    }
?>

</body>
</html>
</body>
</html>
