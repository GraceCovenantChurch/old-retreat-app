<?php

include_once("gcc_header.php");

$pw = rand_string(6);

include_once("db_connect.php");
$email = $_POST['email'];
$res = mysql_query("SELECT * FROM Retreat_Participants WHERE email='$email'");
$upd = mysql_query("UPDATE Retreat_Participants SET password='" . md5($pw) . "' WHERE email='$email'");
$row = mysql_fetch_assoc($res);
$fname = $row['fname'];

if($fname!=null){

echo "<p>You will receive an email with a new password.</p>";

$mail_subj = "GCC College Retreat 2016 Login Info";
      $headers = <<<EOF
From: GCC College Retreat 2016 <retreatstaff@gracecovenant.net>
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1


EOF;

      $mail_body = <<<EOF
<HTML>
 <head><title>$subject</title></head>
 <body>
  <p>Dear $fname,</p>
  
  <p>Your new password is: $pw</p>

 </body>
</HTML>
EOF;
      $res = mail($email, $mail_subj, $mail_body, $headers);
      if (!$res) { echo "<!-- email failed: $email\n$mail_subj\n\n$mail_body -->\n"; }
      // END EMAIL
}
else{
  echo "<p>Email account not found in database.  Contact retreatstaff@gracecovenant.net for details.</p>";
}

echo "<p>Back to <a href='login.php'>login page</a></p>";
echo "<div style='height: 450px'>&nbsp;</div>";

include_once("gcc_footer.php");
?>


