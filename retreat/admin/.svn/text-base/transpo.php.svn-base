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

$way = $_GET['way'];
if($way == "to") {
  $field = "transpo_to";
  $desc = "Transpo To HC";  
} elseif($way == "back") {
  $field = "transpo_back";
  $desc = "Transpo Back to Philly";
} else {
  die("Specify way");
}
 
$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY fname");

// make rooms to people hash
$bigHash = array();
$all_ids = array();
while ($row = mysql_fetch_assoc($res)) {

  $trans = $row[$field];
  $transpo = $trans ? $trans : 'Not Assigned Yet';

  if($bigHash[$transpo]) {
    array_push($bigHash[$transpo], $row);
  } else {
    $bigHash[$transpo] = array($row);
  }

}
ksort($bigHash);

// make type to transpos hash
function transpo_to_type($transpo, $way) {
  if(preg_match('/^Kevin/', $transpo)) {
    return "Coords";
  } elseif(preg_match('/^Priscila/', $transpo)) {
    return "Coords";
  } elseif(preg_match('/^UC Bus/', $transpo)) {
    return "UC";
  } elseif(preg_match('/^White/', $transpo)) {
    return "UC";
  } elseif(preg_match('/^Aerin/', $transpo)) {
    return $way=="to" ? "UC - 6pm" : "UC";
  } elseif(preg_match('/^ML Bus/', $transpo)) {
    return "Mainline";
  } elseif(preg_match('/^Temple Van/', $transpo)) {
    return "Temple";
  } elseif(preg_match('/^Band/', $transpo)) {
    return "Band";
  } elseif(preg_match('/^Ann/', $transpo)) {
    return $way=="to" ? "Band" : "Band - Sun early";
  } elseif(preg_match('/^Chad/', $transpo)) {
    return "Band";
  } elseif(preg_match('/^Charles/', $transpo)) {
    return $way=="to" ? "Band" : "Band - Sun early";
  } elseif(preg_match('/^Gloria/', $transpo)) {
    return $way=="to" ? "Band" : "Band - Sat night";
  } elseif(preg_match('/^John/', $transpo)) {
    return "Band";
  } elseif(preg_match('/^PJoe/', $transpo)) {
    return $way=="to" ? "Staff" : "Staff - Sat afternoon";
  } elseif(preg_match('/^PYohan/', $transpo)) {
    return $way=="to" ? "Staff" : "Staff - Sat 12pm";
  } elseif(preg_match('/^P/', $transpo)) {
    return "Staff";
  } else {
    return "_Other";
  }
}

$types = array();
foreach($bigHash as $transpo => $people) {

  $type = transpo_to_type($transpo, $way);
  if($types[$type]) {
    array_push($types[$type], $transpo);
  } else {
    $types[$type] = array($transpo);
  }

}
ksort($types);



$extra_header = <<<EOF

<link rel="stylesheet" type="text/css" href="style.css" />

<style type="text/css">
.type {overflow: hidden; padding-right: 10px; margin-right: -8px; margin-left: -8px;}
.transpo, .counts {
 width: 320px; 
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
.transpo a { text-decoration: none;}
.transpo a:hover {
 background-color: yellow;
}
.sg_Older, .sg_Staff, .sg_Coords, .sg_Band { background-color: black; }
.sg_B01, .sg_B06, .sg_B11, .sg_G01, .sg_G06, .sg_G11, .sg_G16 { background-color: red }
.sg_B02, .sg_B07, .sg_B12, .sg_G02, .sg_G07, .sg_G12, .sg_G17 { background-color: orange }
.sg_B03, .sg_B08, .sg_B13, .sg_G03, .sg_G08, .sg_G13, .sg_Band { background-color: blue }
.sg_B04, .sg_B09, .sg_B14, .sg_G04, .sg_G09, .sg_G14, .sg_G18 { background-color: green }
.sg_B05, .sg_B10, .sg_B15, .sg_G05, .sg_G10, .sg_G15, .sg_G19, .sg_Intl { background-color: purple }
.sg_B01, .sg_B06, .sg_B11, .sg_G01, .sg_G06, .sg_G11, .sg_G16, .sg_B02, .sg_B07, .sg_B12, .sg_G02, .sg_G07, .sg_G12, .sg_G17, .sg_B03, .sg_B08, .sg_B13, .sg_G03, .sg_G08, .sg_G13, .sg_B04, .sg_B09, .sg_B14, .sg_G04, .sg_G09, .sg_G14, .sg_B05, .sg_B10, .sg_B15, .sg_G05, .sg_G10, .sg_G15, .sg_Staff, .sg_Coords, .sg_Band, .sg_Older, .sg_Intl, .sg_G18, .sg_G19 { color: white; font-size: 7pt; }
.sg p { font-size: 10pt; margin: 0px; padding: 0px; }
.sgspan { color: black; font-size: 7pt; }
.person { padding: 1px }
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

<h2 style="background-color: yellow">$desc</h2>
EOF;


foreach($types as $type => $transpos) {

  $count_str = "<p>";
  foreach($transpos as $transpo) {
    $people = $bigHash[$transpo];
    $count_str .= $transpo . " - " . count($people) . " / ";
  }
  $count_str .= "</p>";

  echo "<div class='type'>";
  makeGrayHeader($type);

  echo "<div class='counts'>";
  makeYellowHeader("Transpo Counts (" . count($transpos) . " transpos)");
  echo $count_str;
  echo "</div>";

  $i = 0;
  foreach($transpos as $transpo) {
    $people = $bigHash[$transpo];
    $clear_str = ($i % 3)==0 ? "style='clear:left'" : "";
    $i++;
    echo "<div class='transpo' $clear_str>";
    makeBlueHeader($transpo . " (" . count($people) . ")</h1>");
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
  <div class="person"><a href="edit_entry.php?id=$id" target="_blank">_ </a><span class="$gender">$name $leader $checked_in $checked_out </span><span class="sg_$sg">$sg</span> <span class="school"> ($school - $class)</span> <span class="comments">$comments</span></div>
EOF;
    }
    echo "</div>";
  }

  echo "</div>";
}

echo "</div>";

include_once('../footer.php');
?>
