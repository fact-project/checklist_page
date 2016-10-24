<?php
    require_once("tools.php")
    require_once("config.php");
    require_once("getEmail.php");
    require_once("login.php");

    $image_path = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/";
    if( !is_dir($image_path) ) {
        mkdir($image_path, 0777, true);
    }
?>

<!DOCTYPE HTML>
<html>
<?php require("head.html") ?>
<body>

<h1>FACT Shutdown Checklist</h1>

Images not updated? Try refreshing the page a couple of times?<br>

<?php
    if ( login() == "" && !isset($_POST["formSubmit"])) {
        load_lidcam_image();
        load_IR_image();
        require("form.php");
    } else {
        $errorFlag = false;

        if( empty($_POST["affirmation"]) ) {
            echo "You must agree to the above statement!<br>";
            $errorFlag = true;
        }

        if( empty($_POST["Email"]) ) {
            echo "Checker emailing required!<br>";
            $errorFlag = true;
        }

        if ( !is_email_address($_POST["Email"]) ) {
            echo "Invalid email format!<br>";
            $errorFlag = true;
        }

        if ( $_POST["Email"] == "fact-online@lists.phys.ethz.ch" ) {
            echo "Do not use fact-online as the backup.<br>";
            $errorFlag = true;
        }

        if ($errorFlag) {
            echo "<br> One of the above is wrong or you have entered the wrong username/password\r\n";
            echo "Click <a href='http://fact-project.org/Checklist/'>here</a> to go back.\r\n";
            exit("");
        } else {

            $message = compose_email_message();
            echo "<br>";
            echo nl2br($message);
            echo "<br>";

            $message2 = "You are today FACT backup!.\n PLEASE in good time check the information below is correct: \n\n ${message}";

            $from = $_POST['Obsmail'];

            if (isset($from)) {
                if (!is_email_address_2($from)) {
                    echo "Invalid input";
                } else {
                    $subject = "FACT Shutdown ". date("Y-m-d");
                    mail(
                        "fact-online@lists.phys.ethz.ch",
                        $subject,
                        wordwrap($message, 70),
                        "From: $from\n"
                    );
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
        }
    }
?>
</body>
</html>
