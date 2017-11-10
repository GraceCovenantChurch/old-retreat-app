<?php
$title = "Sign Up - Submitted";
include_once("gcc_header.php");
include_once("db_fields.php");
include_once("db_connect.php");

$upd_qry = "UPDATE Retreat_Participants SET lastupdater='login', lastupdate=CURRENT_TIMESTAMP WHERE email='$email';";

// execute INSERT query and check for errors
$result = mysql_query($upd_qry);
if (!$result) {
  $err = mysql_error();
  $err = "Error updating your info: $err";
}
if (mysql_affected_rows() != 1) {
  $err = "Email address not found: $email\n";
  $err .= "Please contact retreat2018@gracecovenant.net to tell us what happened.  Thank you!\n";
}

if ($err) {
  echo $err;
}

include_once("gcc_footer.php");
?>
