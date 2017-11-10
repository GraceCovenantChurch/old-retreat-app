<?php
session_start();
$admin = 1;
include_once('../db_connect.php');

function check_pw($in_email,$in_pass)
{
  if (!$in_email) { return " "; }
  $res = mysql_query("SELECT password FROM Retreat_Coordinators WHERE email='$in_email';");
  list($pass) = mysql_fetch_array($res);
  if ($pass) {
    if ($pass == $in_pass) {
      return "";
    } else {
      return "bad password";
    }
  } else {
    return "email address not found";
  }
}

$err = "Please log in.";
if (!$_SESSION['USER'] && $_COOKIE['admin_user']) {
  $_SESSION['USER'] = $_COOKIE['admin_user'];
  $_SESSION['PASS'] = $_COOKIE['admin_pass'];
}
if ($_SESSION['USER']) {
  $err = check_pw($_SESSION['USER'],$_SESSION['PASS']);
}
if ($err != "") {
  $err = check_pw($_POST['email'],md5($_POST['password']));
  if ($err == "") {
    $_SESSION['USER'] = $_POST['email'];
    $_SESSION['PASS'] = md5($_POST['password']);
    $newtime = mktime(0,0,0,7,4,2007);
    setcookie('admin_user',$_SESSION['USER'],$newtime,"/admin/", ".amirevolution.com");
    setcookie('admin_pass',$_SESSION['PASS'],$newtime,"/admin/", ".amirevolution.com");
  }
}

if ($err != "")
{
  // not logged in
  include_once('../header.php');
?>
<h4>Please log in:</h4>
<form method="post">
<p style="text-align: center"><?php echo $err; ?>
<p style="text-align: center">
<table bgcolor="#009900" cellpadding=4 cellspacing=1 border="0" align="center">
<tr bgcolor="#FFFFFF"><td>Email:</td><td><input type="text" name="email"></td></tr>
<tr bgcolor="#FFFFFF"><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr bgcolor="#FFFFFF"><td colspan="2" align="center"> <input type="submit" value="log in"></td></tr>
</table>
</form>
<?php
  include_once('../footer.php');
  exit(1);
}

$email = $_SESSION['USER'];

list($name,$is_admin) = mysql_fetch_array(mysql_query("SELECT `name`,`admin` FROM Retreat_Coordinators WHERE email='$email';"));

$links = "[<a class='small' href='index.php'>Database</a>] [<a class='small' href='profile.php'>My Info</a>]";
if ($is_admin) {
   $links .= " [<a class='small' href='checkin.php'>Check-In</a>]";
   $links .= " [<a class='small' href='smallgroup-nice.php'>Small Groups</a>]";
   $links .= " [<a class='small' href='rooms.php'>Rooms</a>]";
   $links .= " [<a class='small' href='transpo.php?way=to'>Transpo To</a>]";
   $links .= " [<a class='small' href='transpo.php?way=back'>Transpo Back</a>]";
  if ($name == 'Kevin') {
    $links .= " [<a class='small' href='users.php'>User Management</a>]";
  }
}
$links .= "[<a class='small' href='servicesignup.php' target='_blank'>Service Signup</a>]";
$links .= "[<a class='small' href='saveToCsv.php'>Save to CSV</a>]";

$links .= " [<a class='small' href='logout.php'>Logout</a>]";

function rand_string($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
   $string = '';
   for ($i = 0; $i < $len; $i++)
   {
       $pos = rand(0, strlen($chars)-1);
       $string .= $chars{$pos};
   }
   return $string;
}

?>
