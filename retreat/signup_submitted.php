<?php
// if spamField is not set or was off from current time by more than 300 seconds, throw error and die
$spamTime = $_POST['spamField'];
if (!isset($spamTime) || (abs(time() - intval($spamTime)) > 300)) {
  die("Invalid form - please try to refresh the signup page first and make sure JavaScript is enabled.");
}

// check for ?fg at end
if($_POST['fg']) {
  $fg_flag = True;
} else {
  $fg_flag = False;
}

$title = "Sign Up - Submitted";
include_once("gcc_header.php");
include_once("db_fields.php");
include_once("db_connect.php");
 
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
  include_once("prices_inc.php");
  $explanation = "";
  $expl_ascii = "";
  $price = prices_get_cost_and_expl($explanation, $expl_ascii, $_POST['school']);

  array_push($field_names, "price");
  array_push($field_values, $price);
  
  $email = escape_string($_POST['email']);

  $ins_qry = "INSERT INTO Retreat_Participants(`" .join("`,`",$field_names). "`) ";
  $ins_qry .= "VALUES(" .join(",",$field_values). ");";

  echo "\n<!-- $ins_qry -->\n";

  // execute INSERT query and check for errors
  $result = mysql_query($ins_qry);

  $err = false;
  if (!$result) {
    $err = mysql_error();
    if (strncmp($err, "Duplicate entry ", strlen("Duplicate entry "))==0) {
      echo "<p>Someone has already registered for GCC College Retreat 2017 using this email address ($email).  If you need to change any of your information, please contact <a href='mailto:retreatstaff@gracecovenant.net'>retreatstaff@gracecovenant.net</a>";
    } else {
      die("Error adding your info to the database: $err" );
    }
  }

  if (!$err) {
      // SEND EMAIL
      echo "You have successfully registered for GCC College Retreat 2017!\n";
      $sel_qry = "SELECT id FROM Retreat_Participants WHERE email='" .escape_string($email). "'";
      $res = mysql_query($sel_qry);
      $id = -1;
      if ($res) {
        list($id) = mysql_fetch_array($res);
      }
  
      $mail_subj = "Registration for GCC College Retreat 2017";
      $name = $_POST['fname'] .' '. $_POST['lname'];
      $headers = <<<EOF
From: GCC College Retreat 2017 Registration <retreatstaff@gracecovenant.net>
MIME-Version: 1.0
Content-type: text/html; charset=iso-8859-1


EOF;
		$email_esc = str_replace($email, "@","%40");
		$email_esc = str_replace($email, ".","%2e");

        if ($price == $deposit) {
			$payment_instructions = '<p>You paid the full cost of the retreat at service.  Thank you!</p>';
        } else {
			$remainder = $price - $deposit;
			if ($deposit > 0) {
				$payment_instructions = "<p>You paid \$$deposit at church today.  Please pay the remaining \$$remainder at Sunday Service some time soon or through PayPal.  Thanks!</p>\n";
			} else {
				$payment_instructions = "<p>Your registration will be complete as soon as we receive full payment via PayPal.  <b>Your cost will be based on when you pay, not when you sign up,</b> so please pay as soon as possible.  Thanks!</p>\n";
			}
        }
        $password = $_POST['pass1'];
        $payment_instructions .= <<<EOF
<p>Please <a href="http://uc.gracecovenant.net/retreat/login.php">Log In</a> at your convenience to see your payment status and to pay through PayPal.</p>
<p>
Email address: $email<br>
Password: $password
EOF;
      
      $mail_body = <<<EOF
<HTML>
 <head><title>$subject</title></head>
 <body>
  <p>Dear $name,

  <p>We're glad to hear you'll be attending GCC College Retreat 2017.

  <p>Your total cost was calculated as follows:

<pre>
$expl_ascii
</pre>

  $payment_instructions

 </body>
</HTML>
EOF;
     // do not send email if $fg_flag
     if($fg_flag) {
       echo '<p><a href="index.php?fg">Back to FG signup page</a></p>';
     } else {
       $res = mail($email, $mail_subj, $mail_body, $headers);
      if (!$res) { echo "<!-- email failed: $email\n$mail_subj\n\n$mail_body -->\n"; }
     }      
      // END EMAIL

      // show them how much it will cost and how to pay
      echo "<p></p>\n";
      echo $explanation;

        $email = $_POST['email'];
        echo <<<EOF
	<p class='noticeMe'><u>Pay the full \$$price:</u></p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="paypal@gracecovenant.net">
        <input type="hidden" name="item_name" value="GCC College Retreat 2017">
        <input type="hidden" name="amount" value="$price.00">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="custom" value="$email">
        <input type="hidden" name="invoice" value="a2017_$id">
        <input type="hidden" name="return" value="http://www.uc.gracecovenant.net/retreat/payment_success.php">
        <input type="hidden" name="cancel_return" value="http://www.uc.gracecovenant.net/retreat/payment_failure.php">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="bn" value="PP-BuyNowBF">
        <input type="image" src="images/x-click-but6.gif" border="0" name="submit" alt="Make payment with PayPal">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>

      
EOF;

    }   
?>
<div style="height: 350px">&nbsp;</div>
<?php
include_once("gcc_footer.php");
?>
