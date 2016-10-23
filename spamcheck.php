<?php

function spamcheck($field) {
    // Sanitize e-mail address
    $field=filter_var($field, FILTER_SANITIZE_EMAIL);
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>