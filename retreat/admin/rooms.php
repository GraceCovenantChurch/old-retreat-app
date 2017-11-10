<?php
include_once('nice_funcs.php');
include_once('db_verify.php');

// only admin should see this page
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

// make rooms to people hash
$bigHash = array();
$all_ids = array();
while ($row = mysql_fetch_assoc($res)) {

  $roomnumber = $row['roomnumber'];
  $room = $roomnumber ? $roomnumber : 'Not Assigned Yet';

  if($bigHash[$room]) {
    array_push($bigHash[$room], $row);
  } else {
    $bigHash[$room] = array($row);
  }

}
ksort($bigHash);

// make floor to rooms hash
function room_to_floor($room) {
  if(preg_match('/^Captains/', $room)) {
    return "Captains Deck - Brothers";
  } elseif(preg_match('/^Chapel/', $room)) {
    return "Chapel Dorm - Brothers";
  } elseif(preg_match('/^Poolside/', $room)) {
    return "Poolside Lounge - Sisters";
  } elseif(preg_match('/^Hotel 3/', $room)) {
    return "Hotel 3rd Floor - Sisters";
  } else {
    return "_Other";
  }
}

$floors = array();
foreach($bigHash as $room => $people) {

  $floor = room_to_floor($room);
  if($floors[$floor]) {
    array_push($floors[$floor], $room);
  } else {
    $floors[$floor] = array($room);
  }

}
ksort($floors);



$extra_header = <<<EOF

<link rel="stylesheet" type="text/css" href="style.css" />

<style type="text/css">
.floor {overflow: hidden; padding-right: 10px; margin-right: -8px; margin-left: -8px;}
.room, .counts {
 width: 290px; 
 background-color: #dddddd;
 border: 2px solid black;
 float: left; 
 margin: 3px; 
}
.counts {width: 98%}
.school, .comments, .sem0, .sem1, .sem2, .sem3, .sem4 { font-size: 7pt; color: white; }
.school, .comments { color: black }
.M { color: blue }
.F { color: red }
.room a { text-decoration: none;}
.room a:hover {
 background-color: yellow;
}
.sg_Older, .sg_Staff, .sg_Coords, .sg_Band { background-color: black; }
.sg_B01, .sg_B06, .sg_B11, .sg_G01, .sg_G06, .sg_G11, .sg_G16 { background-color: red }
.sg_B02, .sg_B07, .sg_B12, .sg_G02, .sg_G07, .sg_G12, .sg_G17 { background-color: orange }
.sg_B03, .sg_B08, .sg_B13, .sg_G03, .sg_G08, .sg_G13, .sg_Band { background-color: blue }
.sg_B04, .sg_B09, .sg_B14, .sg_G04, .sg_G09, .sg_G14, .sg_G18 { background-color: green }
.sg_B05, .sg_B10, .sg_B15, .sg_G05, .sg_G10, .sg_G15, .sg_Intl { background-color: purple }
.sg_B01, .sg_B06, .sg_B11, .sg_G01, .sg_G06, .sg_G11, .sg_G16, .sg_B02, .sg_B07, .sg_B12, .sg_G02, .sg_G07, .sg_G12, .sg_G17, .sg_B03, .sg_B08, .sg_B13, .sg_G03, .sg_G08, .sg_G13, .sg_B04, .sg_B09, .sg_B14, .sg_G04, .sg_G09, .sg_G14, .sg_B05, .sg_B10, .sg_B15, .sg_G05, .sg_G10, .sg_G15, .sg_Staff, .sg_Coords, .sg_Band, .sg_Older, .sg_G18, .sg_Intl { color: white; font-size: 7pt; }
.sg p { font-size: 10pt; margin: 0px; padding: 0px; }
.sgspan { color: black; font-size: 7pt; }
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


foreach($floors as $floor => $rooms) {

  $count_str = "<p>";
  foreach($rooms as $room) {
    $people = $bigHash[$room];
    $count_str .= $room . " - " . count($people) . " / ";
  }
  $count_str .= "</p>";

  echo "<div class='floor'>";
  makeGrayHeader($floor);

  echo "<div class='counts'>";
  makeYellowHeader("Room Counts (" . count($rooms) . " rooms)");
  echo $count_str;
  echo "</div>";

  $i = 0;
  foreach($rooms as $room) {
    $people = $bigHash[$room];
    $clear_str = ($i % 3)==0 ? "style='clear:left'" : "";
    $i++;
    echo "<div class='room' $clear_str>";
    makeBlueHeader($room . " (" . count($people) . ")</h1>");
    foreach($people as $row) {
      $name = $row['fname'] . ' ' . $row['lname'];
      $gender = $row['gender']==1 ? 'M' : 'F';
      $leader = $row['sgleader']==1 ? '*' : '&nbsp;';
      $school = $row['school'];
      $class = $row['class'];
      $comments = $row['Comments'] ? "[<i>" . $row['Comments'] . "</i>]" : '';
      $id = $row['id'];
      $sg = $row['sg'];
      $checked_in = $row['CheckInTime'] ? "<img src='http://amirevolution.com/images/small_checkmark.jpg' />" : "";
      $checked_out = $row['CheckOutTime'] ? "<img src='http://amirevolution.com/images/small_checkmark.jpg' />" : "";
      echo <<<EOF
  <p><a href="edit_entry.php?id=$id" target="_blank">_ </a><span class="$gender">$name $leader $checked_in $checked_out </span><span class="sg_$sg">$sg</span> <span class="school"> ($school - $class)</span> <span class="comments">$comments</span></p>
EOF;
    }
    echo "</div>";
  }

  echo "</div>";
}

echo "</div>";

include_once('../footer.php');
?>
