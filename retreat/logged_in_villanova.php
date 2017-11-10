<?php
$title = "Payment Status";
include_once("db_fields.php"); // defines $fields
include_once("db_connect.php");

$sel_qry = "SELECT * FROM Retreat_Participants WHERE email='" .$_POST['email']. "';";
$res = mysql_query($sel_qry);
$err = "";
if ($row = mysql_fetch_assoc($res)) {
  if (strpos(md5($_POST['password']),$row['password'])===0) {
    // we're good!
  } else {
    // bad password
    $err = "Bad password.  <a href=\"forgotpw.php\">Forgot your password?</a>";
  }
} else {
  $err = "Can't find email address: " .$_POST['email'] .".";
}

if (!$err) {
$js = <<<EOF1
description = new Array(

EOF1;
$js .= <<<EOF2
  ""
);
function verifyForm()
{
  if (document.forms.retreatForm.pass1.value != document.forms.retreatForm.pass2.value) {
    alert("Passwords must match.");
    return false;
  }
EOF2;
  foreach ($fields as $field) {
    // it's ok for password to be blank this time; we just won't change it.
    if ($field['name']=='pass1' || $field['name']=='pass2' ) {
      continue;
    }
    $js .= "\n  if (document.forms.retreatForm['" .$field['name']. "'].value == \"\"";
    $js .= ") {\n";
    $js .= "    alert(\"please enter a value for " .$field['desc']. ".\");\n";
    $js .= "    return false;\n  }";
  }
$js .= <<<EOF3

  return true;
}
EOF3;
} // matches if (!$err) {
include_once("gcc_header.php");

if (!$err) {
?>
<center>Please email <font color="blue">retreatstaff@gracecovenant.net</font> if you have any questions.</center>
<p>
<table width=84% border=0 bgcolor="#2b2b2b" cellspacing=1 cellpadding=4 align="center">
<?php
$field_num = 0;
foreach ($fields as $field)
{
  if ($field['name']=='pass1' || $field['name']=='pass2') {
    continue;
  }
  if ($field_num > 0) {
    if (!$field['join']) {
      echo "</td></tr>\n";
    }
  }
  if (!$field['join']) {
    $class = 'small';
    echo "<tr bgcolor='#FFFFFF'><td width='150' class='$class'>" .$field['desc']. "</td><td class='small'>";
  } else {
    echo $field['join'];
  }
  if ($field['type'] == 'text') {
    echo str_replace("'", "\\'", $row[$field['name']]);
  } elseif ($field['type'] == 'select' || $field['type'] == 'select_num') {
    foreach ($field['extra'] as $key => $value) {
      $sel = "";
      if ($value == $row[$field['name']]) {
		echo $key;
	  }
    }
  }
}
?>
  </td></tr>
 <tr bgcolor="#FFFFFF">
  <td colspan="2" align="center">
      <input type="hidden" name="email" value=<?php echo $_POST['email']; ?>>
  </td>
 </tr>
 <tr bgcolor="#FFFFFF">
  <td colspan="2" align="center">
<?php
$deposit = $row['deposit'];
$price = $row['price'];
echo "You have paid \$$deposit of \$$price.<br>\n";
if ($deposit < $price) {
    $balance = $price;
    $id = $row['id'];
    $email = escape_string($row['email']);
    $email_esc = str_replace($email, "@","%40");
    $email_esc = str_replace($email, ".","%2e");

//    if ($deposit == 0) {
//      $depositStr = "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal%40gracecovenant%2enet&item_name=GCC%20College%20Retreat%202016&amount=40%2e00&no_shipping=0&custom=$email_esc&invoice=a2016_deposit_$id&return=http%3a%2f%2fuc%2egracecovenant%2enet%2fretreat%2fpayment_success%2ephp&cancel_return=http%3a%2f%2fuc%2egracecovenant%2enet%2fretreat%2fpayment_failure%2ephp&no_note=1&currency_code=USD&lc=US&bn=PP%2dBuyNowBF&charset=UTF%2d8'>pay the \$40 deposit by PayPal</a> or ";
//    } else {
//      $depositStr = ""; 
//    }
 
    echo "Please $depositStr <a href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal%40gracecovenant%2enet&item_name=GCC%20College%20Retreat%202016&amount=70%2e00&no_shipping=0&custom=$email_esc&invoice=a2016_$id&return=http%3a%2f%2fuc%2egracecovenant%2enet%2fretreat%2fpayment_success%2ephp&cancel_return=http%3a%2f%2fuc%2egracecovenant%2enet%2fretreat%2fpayment_failure%2ephp&no_note=1&currency_code=USD&lc=US&bn=PP%2dBuyNowBF&charset=UTF%2d8'>pay \$70 by PayPal</a> as soon as possible.\n";
}
?>
<br>
<?php
	echo "If you are paying by cash, please pay \$70!";
?>

  </td>
 </tr>
</table>
<br>
<center>
<FORM METHOD="LINK" ACTION="index.php">
<INPUT TYPE="submit" VALUE="Log Out">
</FORM>
</center>
<br>

<?php
} else {
  echo "<p class='noticeMe'>$err</p>";
  echo <<<EOF
<form method="post" action="logged_in.php">
<p>
<table width=80% border=0 bgcolor="#009900" cellspacing=1 cellpadding=4 align="center">
 <tr bgcolor='#FFFFFF'>
  <td width='150' class='small'>Email</td>
  <td class='small'><input type='text' name='email' size='24' maxlength='31'></td>
 </tr>
 <tr bgcolor='#FFFFFF'>
  <td width='150' class='small'>Password</td>
  <td class='small'><input type='password' name='password' size='16' maxlength='31'></td>
 </tr>
 <tr bgcolor='#FFFFFF'>
  <td colspan='2' align='center'><input type='submit' value='Log In'></td>
 </tr>
</table>

EOF;
}
?>

<div style="height: 300px">&nbsp;</div>

<?php
include_once("gcc_footer.php");
?>
