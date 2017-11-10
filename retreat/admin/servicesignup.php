<?php
$title = "Sign Up";
include_once("../db_fields.php"); // defines $fields
include_once("db_verify.php");
include_once("../prices_inc.php")
$price = prices_get_cost_and_expl($explanation, $expl_ascii, $_POST['school']);

$js .= <<<EOF1
description = new Array(

  ""
);


function verifyForm()
{
  if (document.forms.retreatForm.pass1.value != document.forms.retreatForm.pass2.value) {
    alert("Passwords must match.");
    return false;
  }
EOF1;
  foreach ($fields as $field) {
    $js .= "\n  if (document.forms.retreatForm['" .$field['name']. "'].value == \"\"";
    $js .= ") {\n";
    $js .= "    alert(\"Please enter a value for " .$field['desc']. ".\");\n";
    $js .= "    return false;\n  }";
  }
$js .= <<<EOF3
  return true;
}
EOF3;
$body_onload = "maybeDisableExtras()";
include_once("../header.php");

// $fields: 0..N indexed array of fields stored in Participants
//    $fields[i]: string indexed array describing a field:
//       ['name']: name in form and database
//       ['desc']: short description for display purposes
//       ['type']: { text, select, select_num, check }
//       ['extra']: string indexed array, differs depending on type.

?>
<form method="post" action="servicesignup_submitted.php" name="retreatForm" onsubmit="return verifyForm();">
<center style="font-size:18px">Sign up for GCC College Retreat 2018!</center>
<center style="font-size:12px"> Early bird (12/18) $90; Regular (12/19-1/15) $105; Late price $120</center>
<p>
<table width=80% border=0 bgcolor="#2b2b2b" cellspacing=1 cellpadding=4 align="center">
<?php
$field_num = 0;
?>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Name</td><td class='small'>First Name <input type='text' name='fname' size='16' maxlength='31' required>
 &nbsp; Last Name <input type='text' name='lname' size='16' maxlength='31'required>
</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Gender</td><td class='small'><SELECT name='gender' required><OPTION value=""> </OPTION><OPTION value="1">Male</OPTION><OPTION value="2">Female</OPTION></SELECT>
</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Email Address</td><td class='small'><input type='text' name='email' size='24' maxlength='31' required>
</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Cell Phone</td><td class='small'><input type='text' name='cphone' size='12' maxlength='14' required>

</td></tr>
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Class</td><td class='small'><SELECT name='class'><OPTION value=""> </OPTION><OPTION value="2018">2018</OPTION><OPTION value="2019">2019</OPTION><OPTION value="2020">2020</OPTION><OPTION value="2021">2021</OPTION><OPTION value="other">Other</OPTION></SELECT>
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
  <tr bgcolor='#FFFFFF'><td width='150' class='small'>Payment Amount</td><td class='small'>
<input type="radio" name="deposit" value=105 checked="true" required> $105 <?php echo(prices_get_cost_and_expl($explanation, $expl_ascii, $_POST['school'])); ?> <input type="radio" name ="deposit" value=1> Financial Aid Required
</td></tr>
 <tr bgcolor="#FFFFFF">
  <td colspan="2" align="center"><input name="submit" type="submit" value="Submit"></td>
 </tr>

</table>
	<input type="hidden" name="pass1" value="0">
    <input type="hidden" name="pass2" value="0">
</form>
<?php

include_once("../footer.php");
?>
