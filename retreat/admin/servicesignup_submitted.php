<?php
$title = "Sign Up - Submitted";
//include_once("db_verify.php");
include_once("../header.php");
include_once("../db_fields.php");
include_once("../db_connect.php");

  // prepare INSERT INTO Retreat_Participants query
  $field_names = array();
  $field_values = array();
  foreach ($fields as $field) {
    // PASSWORDS
    if ($field['name'] == 'pass2') {
      continue;
    } else if ($field['name'] == 'pass1') {
      array_push($field_names, 'password');
      array_push($field_values, "'" .md5($_POST['pass1']). "'");
      continue;
    }

    // NORMAL FIELDS
    array_push($field_names, $field['name']);
    $field_val = $_POST[$field['name']];
    if ($field['type'] == 'select_num') {
      array_push($field_values, $field_val); // numeric selects don't have ticks
    } else {
      array_push($field_values, "'" .escape_string($field_val). "'");
    }
  }
  include_once("../prices_inc.php");
  $explanation = "";
  $expl_ascii = "";
  $price = prices_get_cost_and_expl($explanation, $expl_ascii, $_POST['school']);

    $deposit = $_POST['deposit'];
    array_push($field_names, "deposit");
    array_push($field_values, $_POST['deposit']);

  array_push($field_names, "price");
  array_push($field_values, $price);

  $email = escape_string($_POST['email']);
	    $ins_qry = "INSERT INTO Retreat_Participants(`" .join("`,`",$field_names). "`) ";
		$ins_qry .= "VALUES(" .join(",",$field_values). ");";
	    $result = mysql_query($ins_qry);

  $err = false;
  if (!$result) {
    $err = mysql_error();
    if (strncmp($err, "Duplicate entry ", strlen("Duplicate entry "))==0) {
      echo "<p>Someone has already registered for GCC College Retreat using this email address ($email).  If you need to change any of your information, please contact <font color='blue'>retreatstaff@gracecovenant.net</font></p><p><a href='servicesignup.php'>Back to Signup page</a></p>";
    } else {
      die("Error adding your info to the database: $err" );
    }
  }

    if ($deposit == 1) {
      echo "<center>You applied for financial aide! Please click here to e-mail the retreat coordinators for financial aid discussion!</center><br><br><a href='servicesignup.php'>Back to signup sheet</a></center>\n";
      $mail_subj = "GCC College Retreat 2018 Financial Aid";
      $headers = <<<EOF
From: GCC College Retreat 2018 <retreatstaff@gracecovenant.net>
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1

EOF;

$mail_body = <<<EOF
<HTML>
  <head><title>$subject</title></head>
  <body>
    <p>You have applied for financial aid! Please reply to this e-mail to start discussing financial aid possibilities!</p>
  </body>
</HTML>
EOF;
      $res = mail($email, $mail_subj, $mail_body, $headers);
      if (!$res) { echo "<!-- email failed: $email\n$mail_subj\n\n$mail_body -->\n"; }
      // END EMAIL
    } else if (!$err) {
      echo "<center>You have successfully registered. If you haven't yet, please hand the cash to the person that is managing the retreat registration booth. <br><br>  <a href='servicesignup.php'>Back to signup sheet</a></center>\n";
    }

include_once("../footer.php");
?>
