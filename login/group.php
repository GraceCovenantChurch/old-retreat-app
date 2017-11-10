<?php

include('authenticate.php');	// authentication script. ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Middle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
</head><style>
<!--
BODY{
scrollbar-face-color:#DB9864;
scrollbar-arrow-color:#DB9864;
scrollbar-track-color:#DB9864;
scrollbar-shadow-color:#BF875B;
scrollbar-highlight-color:#BF875B;
scrollbar-3dlight-color:'';
scrollbar-darkshadow-Color:'';
}
-->
</style>

<body background="images/brown.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="770" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="232" valign="top"><? require ("../php/includes/login.inc") ?>
</td>
    <td valign="top">
<table width="538" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="40" background="images/top.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td background="images/middle.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="60">&nbsp;</td>
                <td width="418"><div align="left"> 
                    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <?php
$gid = $_GET['gid'];
$uid = $_SESSION['user_id'];
$servant = $_GET['servant'];

// are they a member?
$group_id_q = $db_object->query("SELECT status FROM Members WHERE user_id = $uid AND group_id = $gid");
if(DB::isError($db_object)) { die($group_id_q->getMessage()); }
$ismember = $group_id_q->fetchRow();

// are they a servant?
$isservant = $ismember && $ismember['status'] < 4;

$group_name_q = $db_object->query("SELECT name FROM Groups WHERE group_id = $gid");
if(DB::isError($db_object)) { die($group_name_q->getMessage()); }
$gname_r = $group_name_q->fetchRow();
$gname = $gname_r['name'];;

echo "<strong><em>$gname group page";
if ($servant) {
   echo "<font color=#0000CC> for servants</font>";
}
echo "</em></strong>";

if ($servant)
{
  if (!$isservant) {
    die("<p><font color=\"#DD0000\"><b>You are not a servant of this group.</b></a>\n");
  }
}

if (!$ismember) {
  echo "<p><b>You are not registered as a member of this group.</b><br>\n";
  echo "Please contact one of the servants through the <a href=\"/contacts/familygroups.php\">contacts</a> page";
}

$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = $uid");
if(DB::isError($db_object)) {
	die($group_id_q->getMessage());
}
$group_id = $group_id_q->fetchRow();

?>
                      </font></p>
                  </div></td>
                <td width="60">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3"><table width="538" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="60">&nbsp;</td>
                            <td><TABLE border = "0">
                                <TR> 
                                  <td align="center" valign="top" bordercolor="#FFFFFF"> 
                                    <p><font style="font-size: 10px" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href="main.php"><br>
                                      Home</a> &#8226; <a href="myinfo.php">Account 
                                      info</a> &#8226; <a href="directory.php">Directory</a> 
                                      &#8226; <a href="events.php">Events &amp; 
                                      Classes</a> &#8226; <a href="groups.php">Groups</a> 
                                      &#8226; <a href="logout.php">Logout</a><br>
                                      <br>
                                      </strong></font></p></td>
                                </TR>
                              </TABLE></td>
                            <td width="60">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
<?php
if ($ismember || $isservant)
{
?>
        <tr> 
          <td background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0">
                    <tr> 
                      <td align="left" valign="top"> <strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Members
                        </font></strong><BR> <BR></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top">
<?php
$uid = $_SESSION['user_id'];

require "show_members_list.php";
?>
                        <p></p></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
<?php
}
?>
        <tr> 
          <td height="30" background="images/bottom.jpg">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
