<?php

include_once('db_verify.php');
include_once('../db_connect.php');

include_once('sg-funcs.php');

if(empty($_GET)) {
    $emptyGet = True;
    echo <<<HERE
Please specify some parameters.  For example:<br>
<ul>
  <li>?id=9</li>
  <li>?sg='B01'</li>
  <li>?sg='B01','B02'</li>
</ul>

HERE;
    exit(1);
}

function get_nametag_label_html($row, $i) {
  $sg_str = sg_to_name($row['sg']);
  if ($i>1) {
//     $marginStr = 'style="margin-top: 1.00in"';
     $marginStr = "";
  } else {
     
     $marginStr	= 'style="margin-top: 1.00in"';
  }
  return <<<LABEL
<div class='label' $marginStr>
  <h1>$row[fname] $row[lname]</h1>
  <h2><i>$sg_str</i></h2>
  <h3>$row[roomnumber]</h3>
</div>
LABEL;
  // return "<div class='label'>$row[fname]</div>";
}

// build up mysql string 
$mysql_str = "select fname,lname,sg,roomnumber from Retreat_Participants where ";
$first = True;
foreach($_GET as $name => $value) {
  if($first) {
    $first = False;
  } else {
     $mysql_str .= " and ";
  }
  $mysql_str .= htmlspecialchars($name) . " in (" . $value . ")";
}
$mysql_str .= " order by fname";

// get rows
$res = mysql_query($mysql_str);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GCC Retreat Name Tags: <?php echo $mysql_str; ?></title>
    <link href="labels.css" rel="stylesheet" type="text/css" >
    <style>
    body {
        width: 8.5in;
	/*margin-left: 0.25in;*/
        }
    .label{
        /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
        width: 50%; /* plus .6 inches from padding */
        height: 2.500in; /* plus .25 inches from padding */
        padding: .50in .0in 0in 0in;
        margin: 0in; /* the gutter */
/*	margin-top: .625in;*/

        float: left;

        text-align: center;
        overflow: hidden;

        outline: 1px dotted white; /* outline doesn't occupy space like border does */
        }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
        }
    .spacer {
        height: 0.625in;
    }
    h1,h2,h3 {
        font-family: Georgia;
    }
    h1 {
        font-size: 200%;
        font-weight: 900;
    }
    h2 {
       font-size: 150%;
    }
    h3 {
       font-weight: normal;
    } 
    </style>

</head>
<body>

<?php
// figure out line break after?  or limit to eight
$i = 0;
while ($row = mysql_fetch_assoc($res)) {
//  if ($i==2 || $i==4) {
//    echo '<div class="spacer">&nbsp;</div>';
//  }
  echo get_nametag_label_html($row, $i);
  if ($i==5) {
    $i = 0;
    echo '<div class="page-break"></div>';
  } else {
    $i += 1;
  } 
}

?>


</body>
</html>

