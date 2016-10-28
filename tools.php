<?php

// This looks like a homebrewd
// safety system ... not good at all
// I have no idea what it is supposed to do.
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/*
See the php manual for the filter_var functions. They are pretty nice.
http://php.net/manual/de/book.filter.php

And some examples
http://php.net/manual/de/filter.examples.validation.php

*/
function sanitize_email_address($supposed_email_address) {
    return filter_var($supposed_email_address, FILTER_SANITIZE_EMAIL);
}


function is_valid_email_address($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
};




function submitter(){
    return $_POST["Uname"] . ": IP: " . $_SERVER['REMOTE_ADDR'] . " Time: " . date("Y-m-d H:i:s") . "<br>";
};

function load_lidcam_image(){
    load_cam_image("http://www.fact-project.org/cam/lidcam.php");
    $backup_path = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/FocalPlane_".date("Y-m-d_H:i:s").".jpg";
    copy("../cam/lidcam2.jpg", $backup_path);
};

function load_IR_image(){
    load_cam_image("http://www.fact-project.org/cam/cam.php");
    $backup_path = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/IRcam_".date("Y-m-d_H:i:s").".jpg";
    copy("../cam/snap2.jpg", $backup_path);
};

function load_cam_image($url){
    // load an image of a webcam using curl apparently.
    // I have no idea where it is stored.
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
};

function is_email_good(){
    $errorFlag = true;

    if( empty($_POST["Email"]) ) {
        echo "Checker emailing required!<br>";
        $errorFlag = false;
    }

    if ( !is_valid_email_address($_POST["Email"]) ) {
        echo "Invalid email format!<br>";
        $errorFlag = false;
    }

    if ( $_POST["Email"] == "fact-online@lists.phys.ethz.ch" ) {
        echo "Do not use fact-online as the backup.<br>";
        $errorFlag = false;
    }

    return $errorFlag;
};

?>
