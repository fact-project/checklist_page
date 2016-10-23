<!DOCTYPE HTML> 

<html>
<head>
  <link rel="stylesheet" type="text/css" href="checkstyle.css" />
<style>
.error {color: #FF0000;}
</style>

<script language="JavaScript" type="text/javascript">
if (document.getElementById) {
document.writeln('<style type="text/css"><!--')
document.writeln('.texter {display:none} @media print {.texter {display:block;}}')
document.writeln('//--></style>') }
function openClose(theID) {
if (document.getElementById(theID).style.display == "block") { document.getElementById(theID).style.display = "none" }
else { document.getElementById(theID).style.display = "block" } }
</script>

</head>
<body> 

<?php

require_once("config.php");

function getEmail()
{
    global $ldaphost;
    global $baseDN;
    global $groupDN;

    $username = "";

    if( isset($_POST['Uname']) )
    {
      $username = $_POST['Uname'];
    }
    if( isset($_POST['Passwd']) )
    {
      $password = $_POST['Passwd'];
    }

    $con = @ldap_connect($ldaphost);
    if (!$con)
        return "ldap_connect failed to ".$ldaphost;

    //------------------ Look for user common name
    $attributes = array('cn', 'mail');
    $dn         = 'ou=People,'.$baseDN;
    $filter     = '(uid='.$username.')';

    $sr = @ldap_search($con, $dn, $filter, $attributes);
    if (!$sr)
        return "ldap_search failed for dn=".$dn.": ".ldap_error($con);

    $srData = @ldap_get_entries($con, $sr);
    if ($srData["count"]==0)
        return "No results returned by ldap_get_entries for dn=".$dn.".";

    $email = $srData[0]['mail'][0];
   
    return $email;

}

function login()
{
    global $ldaphost;
    global $baseDN;
    global $groupDN;

    $username = "";

    if( isset($_POST['Uname']) )
    {
      $username = $_POST['Uname'];
    }
    if( isset($_POST['Passwd']) )
    {
      $password = $_POST['Passwd'];
    }

    $con = @ldap_connect($ldaphost);
    if (!$con)
        return "ldap_connect failed to ".$ldaphost;

    //------------------ Look for user common name
    $attributes = array('cn', 'mail');
    $dn         = 'ou=People,'.$baseDN;
    $filter     = '(uid='.$username.')';

    $sr = @ldap_search($con, $dn, $filter, $attributes);
    if (!$sr)
        return "ldap_search failed for dn=".$dn.": ".ldap_error($con);

    $srData = @ldap_get_entries($con, $sr);
    if ($srData["count"]==0)
        return "No results returned by ldap_get_entries for dn=".$dn.".";

    $email         =$srData[0]['mail'][0];
    $userCommonName=$srData[0]['cn'][0];
    $userDN        =$srData[0]['dn'];

    //------------------ Authenticate user
    if (!@ldap_bind($con, $userDN, $password))
        return "ldap_bind failed: ".ldap_error($con);

    //------------------ Check if the user is in FACT ldap group
    $attributes= array("member");
    $filter= '(objectClass=*)';

    // Get all members of the group.
    $sr = @ldap_read($con, $groupDN, $filter, $attributes);
    if (!$sr)
        return "ldap_read failed for dn=".$groupDN.": ".ldap_error($con);

    // retrieve the corresponding data
    $srData = @ldap_get_entries($con, $sr);
    if ($srData["count"]==0)
        return "No results returned by ldap_get_entries for dn=".$dn.".";

    @ldap_unbind($con);

    $found = false;
    foreach ($srData[0]['member'] as $member)
        if (strpos($member, "cn=".$userCommonName.",")===0)
            return "";

    return "Sorry, your credentials don't match!";
}

?>

<?php
function spamcheck($field)
  {
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }
?>

<?php 
$tel = "";
$bias = "";
$lid = "";
$aff = "";
$emailc = "";

$telErr = "";
$biasErr = "";
$lidErr = "";
$affErr = "";
$emailErr = "";

if(empty($_POST["affirmation"]))
{ $affErr = "You must agree to the above statement"; }
else
{ $aff = test_input($_POST["affirmation"]);}

if(empty($_POST["Email"]))
{ $emailErr = "Checker emailing required"; }
else
{ $emailc = test_input($_POST["Email"]);}
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$emailc))
{
  $emailErr = "Invalid email format"; 
}
if ( $emailc == "fact-online@lists.phys.ethz.ch" )
{
  $emailErr = "\nDo not use fact-online as the backup.\n";
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>FACT Shutdown Checklist</h1>
<!--<p><span class="error">* required field.</span></p>-->
Images not updated? Try refreshing the page a couple of times?<br>
For the systems, the status is displayed like this: System [ExpectedStatus]: RealStatusFromSystem.
<hr/>
<?php
// display form if user has not clicked submit

    $rc = login();
    $gemail = getEmail();

if ( $rc == "" && !isset($_POST["formSubmit"]))
  {

//load lidcam image
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.fact-project.org/cam/lidcam.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
//load IR image
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.fact-project.org/cam/cam.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

?>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data" >

<!--<div>-->

   <!--<p>-->
      <input type='hidden' name='Obsname' maxlength="50" value="<?php echo $_POST['Uname'] ?>" /> <br>
      <input type='hidden' name='Obsmail' maxlength="50" value="<?php echo $gemail ?>" /> <br>
      <!--Observer Name:    <input type='hidden' name='Obsname' maxlength="50" value="<?php echo $_POST['Uname'] ?>" /> <br>-->
      <!--Observer Email:   <input type='hidden' name='Obsmail' maxlength="50" value="<?php echo $gemail ?>" /> <br>-->
      <!--Observation Date: <input type='text' name='Obsdate' maxlength="50" /> -->
   <!--</p>-->

<!--</div>-->

<div>

<div style="float: left; width: 50%">
   <b> 1. Is the Telescope Parked? </b>
</div>
<div style="float: left; width: 50%">
   <input type="checkbox" name="telparked" value="parked"> Yes <br> <br>
</div>

<p><img src="../cam/snap2.jpg" width="320" height="250" alt="cam picture" /></p>

   <!--<b> Pointing position: </b> -->
<?php
/*
$file = fopen("/home/fact/FACT++/www/smartfact/data/fact.data", "r") or exit("Unable to open file!");

  $temp=fgets($file);
  $temp=fgets($file);
  $bits = explode("\t",$temp);
  $pointing_az = $bits[1];
  $pointing_nsew = $bits[2];
  $temp=fgets($file);
  $bits = explode("\t",$temp);
  $pointing_el = $bits[1];

fclose($file);
echo "\t\t";
echo $pointing_nsew; echo "  ";
echo $pointing_az; echo " deg / ";
echo $pointing_el; echo "deg <br>";
*/
?>

  <b> Drive Status [Locked]: </b>

<?php
$file = fopen("/home/fact/FACT++/www/smartfact/data/status.data", "r") or exit("Unable to open file!");

  for ($x=0; $x<=5; $x++)
  {
    $temp=fgets($file);
  }

  $bits = explode("\t",$temp);
  $drivestatus = $bits[1];

fclose($file);
echo "\t\t";
echo $drivestatus;
echo "<br><br>";
?>


   <!--<label for="file"> Upload Telescope Image:</label>-->
   <!--<input type="file" name="file" id="file"><br>-->
   <!--(use IR camera if the Sun has not yet risen)<br><br>-->

   <!--<div onClick="openClose('a1')" style="cursor:hand; cursor:pointer"><b>More Info</b></div>-->
     <!--<div id="a1" class="texter">-->
     <!--<ul>-->
       <!--<li> Things to Think about 1 </li> -->
       <!--<li> Things to Think about 2 </li> -->
       <!--<li> Things to Think about 3 </li> -->
     <!--<ul>-->
   <!--</div>-->

</div>
<hr/>

<div>
<div style="float: left; width: 50%">
   <b> 2. Is the Bias Disconnected? </b><br>
<b>Bias Status [Disconnected]:</b>
<?php
$file = fopen("/home/fact/FACT++/www/smartfact/data/status.data", "r") or exit("Unable to open file!");

  for ($x=0; $x<=9; $x++)
  {
    $temp=fgets($file);
    if( $x == 8 ) $temp1 = $temp;
  }

  $bits = explode("\t",$temp);
  $bits1 = explode("\t",$temp1);
  $biasstatus = $bits[1];
  $triggerstatus = $bits1[1];

fclose($file);
echo "\t\t";
echo $biasstatus;
echo "<br>";
echo "<b>Trigger Status [Valid]:</b> ";
echo $triggerstatus;
echo "<br>";
?>
</div>
<div style="float: left; width: 50%">
   <input type="checkbox" name="biasoff" value="boff"> Yes <br> <br> <br> <br> <br>
</div>

   <!-- <div onClick="openClose('a2')" style="cursor:hand; cursor:pointer"><b>More Info</b></div> -->
     <!-- <div id="a2" class="texter"> -->
     <!-- <ul> -->
       <!-- <li> Things to Think about 1 </li>  -->
       <!-- <li> Things to Think about 2 </li>  -->
       <!-- <li> Things to Think about 3 </li>  -->
     <!-- <ul> -->
   <!-- </div> -->

</div>
<hr/>
<div>

<div style="float: left; width: 50%">
   <b> 3. Is the Camera Lid closed? </b> <br>
   <b> Lid Status [Closed]: </b>
<?php
$file = fopen("/home/fact/FACT++/www/smartfact/data/status.data", "r") or exit("Unable to open file!");

  for ($x=0; $x<=20; $x++)
  {
    $temp=fgets($file);
  }

  $bits = explode("\t",$temp);
  $lidstatus = $bits[1];

fclose($file);
echo "\t\t";
echo $lidstatus;

?>
</div>
<div style="float: left; width: 50%">
   <input type="checkbox" name="lidclosed" value="lclosed"> Yes <br> <br> <br>
</div>

<p><img src="../cam/lidcam2.jpg" width="320" height="250" alt="lid picture" /></p>

<div style="float: left; width: 50%">
<!--<p>-->
   <!--<label for="file2"> Upload Camera Image:</label> <br>-->
   <!--(use IR LEDs if Sun has not yet risen)<br>-->
   <!--Please NO spaces in filename!<br><br>-->
<!--</p>-->
</div>
<!--<div style="float: left; width: 50%">-->
<!--<p>-->
   <!--<input type="file" name="file2" id="file"> -->

</p>
</div>

   <!-- <div onClick="openClose('a3')" style="cursor:hand; cursor:pointer"><b>More Info</b></div> -->
     <!-- <div id="a3" class="texter"> -->
     <!-- <ul> -->
       <!-- <li> Things to Think about 1 </li>  -->
       <!-- <li> Things to Think about 2 </li>  -->
       <!-- <li> Things to Think about 3 </li>  -->
     <!-- <ul> -->
   <!-- </div> -->

</div>
<hr/>

<div>
<div style="float: left; width: 50%">
<p>
<b> 4. Drive </b> <br>
<?php
$file = fopen("/home/fact/FACT++/www/smartfact/data/status.data", "r") or exit("Unable to open file!");

  for ($x=0; $x<=19; $x++)
  {
    $temp=fgets($file);
  }

  $bits = explode("\t",$temp);
  $drivepowerstatus = $bits[1];

fclose($file);
echo "Drive Power [DriveOff]:";
echo "\t\t";
echo $drivepowerstatus;
echo "<br><br>";
?>

</p>
</div>
<div>
<div style="float: left; width: 50%">
<p>
<input type="checkbox" name="dotheroff" value="dooff"> Yes <br> <br> <br> <br>
</p>
</div>
<hr/>

<div>
<div style="float: left; width: 50%">
<p>
<b> 5. TPoint Camera </b> <br>
TPoint Camera Off?
</p>
</div>
<div>
<div style="float: left; width: 50%">
<p>
<input type="checkbox" name="totheroff" value="tooff"> Yes <br> <br> <br> <br>
</p>
</div>

<hr/>
<div>

   <h3> Submission: </h3>
<?php
echo $_POST["Uname"]; echo ": ";
echo "IP: "; echo $_SERVER['REMOTE_ADDR'];
echo " Time: ";
echo date("Y-m-d H:i:s");
echo "<br>";
?>

<div style="float: left; width: 50%; align: right">
   I affirm that the above information is correct and that the telescope is securely shutdown:
   <p>
      Nominated Checker's Email: 
      <br>
      <i>(Make sure you know this person is available to do the check!)</i>
   </p>
</div>
<div style="float: left; width: 50%">
   <input type="checkbox" name="affirmation" value="Affir"> Agree <br><br> <br>
   <input type='text' name='Email' /> 
</div>

   <!--<input type="reset" value="Start Over">-->

   <p>
      <input type='submit' name='formSubmit' value='Submit' />
   </p>


</div>

</form>


<?php 
}
else
{
/// Submitted

$errorFlag="no";

//if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$obsmail))
//{ echo "Invalid email format!\n"; 
//$errorFlag="yes";
//}

if(empty($_POST["affirmation"]))
{ echo "You must agree to the above statement!<br>"; 
$errorFlag="yes";
}
if(empty($_POST["Email"]))
{ echo "Checker emailing required!<br>"; 
$errorFlag="yes";
}
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$emailc))
{  echo "Invalid email format!<br>"; 
$errorFlag="yes";
}
if ( $emailErr != "" )
{
$errorFlag="yes";
}

if ( $errorFlag == "yes" )
{
  echo "<br> One of the above is wrong or you have entered the wrong username/password\r\n";
  $link_address = "http://fact-project.org/Checklist/";
  if ( $emailErr != "" )
  {
    echo $emailErr;
  }
  echo "Click <a href='".$link_address."'>here</a> to go back.\r\n";
  exit("");
}

//errorflag
// Copy IR image

$image_path = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/";
if( !is_dir($image_path) ) {
    mkdir($image_path, 0777, true);
}

$file1 = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/IRcam_".date("Y-m-d_H:i:s").".jpg";
$file2 = "/home/factwww/Checklist/images/".date("Y")."/".date("m")."/FocalPlane_".date("Y-m-d_H:i:s").".jpg";
$file1name = "http://fact-project.org/Checklist/images/".date("Y")."/".date("m")."/IRcam_".date("Y-m-d_H:i:s").".jpg";
$file2name = "http://fact-project.org/Checklist/images/".date("Y")."/".date("m")."/FocalPlane_".date("Y-m-d_H:i:s").".jpg";
copy("../cam/snap2.jpg",$file1);
copy("../cam/lidcam2.jpg",$file2);

/// EMAIL bit
if($errorFlag=="no")
{


$today = date("Y-m-d");
$subject = "FACT Shutdown ${today}";
$obsname = $_POST['Obsname'];

$message = "${obsname} has completed a shutdown form:\n\n";

if( $_POST["telparked"] )
{ $message = "${message} Telescope Parked:\t\tYes\n"; }
else
{ $message = "${message} Telescope Parked:\t\tNo\n"; }

if( $_POST["biasoff"] )
{ $message = "${message} Bias Disconnected:\t\tYes\n"; }
else
{ $message = "${message} Bias Disconnected:\t\tNo\n"; }

if( $_POST["lidclosed"] )
{ $message = "${message} Lid:\t\t\t\t\tClosed\n"; }
else
{ $message = "${message} Lid:\t\t\t\t\tOpen\n"; }

if( $_POST["totheroff"] )
{ $message = "${message} TPoint Camera:\t\t\tOff\n"; }
else
{ $message = "${message} TPoint Camera:\t\t\tOn\n"; }

if( $_POST["dotheroff"] )
{ $message = "${message} Drive:\t\t\t\t\tOff\n\n"; }
else
{ $message = "${message} Drive:\t\t\t\t\tOn\n\n"; }

$message = "${message} The focal plane image available at:\n $file2name\n"; 
$message = "${message} The IR Cam image available at:\n $file1name\n\n"; 

$message = "${message} They affirm to the information.\n";

$message2 = "You are today FACT backup!.\n PLEASE in good time check the information below is correct: \n\n ${message}";

echo "<br>";
//echo $message; echo "<br>";
echo nl2br($message);
echo "<br>";

$from = $_POST['Obsmail'];

  if (isset($_POST["Obsmail"]))
  {
    //Check if "from" email address is valid
    $mailcheck = spamcheck($from);
    if ($mailcheck==FALSE)
      {
      echo "Invalid input";
      }
    else
      {
      $message = wordwrap($message, 70);
      // send mail
      mail("fact-online@lists.phys.ethz.ch",$subject,$message,"From: $from\n");
      mail($emailc,$subject,$message2,"From: $from\n");
      echo "<br>";
      echo "Thank you";
      echo "<br>";
      }
    } else
    {
        echo "<br>";
        echo "Mail not sent!!";
        echo "<br>";
    }

}
}

?>

</body>
</html>

