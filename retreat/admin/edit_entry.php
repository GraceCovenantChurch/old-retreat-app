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
  $qry = "UPDATE Coordinators SET name='".escape_string($_POST['name'])."', email='".escape_string($_POST['email']).$pass_update." WHERE email='".escape_string($email)."'";
  echo "<!-- $qry -->";
  $res = mysql_query($qry);
  if ($res) {
    $email = $_POST['email'];
    $_SESSION['USER'] = $email;
    if ($_POST['pass1']) {
      $_SESSION['PASS'] = md5($_POST['pass1']);
    }
  } else {
    $info_changed = "Error: ".mysql_error()."\n";
  }
}
$entryid = $_GET['id'];
$qry = "SELECT * FROM Retreat_Participants WHERE id=$entryid";
$res = mysql_query($qry);
$entry = mysql_fetch_assoc($res);

$entry = array_map("htmlspecialchars", $entry);
echo "<!-- "; print_r($entry); echo "-->";

$backto = (empty($_GET['gobackto'])) ? 'index' : $_GET['gobackto'];

echo <<<EOF

<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

$info_changed<br>

<form method="post" name = "infoForm" action="editentry_submit.php?gobackto=$backto" onsubmit="return verifyForm();">
<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='500'>
EOF;

include_once("../db_fields.php");
$fields = $edit_fields;

foreach ($fields as $field)
{
	  if ($field_num > 0) {
		if (!$field['join']) {
		  echo "</td></tr>\n";
		}
	  }
	  if (!$field['join']) {		  
			if($field['name'] == "church" ){
				echo "<tr bgcolor='#FFFFFF'><td width='150' class='small'> School </td><td class='small'>";
			}else{
				echo "<tr bgcolor='#FFFFFF'><td width='150' class='small'>" .$field['desc']. "</td><td class='small'>";
			}
	  } else {
		echo $field['join'];
	  }
	  if ($field['type'] == 'text' || $field['type'] == 'password') {
		echo "<input type='" .$field['type']. "' name='" .$field['name']. "'";
		foreach ($field['extra'] as $key => $value) {
		  echo " $key='" . $value . "'";
		}
		echo " value=\"" . htmlspecialchars($entry[$field['name']]) . "\"";
		echo ">";
	  } elseif ($field['type'] == 'select' || $field['type'] == 'select_num') {
		echo "<SELECT name='" .$field['name']. "' onChange=\"changeSelectCallback('" .$field['name']. "')\">";
		foreach ($field['extra'] as $key => $value) {
		  if ($entry[$field['name']]==$value) {
			$chkd = " SELECTED";
		  } else {
			$chkd = "";
		  }
		  echo "<OPTION value=\"$value\"$chkd>$key</OPTION>";
		}
		echo "</SELECT>";
	  }
	  echo "\n";
}

$deposit = $entry['deposit'];
$comments = $entry['Comments'];
$price = $entry['price'];
echo <<<EOF
<tr bgcolor='#FFFFFF'><td width='150' class='small'>Payment</td>
 <td class='small'>Deposit: <input type='text' name='deposit' size="6" value="$deposit"> &nbsp; &nbsp; Price: <input type='text' name='price' size="6" value="$price"><input type='hidden' name='entryid' value='$entryid'></tr>

<tr bgcolor='#FFFFFF'><td colspan='2' class='small' align='center'><input type='submit' name='submit' value='submit'></td>
</table>
</form>
EOF;

include_once('../footer.php');
?>
