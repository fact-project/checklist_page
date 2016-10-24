<?php

function is_ticked($name){
    // This function returns the strings "True" or "False" 
    // depending on whether the user 'ticked' the checkboxes.
    // for details about $_POST["ticked_checks"], c.f. form.php
    if ( in_array($name, $_POST["ticked_checks"])){
        return "True";
    } else {
        return "False";
    }
};

function compose_email_message() {
    $message = $_POST['Obsname'] . "has completed a shutdown form:\n\n";
    $message .= "Telescope Parked:\t\t" . is_ticked("parked") . "\n";
    $message .= "Bias Disconnected:\t\t" . is_ticked("bias_off") . "\n";
    $message .= "Lid Closed:\t\t\t" . is_ticked("lid_closed") . "\n";
    $message .= "TPoint Camera Off:\t" . is_ticked("tpoint_off") . "\n";
    $message .= "Drive Off:\t\t\t" . is_ticked("drive_off") . "\n";

    $image_base_path = "http://fact-project.org/Checklist/images/".date("Y")."/".date("m");
    $file1name = $image_base_path . "/IRcam_".date("Y-m-d_H:i:s").".jpg";
    $file2name = $image_base_path . "/FocalPlane_".date("Y-m-d_H:i:s").".jpg";
    $message .= "The focal plane image available at:\n $file2name\n";
    $message .= "The IR Cam image available at:\n $file1name\n\n";
    $message .= "They affirm to the information.\n";

    return $message;
};
?>
