<?php
include_once('db_verify.php');

// only the master should see this page
if(!$is_admin)
{
   $additionalHeader = <<<EOF
<link rel="stylesheet" type="text/css" href="style.css" />

EOF;
   include("../header.php");
   echo "<p><b>Sorry, you are not allowed to see this.</b></p>";
   include("../footer.php");
   exit(1);
}

$checkinId = $_GET['checkin'];
$checkoutId = $_GET['checkout'];
$paidId = $_GET['pay'];
$q_price = $_GET['price'];

$update_qry_base = "UPDATE Retreat_Participants SET lastupdate = CURRENT_TIMESTAMP, lastupdater = '$name',";
if(isset($checkinId))
{
  $update_qry = "$update_qry_base CheckInTime=DATE_ADD(NOW(), INTERVAL 3 HOUR) WHERE id=$checkinId";
} elseif(isset($checkoutId)) {
  $update_qry = "$update_qry_base CheckOutTime=DATE_ADD(NOW(), INTERVAL 3 HOUR) WHERE id=$checkoutId";
} elseif(isset($paidId) && isset($q_price)) {
  $update_qry = "$update_qry_base deposit=$q_price WHERE id=$paidId";
}

if(isset($update_qry)) {
  $update_res = mysql_query($update_qry);
  if ($update_res) {
    //successful update - show message
    $updateMessageHtml = "Successful update";
  } else {
    //unsuccessful update - show message
    $updateMessageHtml = "Unsuccessful update: " . mysql_error() . "($update_qry)";
  }
}
else {
  $updateMessageHtml = "<!--No update-->";
}


$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY id");

$js1 = <<<EOF
<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='100%'><tr bgcolor='#ffffff'><th>ID</th><th><a href="javascript:updateTable('name')">Name</a></th>  <th>Email</th> <th><a href="javascript:updateTable('sgl')">SG Leader?</\
a> [<a href="javascript:showCounts('SG Leader?', 13)">+</a>]</th>  <th>Room</th>  <th><a href="javascript:updateTable('checkedin')">Checked In?</a> [<a href="javascript:showCounts('Checked in?', 5)">+</a>]</th>  <th><a href="javascript:updateTable('checkedout')">Checked Out?</a> [<a href="javascript:showCounts('Checked Out?', 6)">+</a>]</th> <th><a href="javascript:updateTable('owed')">Owes</a> [<a href="javascript:showCounts('Owes', 8)">+</a>]</th> <th><a href="javascript:updateTable('nights')">Nights</a> [<a href="javascript:showCounts('Nights?', 10)">+</a>]</th> <th><a href="javascript:updateTable('harveycedars')">HC Nights</a> [<a href="javascript:showCounts('Nights in Harveycedars?', 12)">+</a>]</th> <th><a href="javascript:updateTable('Comments')">Comments</a></th></tr>
EOF;

$js1 = "var tbl_html_1 = '" . str_replace("'", "\\'", $js1) . "';\n";
$js1 .= "var tbl_row = new Array();\n";

$total = 0;
$totals = array();
$all_ids = array();
while ($row = mysql_fetch_assoc($res)) {
  $id = $row['id'];
  array_push($all_ids, $id);

  // need a roomnumber to check in
  $roomnumber = $row['roomnumber'];

  $sgleader = $row['sgleader'];
  if ($sgleader==1) {
    $sgl_html = 'Y';
  } else {
    $sgl_html = 'N';
  }


  $checkintime = $row['CheckInTime'];
  $checkouttime = $row['CheckOutTime'];

  $checkedIn = False;
  if($checkintime=='') {
    $checkinhtml = '<a href="checkin.php?checkin=' . $id . '">Check in</a>';
  } else {
    $checkedIn = True;
    $checkinhtml = "$checkintime";
  }

  $checkedOut = False;
  if($checkouttime=='') {
    if($checkedIn){
      $checkouthtml = '<a href="checkin.php?checkout=' . $id . '">Check out</a>';
    } else {
      $checkouthtml = 'Not checked in';
    }
  } else {
    $checkedOut = True;
    $checkouthtml = "$checkouttime";
  }

  $gender = $row['gender'];
  $myname = $row['fname'] .' '. $row['lname'];

  $price = $row['price'];
  $paid = $row['deposit'];
  $owed = $price - $paid;

  if($owed != 0) {
    $owedHtml = '<a href="checkin.php?pay=' . $id . '&price=' . $price . '">Pay $' . $owed . '</a>';
  } else {
    $owedHtml = Paid;
  } 

  $year = $row['class'];
  $shirtsize = $row['t-shirt'];

  if($checkedIn) {
    if($checkedOut) {
      $checkinpieces = explode(" ", $checkintime);
      $checkinDayStr = $checkinpieces[0] . " 00:00:00";
      $checkinDay = strtotime($checkinDayStr);
      $checkoutpieces = explode(" ", $checkouttime);
      $checkoutDayStr = $checkoutpieces[0] . " 00:00:00";
      $checkoutDay = strtotime($checkoutDayStr);
      $nNights = round(($checkoutDay-$checkinDay)/60/60/24);
      $nightshtml = (string)$nNights;
    } else {
      $nightshtml = "???";
    }
  } else {
    $nightshtml = "never checked in";
  }

  if($roomnumber=='') {
    $harveycedarshtml = "n/a";
  } else {
    $harveycedarshtml = $nightshtml;
  }

  $comments = $row['Comments'];

  
  // start writing the email and html text
  $my_email = $row['email'];
  $js1r_arr = array($gender, $id, str_replace("'","\\'",$myname), $my_email, $roomnumber, $checkinhtml, $checkouthtml, $owedHtml, $owed, $shirtsize, $nightshtml, str_replace("'","\\'",$comments), $harveycedarshtml, $sgl_html);

  $js1r = "tbl_row[$id] = ['".join("','", $js1r_arr)."'];\n";
  $js1 .= $js1r;

}


$js1 .= "var popup_window_done = ' [<a href=\'#\' onClick=\'hideOptions();\'>done</a>]';\n";
$js1 .= "var tbl_html_end = '</table>';\n";
$js1 .= "var all_ids = [".join(',',$all_ids)."];\n";

$js = <<<EOF
$js1

var ids = [];
var filtered_people_arr = [];

function showCounts(title, rowIndex)
{
  var assoc = {};
  for (x in filtered_people_arr)
  {
    var c_key = filtered_people_arr[x][rowIndex];
	c_key_str = c_key.toString();
	if (c_key_str in assoc)
	{
	  assoc[c_key_str]++;
	}
	else
	{
	  assoc[c_key_str] = 1;
	}
  }
  
  //sort by keys
  assoc = sortAssocArray(assoc)
  
  var totalCount = 0;
  var newHTML = title + popup_window_done + "<p class='small' style='text-align:left;'>";
  for (x in assoc) {
        newHTML += x + ' - ' + assoc[x] + '<br>';
	totalCount += assoc[x];
  }
  newHTML += '<p><b>Total - ' + totalCount + '</b></p>';
  document.getElementById('opts').innerHTML = newHTML;
  document.getElementById('opts').style.display = 'block';
}

function sortAssocArray(arr){
	// Setup Arrays
	var sortedKeys = new Array();
	var sortedObj = {};

	// Separate keys and sort them
	for (var i in arr){
		sortedKeys.push(i);
	}
	sortedKeys.sort();

	// Reconstruct sorted obj based on keys
	for (var i in sortedKeys){
		sortedObj[sortedKeys[i]] = arr[sortedKeys[i]];
	}
	return sortedObj;
}


function showOptions()
{
  document.getElementById('opts').innerHTML = popup_window_end;
  document.getElementById('opts').style.display = 'block';
}
function hideOptions()
{
  document.getElementById('opts').style.display = 'none';
}

function array_intersect(arr1,arr2)
{
  var arr2i=0;
  var arr2len=arr2.length;
  var newarr = new Array();
  var newarri = 0;
  for (x in arr1)
  {
    while (arr1[x] > arr2[arr2i]) {
      arr2i++;
      if (arr2i >= arr2len)
        return newarr;
    }
    if (arr1[x] == arr2[arr2i]) {
      newarr[newarri++] = arr1[x];
      arr2i++;
    }
  }
  return newarr;
}
function updateTable(sortName)
{
  ids = all_ids;
  
  // sort filtered IDs into filter_people_arr
  filtered_people_arr = [];
  for (x in ids)
  {
    filtered_people_arr.push(tbl_row[ids[x]]);
  }
  filtered_people_arr.sort(this['sortFunction_' + sortName]);
  
  // create html for filtered_people_arr
  var newHTML = tbl_html_1;
  for (x in filtered_people_arr)
  {
    var myrow = filtered_people_arr[x];
    newHTML += '<tr class="gender'+myrow[0]+'">'
	          + '<td><a href="edit_entry.php?gobackto=checkin&id='+myrow[1]+'">' + myrow[1] + '</a></td>'
			  + '<td><a href="edit_entry.php?gobackto=checkin&id='+myrow[1]+'">' + myrow[2] + '</a></td>'
			  + '<td><font color="blue">' + myrow[3] + '</font></td>'
                          + '<td>' + myrow[13] + '</td>'
			  + '<td>' + myrow[4] + '</td><td>' + myrow[5] + '</td><td>' + myrow[6] + '</td>'
			  + '<td>' + myrow[7] + '</td>'
                          + '<td>' + myrow[10] + '</td><td>' + myrow[12] + '</td>'
 			  + '<td>' + myrow[11] + '</td>';
  }
  newHTML += tbl_html_end;


  document.getElementById('TableDiv').innerHTML = newHTML;

}

//sorting functions
function sortFunction_id(personA, personB) { return personA[1] - personB[1]; }
function sortFunction_name(personA, personB) { return alphaSort(personA[2], personB[2]); }
function sortFunction_roomnumber(personA, personB) { return alphaSort(personA[4], personB[4]); }
function sortFunction_checkedin(personA, personB) { return alphaSort(personA[5], personB[5]); }
function sortFunction_checkedout(personA, personB) { return alphaSort(personA[6], personB[6]); }
function sortFunction_owed(personA, personB) { return alphaSort(personA[8], personB[8]); }
function sortFunction_nights(personA, personB) { return alphaSort(personA[10], personB[10]); }
function sortFunction_Comments(personA, personB) {return alphaSort(personA[11], personB[11]); }
function sortFunction_harveycedars(personA, personB) { return alphaSort(personA[12], personB[12]); }
function sortFunction_sgl(personA, personB) { return alphaSort(personA[13], personB[13]); }

function alphaSort(stringA, stringB)
{
   var strA = stringA.toLowerCase();
   var strB = stringB.toLowerCase();
   if (strA < strB)
   {
      return -1;
   }
   else if (strA > strB)
   {
      return 1;
   }
   return 0;
}

EOF;
$title = "Admin Interface";
$body_onload = "updateTable('id')";


$additionalHeader = <<<EOF
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#BigDiv
{
  width: 1200px; 
}

</style>
EOF;

include_once('../header.php');
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

<div style="border: 3px solid red; background: #ffffff url('http://www.hcbible.org/Portals/0/images/newskin/home_fulltop3.jpg') no-repeat right top;">
<b>Checkin procedure:</b><br>
<i>Ask Kevin if you have questions.</i><br>
<ol>
  <li>Check if they owe money (The "Owes" column), click "Pay \$XX" to pay</li>
  <!--li>If they are a small group leader, give them a packet.</li-->
  <li>Click "Check in" to check them in =)</li>
  <li>Tell them to:</li>
</ol>
   <ul>
    <li>pick up their nametag and retreat packet</li>
    <li>drop their stuff off in their rooms</li>
    <li>come back to the chapel to fellowship but <b>keep the registration area clear!</b></li>
   </ul>

</div>

$updateMessageHtml

<form name="FilterForm">

<div id="TableDiv" style="width:100%; margin: 0px; border: 1px solid black; background-color:#ffffff; overflow: auto;">
EOF;
echo "</div>\n";
echo "</form>\n";

include_once('../footer.php');
?>
