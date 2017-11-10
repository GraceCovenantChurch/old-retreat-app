<?php
include_once('nice_funcs.php');
include_once('db_verify.php');
include_once('sg-funcs.php');

  // only the master should see this page
if(!$is_admin)
{
   $extra_header = <<<EOF
<link rel="stylesheet" type="text/css" href="style.css" />

EOF;
   include("../header.php");
   echo "<p><b>Sorry, you are not allowed to see this.</b></p>";
   include("../footer.php");
   exit(1);
}
 
$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY fname");

$bigHash = array();

$all_ids = array();
while ($row = mysql_fetch_assoc($res)) {

  $smallgroup = $row['sg'];
  $sg = $smallgroup ? $smallgroup : 'None';

  if($bigHash[$sg]) {
    array_push($bigHash[$sg], $row);
  } else {
    $bigHash[$sg] = array($row);
  }

}
ksort($bigHash);

$extra_header = <<<EOF

<link rel="stylesheet" type="text/css" href="style.css" />

<style type="text/css">
#container {width: 960px; overflow: hidden;}
#counts {width: 98%}
.sg {
 width: 300px; 
 background-color: #dddddd;
 border: 2px solid black;
 float: left; 
 margin: 3px; 
}
.school, .comments, .track0, .track1, .track2, .track3, .track4, .track5, .track6, .track7, .track8 { font-size: 7pt; color: white; }
.school, .comments { color: black }
.M { color: blue }
.F { color: red }
.sg a { text-decoration: none;}
.sg a:hover {
 background-color: yellow;
}
.sg p { font-size: 10pt; margin: 0px; padding: 0px; }
</style>

EOF;
include_once("../header.php");

echo "<div id='container'>";

echo <<<EOF
<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<div align="center" class="popup" id="opts">
[<a href='#' onClick='hideOptions();'>done</a>]
</div>
EOF;

$count_str = "<p>";
foreach($bigHash as $sg => $arr) {
  $count_str .= $sg . " - " . count($arr) . " / ";
}
$count_str .= "</p>";

echo "<div id='counts' class='sg'>";
makeYellowHeader("Small Group Counts");
echo $count_str;
echo "</div>";

$i = 0;
foreach($bigHash as $sg => $arr) {
  $clear_str = ($i % 3)==0 ? "style='clear:left'" : "";
  $i++;
  echo "<div class='sg' $clear_str>";
  $sg_name = sg_to_name($sg);
  makeBlueHeader($sg_name . " [" . $sg . "] (" . count($arr) . ")</h1>");
  foreach($arr as $row) {
    $name = $row['fname'] . ' ' . $row['lname'];
    $gender = $row['gender']==1 ? 'M' : 'F';
    $leader = $row['sgleader']==1 ? '*' : '';
    $school = $row['school'];
    $class = $row['class'];
    $comments = $row['Comments'] ? "[<i>" . $row['Comments'] . "</i>]" : '';
    $id = $row['id'];
    $checked_in = $row['CheckInTime'] ? "<img src='http://amirevolution.com/images/small_checkmark.jpg' />" : "";
    $checked_out = $row['CheckOutTime'] ? "<img src='http://amirevolution.com/images/small_checkmark.jpg' />" : "";
    echo <<<EOF
  <p class="$gender"><a href="edit_entry.php?id=$id" target="_blank">_ </a>$name $leader $checked_in $checked_out <span class="school">($school - $class)</span> <span class="comments">$comments</span></p>
EOF;
  }
  echo "</div>";
}

echo "</div>";

include_once('../footer.php');
?>
