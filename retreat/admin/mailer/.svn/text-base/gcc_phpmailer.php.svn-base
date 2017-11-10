<?php
require "tidyjson.php";
include_once('../../db_connect.php');

set_include_path ( "phpmailer/PHPMailer" );

require 'class.phpmailer.php';

// run only from CLI
if(!defined('STDIN') )
{
    echo "Sorry, please use the CLI.";
    exit(1);
}

// parse args
if(count($argv)!=2)
{
  echo <<<USAGE
  Usage: php $argv[0] <json_filename>

USAGE;
  exit(1);
}

// ======== read file into json object ==================
$json_filename = $argv[1];
$json_str = file_get_contents($json_filename);

// strip off new lines and spaces
$tidy = TidyJSON::tidy($json_str);
$json_object = json_decode($json_str);

$mail_str = implode("\n", $json_object->email->body);
$mail_subj = $json_object->email->subject;
$log_filename = $json_object->log_file;
$email_name = $json_object->name;
$mysql_command = $json_object->mysql_command;
$small_group_email = $json_object->sg_email;

// ========= run mysql query and go through each row ====================

$fh = fopen($log_filename, 'a') or die("can't open file");

$date_str = date("Y-m-d, H:i:s");
log_this($fh, "=================== " . $date_str . ", " . $email_name . " (" . $json_filename . ") =========================");
log_this($fh, "------------------- " . $mysql_command . " ----------------------");

$res = mysql_query($mysql_command);
$i = 0;
while ($row = mysql_fetch_assoc($res)) 
{
  // define special var $sgmembers if this is the small group email
  if ($small_group_email == 'True') {
    $sg = $row['sg'];
    $res2 = mysql_query("select fname,lname,class,school from Retreat_Participants where sg='$sg' and sgleader=0");
    $sg_str = "<ul>";
    while ($row2 = mysql_fetch_assoc($res2)) {
      $sg_str .= '<li>' . $row2['fname'] . ' ' . $row2['lname'] . ' - ' . $row2['class'] . ' - ' . $row2['school'] . '</li>';
    }
    $sg_str .= "</ul>";
    $sgmembers = $sg_str;
  }
  $i++;
  $email = $row['email'];
  eval("\$this_mail_str = \"$mail_str\";");
  $this_mail_body = <<<EOF
<HTML>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>College Retreat 2015</title>
 </head>
<body>
<div style='border: 1px solid #333333; padding: 5px; width: 905px'>
<div style='font-family: Verdana, Arial; padding: 5px;'>
$this_mail_str
</div>
</div>
</body>
</HTML>
EOF;
  echo "Emailing " . $email . "...\n";
  $log_str = php_mail_this($email, $mail_subj, $this_mail_body);
  log_this($fh, $log_str);
}

// close log file
fclose($fh);


// ======= function for emailing ===========================
function php_mail_this($email, $mail_subj, $mail_body)
{
$mail = new PHPMailer;

$mail_username = "retreat2015@gracecovenant.net";

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.gracecovenant.net';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $mail_username;                            // SMTP username
$mail->Password = 'H@rveyCedars';                           // SMTP password
$mail->Port       = 587;

$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = $mail_username;
$mail->FromName = 'GCC College Retreat 2015';
$mail->AddAddress($email);  // recipient
$mail->AddReplyTo($mail_username, 'GCC College Retreat 2015');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = $mail_subj;
$mail->Body    = $mail_body;

  sleep(2); // sleep two seconds

  if ($mail->Send())
  {
    $log_str = "Successful email to (" . $email . ")";
  }
  else
  {
    $log_str = "Error sending email to (" . $email . ")" . $mail->ErrorInfo;
  }
  return $log_str;

}



function mail_this($email, $mail_subj, $mail_body)
{
  $headers = <<<EOF
From: GCC College Retreat 2015 <retreat2015@gracecovenant.net>
Reply-To: retreat2015@gracecovenant.net
Return-Path: retreat2015@gracecovenant.net
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1


EOF;

  $additionalParams = '-f' . 'retreat2015@gracecovenant.net';

  sleep(5); // sleep five seconds
  return mail($email, $mail_subj, $mail_body, $headers);
}

function log_this($filehandle, $line)
{
  fwrite($filehandle, $line . "\n");
}
?>