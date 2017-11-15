<?php

function drive_status() { return get_status(5); };
function bias_status() { return get_status(9); };
function trigger_status() { return get_status(8); };
function lid_status() { return get_status(20); };
function drive_power() { return get_status(19); };
function dim_server_status() { return get_status(2); };

function get_status($position){
    $file = fopen("/home/fact/FACT++/www/smartfact/data/status.data", "r") or exit("Unable to open file!");
    for ($x=0; $x<=$position; $x++) {
        $temp=fgets($file);
    }
    fclose($file);
    return explode("\t", $temp)[1];
};

?>
