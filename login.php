<?php

$ldaphost = "fact-project.org:389";
$baseDN   = "dc=fact,dc=iac,dc=es";
$groupDN  = "cn=Operations,ou=Application Groups,".$baseDN;

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

    foreach ($srData[0]['member'] as $member)
        if (strpos($member, "cn=".$userCommonName.",")===0)
            return "";

    return "Sorry, your credentials don't match!";
}

?>
