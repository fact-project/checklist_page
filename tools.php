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

function is_email_address_2($supposed_email_address) {
    // Sanitize e-mail address
    $supposed_email_address=filter_var($supposed_email_address, FILTER_SANITIZE_EMAIL);
    // Validate e-mail address
    if(filter_var($supposed_email_address, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}


function is_email_address($email){
    if ( preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email) ){
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
    curl_exec($ch);
    curl_close($ch);
};


?>