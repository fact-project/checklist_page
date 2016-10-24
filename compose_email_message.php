<?php

// for details about $_POST["ticked_checks"], c.f. form.php

function compose_email_message() {
    $file1name = "http://fact-project.org/Checklist/images/".date("Y")."/".date("m")."/IRcam_".date("Y-m-d_H:i:s").".jpg";
    $file2name = "http://fact-project.org/Checklist/images/".date("Y")."/".date("m")."/FocalPlane_".date("Y-m-d_H:i:s").".jpg";

    $message = $_POST['Obsname'] . "has completed a shutdown form:\n\n";

    $message = $message . "Telescope Parked:\t\t" . in_array("parked", $_POST["ticked_checks"]) . "\n";
    $message = $message . "Bias Disconnected:\t\t" . in_array("bias_off", $_POST["ticked_checks"]) . "\n";
    $message = $message . "Lid Closed:\t\t\t" . in_array("lid_closed", $_POST["ticked_checks"]) . "\n";
    $message = $message . "TPoint Camera Off:\t" . in_array("tpoint_off", $_POST["ticked_checks"]) . "\n";
    $message = $message . "Drive Off:\t\t\t" . in_array("drive_off", $_POST["ticked_checks"]) . "\n";
    $message = $message . "The focal plane image available at:\n $file2name\n";
    $message = $message . "The IR Cam image available at:\n $file1name\n\n";
    $message = $message . "They affirm to the information.\n";

    return $message;
};
?>