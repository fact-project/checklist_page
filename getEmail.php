<?php

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

?>
