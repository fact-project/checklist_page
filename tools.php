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

function median_voltage(){
    $file = fopen("/home/fact/FACT++/www/smartfact/data/voltage.data", "r") or exit("Unable to open file!");
    for ($x=0; $x<=2; $x++) {
        $temp=fgets($file);
    }
    fclose($file);
    return explode("\t", $temp)[1];
};

function load_lidcam_image(){
    load_cam_image("http://www.fact-project.org/cam/lidcam.php");
    // --> writes the file to "../cam/lidcam_with_date.jpg"
};

function load_IR_image(){
    load_cam_image("http://www.fact-project.org/cam/cam.php");
    // --> writes the file to "../cam/ircam_with_date.jpg"
};

function load_cam_image($url){
    // load an image of a webcam using curl apparently.
    // I have no idea where it is stored.
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
};

function ir_cam_send_data($url, $data = null, $method = "get") {
  if (!empty($url)) {
    $con = curl_init($url);
    switch ($method) {
      case "post":
        $curl_options = array(
          CURLOPT_HEADER => 1,
          CURLOPT_REFERER => 'http://cam/index.htm',
          CURLOPT_BINARYTRANSFER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_COOKIESESSION => true,
          CURLOPT_AUTOREFERER => true,
          CURLOPT_COOKIE => 'LifeTime=; ReloWebTime=0; SSID=YWRtaW46MTQ0MEdhcGQ=;',
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $data,
        );
      break;
      case "get":
        $curl_options = array(
          CURLOPT_HEADER => 0,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_COOKIESESSION => true,
          CURLOPT_COOKIEFILE => "cookiefile",
          CURLOPT_COOKIEJAR => "cookiefile",
          CURLOPT_AUTOREFERER => true,
          CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64; rv:17.0) Gecko/20100101 Firefox/17.0 Iceweasel/17.0.1',
          CURLOPT_COOKIE => 'LifeTime=525551; ReloWebTime=0; SSID=YWRtaW46MTQ0MEdhcGQ=; pbAudioFalg=ON; captcha=8CF4910685483D4E888C; x=1;',
        );
      break;
    }
    if (!curl_setopt_array($con, $curl_options)) die ("FOOOO!!!\n");
    $result = curl_exec($con);
    if (curl_errno($con)) {
      $msg = "Connection failed!\n";
      return $msg;
    }
    curl_close($con);
  }
  else {
    return false;
  }
}

function ir_cam_leds_on(){
    $url = "http://cam/cgi-bin/user/Config.cgi";
    $connection = array (
      'user' => "admin",
      'pass' => "1440Gapd",
      'rand' => rand(0,10000)/10000,
    );

    $data = array(
      'action' => 'set',
      'Camera.System.Title' => 'Camera1',
      'Camera.General.IRControl.Value' => 0,
      'Camera.System.Display' => 'ALL',
      'Camera.Environment' => 'OUTDOOR'
    );
    $query = http_build_query($data);
    $foo = ir_cam_send_data($url, $query, "post");
}

function ir_cam_leds_off(){
    $url = "http://cam/cgi-bin/user/Config.cgi";
    $connection = array (
      'user' => "admin",
      'pass' => "1440Gapd",
      'rand' => rand(0,10000)/10000,
    );

    $data = array(
      'action' => 'set',
      'Camera.System.Title' => 'Camera1',
      'Camera.General.IRControl.Value' => 2,
      'Camera.System.Display' => 'ALL',
      'Camera.Environment' => 'OUTDOOR'
    );

    $query = http_build_query($data);
    $foo = ir_cam_send_data($url, $query, "post");
}
