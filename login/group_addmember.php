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

$group_name_q = $db_object->query("SELECT name FROM Groups WHERE group_id = $gid");
if(DB::isError($db_object)) { die($group_name_q->getMessage()); }
$gname_r = $group_name_q->fetchRow();
$gname = $gname_r['name'];;
echo "<strong><em>$gname group page";
echo "<font color=#0000CC> for servants</font>";
echo "</em></strong>\n<p>";

require "authenticate_servant.php";

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
                      <td align="left" valign="top"> <strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Add Member
                        </font></strong></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top">
<?php
echo "<form method=\"post\" action=\"group_addmember.php?gid=$gid\">\n";

if ($_POST['fn'] || $_POST['ln'])
{
  $query = "SELECT * FROM Users WHERE CONCAT(fname, ' ', lname) LIKE '".$_POST['fn']."% ".$_POST['ln']."%' ORDER BY lname ASC, fname ASC";
  $res = mysql_query($query);
  if (!$res) {
    echo "SQL error in '$query': " . mysql_error() . "<br>\n";
    exit(1);
  }
  echo "<p><strong>Select member to be added</strong><br>\n";
  echo "&nbsp; <input type='radio' name='newuserid' value='0' CHECKED>";
  echo "None<br>\n";
  while ($row = mysql_fetch_assoc($res))
  {
    echo "&nbsp; <input type='radio' name='newuserid' value='".$row['user_id']."'>";
    echo $row['fname'] . " " . $row['lname'] . " &lt;" . $row['email'] . "&gt;<br>\n";
  }
  echo "<p><input type='submit' name='submit' value='Just Add'>\n";
}
echo "<p>Member name:\n";
echo "<input type=\"text\" name=\"fn\"> <input type=\"text\" name=\"ln\"> <nobr>* partial name OK, we will db search it.</nobr><br>* pressing 'Enter' will 'Add and Search Again' in most browsers.\n";

if (stristr($_POST['submit'],'add'))
{
  $newid = $_POST['newuserid'];
  if (!$newid) {
    echo "<p><b>Warning: you selected 'None' and 'Add' ... no member added.</b><br>\n";
  }
  else {
    $group_id_q = $db_object->query("SELECT 1 FROM Members WHERE user_id = $newid AND group_id = $gid");
    if(DB::isError($db_object)) { die($group_id_q->getMessage()); }
    if ($group_id_q->fetchRow()) {
      echo "<p><b>Warning: already a member.  Member was not added.</b><br>\n";
    }
    else 
    {
      $qry = "INSERT INTO Members(`user_id`,`group_id`,`type`,`status`) ";
      $qry .= "VALUES($newid, $gid, 1, 4);";
      $group_addmem_q = $db_object->query($qry);
      if(DB::isError($db_object)) { die($group_addmem_q->getMessage()); }
      echo "<p><b>Successfully added new member!</b>\n";
    }
  }
}
echo "<p>";
if ($_POST['fn'] || $_POST['ln'])
{
  echo "<input type='submit' name='submit' value='Add and Search Again'>\n";
  echo "<input type='submit' name='submit' value='Just Search Again'>\n";
}
else
{
  echo "<input type='submit' name='submit' value='Search'>\n";
}
require "show_members_list.php";
?>
</form>
                        <p></p></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/bottom.jpg">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
