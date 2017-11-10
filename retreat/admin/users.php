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

if ($_POST['submit']) {
  $my_name = escape_string($_POST['name']);
  $my_email = escape_string($_POST['email']);
  $my_pass = escape_string($_POST['pass1']);
  if (!$my_pass) {
    $my_pass = rand_string(6);
  }
  $my_admin = ($_POST['admin']) ? 1 : 0;
  $qry = "INSERT INTO Retreat_Coordinators(`name`,`email`,`password`,`admin`) VALUES('$my_name','$my_email',MD5('$my_pass'),$my_admin);";
  $res = mysql_query($qry);
  if (!$res) {
    echo "Error in insert: " .mysql_error()."\n";
  }
  $mail_hdrs = <<<EOF
From: GCC College Retreat 2016 Registration <retreat2016@gracecovenant.net>
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1


EOF;
  $mail_subj = "Retreat Coordinator Information";
  $mail_body = <<<EOF
<HTML>
 <head><title>$subject</title></head>
 <body>
<p>Dear $my_name,

<p>As a retreat coordinator, you have access to information such as who has signed up and how much they have paid so far.

<p>Admin page: http://uc.gracecovenant.net/retreat/admin/ <br>
Username: $my_email<br>
PW: $my_pass<br>

<p>Sunday service signup page: http://uc.gracecovenant.net/retreat/admin/servicesignup.php

<p>You can change your personal information when you log in by clicking "My Info" at the top right.

<p>Email Kevin w/ any questions!

<p>Thanks,<br>
Kevin

 </body>
</HTML>

EOF;
  
  // send email
  $res = mail($my_email,$mail_subj,$mail_body,$mail_hdrs);
}
echo <<<EOF

<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<h4>Add New User:</h4>

<form method="post" name = "infoForm" action="users.php" onsubmit="return verifyForm();">
<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='600'>
 <tr bgcolor='#ffffff'>
  <td>Name</td><td><input type='text' name='name' value=""></td>
  <td>Email</td><td><input type='text' name='email' value=""></td>
 </tr><tr bgcolor='#ffffff'>
  <td>Password</td><td><input type='password' name='pass1'></td>
  <td>Repeat Password</td><td><input type='password' name='pass2'></td>
 </tr><tr bgcolor='#ffffff'>
  <td>Is Admin</td><td><input type='checkbox' name='admin' value='1'></td>
  <td colspan='2'>&nbsp;</td>
 </tr><tr bgcolor='#ffffff' align='center'>
  <td colspan='4'><input type='submit' name='submit' value='Submit'></td>
 </tr>
</table>
</form>
<h4>Current Users:</h4>

<div style="margin: 0px; border: 1px solid #009900; background-color:#ffffff;">
<table bgcolor='#009900' border=0 cellspacing=1 cellpadding=4>
 <tr bgcolor='#ffffff'>
  <th>Name</th>
  <th>Email</th>
  <th>Is Admin</th>
 </tr>

EOF;
$qry = "SELECT `name`,`email`,`admin` FROM Retreat_Coordinators;";
$res = mysql_query($qry);
while ($row = mysql_fetch_array($res))
{
  list($my_name,$my_email,$my_admin) = $row;
  $my_admin = ($my_admin==1) ? "yes" : "no";
  echo <<<EOF
 <tr bgcolor='#ffffff'>
  <td>$my_name</td>
  <td><a href="mailto:$my_email">$my_email</a></td>
  <td>$my_admin</td>
 </tr>

EOF;
}
echo <<<EOF
</table>
</div>

EOF;
include_once('../footer.php');
?>
