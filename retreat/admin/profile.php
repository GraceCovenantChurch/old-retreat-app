<?php
include_once('db_verify.php');
$title = "Admin Interface";
$js = <<<EOF
function verifyForm()
{
  if (document.forms.infoForm['pass1'].value != document.forms.infoForm['pass2'].value) {
    alert("Passwords do not match.");
    return false;
  }
  if (document.forms.infoForm['email'].value == '') {
    alert("Please enter a value for 'email'");
    return false;
  }
  return 1;
}
EOF;
include_once('../header.php');
$info_changed = "";
if ($_POST['submit']) {
  $pass_update = "'";
  $info_changed = "Information updated.";
  if ($_POST['pass1']) {
    $info_changed = "Password successfully changed.";
    $pass_update = "',password=MD5('".escape_string($_POST['pass1'])."')";
  }
  $qry = "UPDATE Retreat_Coordinators SET name='".escape_string($_POST['name'])."', email='".escape_string($_POST['email']).$pass_update." WHERE email='".escape_string($email)."'";
  echo "<!-- $qry -->";
  $res = mysql_query($qry);
  if ($res) {
    $email = $_POST['email'];
    $newtime = mktime(0,0,0,7,4,2007); // for cookies
    $_SESSION['USER'] = $email;
    setcookie('admin_user',$_SESSION['USER'],$newtime,"/admin/", ".amirevolution.com");
    if ($_POST['pass1']) {
      $_SESSION['PASS'] = md5($_POST['pass1']);
      setcookie('admin_pass',$_SESSION['PASS'],$newtime,"/admin/", ".amirevolution.com");
    }
  } else {
    $info_changed = "Error: ".mysql_error()."\n";
  }
}

$name_esc = htmlspecialchars($name);
$email_esc = str_replace('"','"""',$email);

echo <<<EOF

<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<br>$info_changed<br>

<form method="post" name = "infoForm" action="profile.php" onsubmit="return verifyForm();">
<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='300'>
 <tr bgcolor='#ffffff'>
  <td>Name</td><td><input type='text' name='name' value="$name_esc"></td>
 </tr><tr bgcolor='#ffffff'>
  <td>Email</td><td><input type='text' name='email' value="$email_esc"></td>
 </tr><tr bgcolor='#ffffff'>
  <td>Password</td><td><input type='password' name='pass1'></td>
 </tr><tr bgcolor='#ffffff'>
  <td>Repeat Password</td><td><input type='password' name='pass2'></td>
 </tr><tr bgcolor='#ffffff' align='center'>
  <td colspan='2'><input type='submit' name='submit' value='Submit'></td>
 </tr>
</table>
</form>
EOF;

include_once('../footer.php');
?>
