<?php
include_once('db_verify.php');
$backto = (empty($_GET['gobackto'])) ? 'index' : $_GET['gobackto'];

$extra_header = "<meta http-equiv=\"refresh\" content=\"1;url=$backto.php\" />";
$title = "Admin Interface";
include_once('../header.php');
$info_changed = "";
$changed_fields = array();
$entryid = $_POST['entryid'];
if ($_POST['submit']) {
  $qry = "SELECT * FROM Retreat_Participants WHERE id=$entryid";
  $res = mysql_query($qry);
  $field_types = get_field_types($res);
  $entry = mysql_fetch_assoc($res);
  foreach ($_POST as $key => $val)
  {
    if ($val == "") {
      continue;
    }
    if ($key == 'pass2' || $key == 'entryid' || $key == 'submit') {
      continue;
    }
    if ($key == 'pass1') {
      $val = md5($val);
      $key = 'password';
    }
    if ($val != $entry[$key]) {
      $changed_fields[$key] = $val;
    }
  }
  if (count($changed_fields)==0) {
    echo "No fields changed.";
  } else {
    $qry = "UPDATE Retreat_Participants SET lastupdate = CURRENT_TIMESTAMP, lastupdater = '$name', ";
    foreach ($changed_fields as $k => $v)
    {
      if ($field_types[$k] == "string" || $field_types[$k] == "blob" || $k == "comments") {
        $v = "'".escape_string($v)."'";
      }
      $qry .= "$k = $v, ";
    }
    $qry = substr($qry,0,-2);
    $qry .= " WHERE id=$entryid";
    echo "<!-- $qry -->";
    $res = mysql_query($qry);
    if ($res) {
      $info_changed = "Info changed.  Wait a sec...";
    } else {
      $info_changed = "Error: " .mysql_error()."\n";
    }
  }
}

echo <<<EOF

<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<br>$info_changed<br>

EOF;

include_once('../footer.php');
?>
