<?php
$title = "Sign Up";
include_once("db_fields.php"); // defines $fields

// check for ?fg at end
if($_GET['fg'] != NULL) {
  $fg_flag = True;
} else {
  $fg_flag = False;
}

$spamTime = time();
$js .= <<<EOF1
description = new Array(
  ""
);

function verifyForm()
{
  //Add hidden field to prevent spam
  document.forms.retreatForm.spamField.value = $spamTime;
  //alert(document.forms.retreatForm.spamField.value);

  if (document.forms.retreatForm.pass1.value != document.forms.retreatForm.pass2.value) {
    alert("Passwords must match.");
    return false;
  }
EOF1;
  foreach ($fields as $field) {
    $js .= "\n  if (document.forms.retreatForm['" .$field['name']. "'].value == \"\") {\n";
    $js .= "    alert(\"please enter a value for " .$field['desc']. ".\");\n";
    $js .= "    return false;\n  }";
  }
$js .= <<<EOF3
  
  return true;
}
EOF3;

include_once("gcc_header.php");

?>
<form method="post" action="signup_submitted.php" name="retreatForm" onsubmit="return verifyForm();">

<?php 

if($fg_flag) {
  echo <<<EOF
<h4><font color='red'>FG Signup</font></h4>
<div style="height: 200px">&nbsp;</div>
EOF;
} else {

  echo_tabs();

  echo <<<EOF

<p><b>Note: <font color="red">Online registration is only for paying with Paypal.</font></b>  Please sign up in person after Sunday service or with your family group leader if you wish to pay by cash or check.</p>

EOF;
}


?>

<table width=90% border=0 bgcolor="#2b2b2b" cellspacing=1 cellpadding=4 align="center">
<?php
$field_num = 0;
?>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Name</td><td class='small'><input type='text' name='fname' size='16' maxlength='31'>
 &nbsp;<input type='text' name='lname' size='16' maxlength='31'>
</td></tr>

<?php
if($fg_flag) {
  $rand_pw = rand_string(6);
  echo <<<EOF
  <input type='hidden' name='pass1' value='$rand_pw'>
  <input type='hidden' name='pass2' value='$rand_pw'>
  <input type='hidden' name='fg' value='True'>
EOF;
} else {
  echo <<<EOF
  <tr bgcolor='#FFFFFF'><td width='150' class='small'>Password</td><td class='small'><input type='password' name='pass1' size='16' maxlength='31'>
 Again: &nbsp;<input type='password' name='pass2' size='16' maxlength='31'>
</td></tr>
EOF;
}

?>

<tr bgcolor='#FFFFFF'><td width='150' class='small'>Gender</td><td class='small'><SELECT name='gender'><OPTION value=""> </OPTION><OPTION value="1">Male</OPTION><OPTION value="2">Female</OPTION></SELECT>
</td></tr>
<tr bgcolor='#FFFFFF'>
  <td width='150' class='small'>School</td>
  <td class='small'>
    <SELECT name='school'>
      <OPTION value=""> </OPTION>
      <OPTION value="BRY">Bryn Mawr</OPTION>
      <OPTION value="DRE">Drexel</OPTION>
      <OPTION value="EAS">Eastern</OPTION>
      <OPTION value="HAV">Haverford</OPTION>
      <OPTION value="MOR">Moore</OPTION>
      <OPTION value="PAF">PAFA</OPTION>
      <OPTION value="SWT">Swarthmore</OPTION>
      <OPTION value="TEM">Temple</OPTION>
      <OPTION value="PEN">UPenn</OPTION>
      <OPTION value="USP">USciences</OPTION>
      <OPTION value="NOV">Villanova</OPTION>
      <OPTION value="OTH">Other</OPTION>
    </SELECT>
  </td>
</tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Email Address</td><td class='small'><input type='text' name='email' size='24' maxlength='31'>
</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Cell Phone</td><td class='small'><input type='text' name='cphone' size='12' maxlength='14'>

</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Class</td><td class='small'><SELECT name='class'><OPTION value=""> </OPTION><OPTION value="2017">2017</OPTION><OPTION value="2018">2018</OPTION><OPTION value="2019">2019</OPTION><OPTION value="2020">2020</OPTION><OPTION value="other">Other</OPTION></SELECT>
  </td></tr>
 <tr bgcolor="#FFFFFF">
  <td colspan="2" align="center"><input name="submit" type="submit" value="Continue"></td>
 </tr>
</table>
	<input type="hidden" name="deposit" value=-1>
        <input type="hidden" name="spamField" value=0>
</form>
<p>Questions?  Email <font color="blue">retreatstaff@gracecovenant.net</font></p>
<div style="height: 280px">&nbsp;</div>
<?php
include_once("gcc_footer.php");
?>
