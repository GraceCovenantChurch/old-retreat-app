<?php
include_once('db_verify.php');

// only the master should see this page
if(!$is_admin)
{
   $additionalHeader = <<<EOF
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="stylesheet" type="text/css" href="style.css" />

EOF;
   include("../header.php");
   echo "<p><b>Sorry, you are not allowed to see this.</b></p>";
   include("../footer.php");
   exit(1);
}


$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY sg,sgleader,class");

$js1 = <<<EOF
<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='100%'><tr bgcolor='#ffffff'><th>ID</th><th><a href="javascript:updateTable('name')">Name</a></th>  <th><a href="javascript:updateTable('sgl')">SG Leader?</a> [<a href="javascript:showCounts('SG Leader?', 3)">+</a>]</th>  <th><a href="javascript:updateTable('sg')">SG</a> [<a href="javascript:showCounts('SG', 4)">+</a>]</th> <th><a href="javascript:updateTable('room')">Room</a> [<a href="javascript:showCounts('Room', 5)">+</a>]</th> <th><a href="javascript:updateTable(\
'school')">School</a> [<a href="javascript:showCounts('School', 6)">+</a>]</th> <th><a href="javascript:updateTable('year')">Class</a> [<a href="javascript:showCounts('Class', 7)">+</a>]</th>  <th><a href="javascript:updateTable('Comments')">Comments</a> [<a href="javascript:showCounts('Comments', 8)">+</a>]</th></tr>
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

  $sg = $row['sg'];

  $gender = $row['gender'];
  $myname = $row['fname'] .' '. $row['lname'];

  $school = $row['school'];
  $year = $row['class'];

  $comments = $row['Comments'];

  
  // start writing the email and html text
  $js1r_arr = array($gender, $id, str_replace("'","\\'",$myname), $sgl_html, $sg, $roomnumber, $school, $year, str_replace("'","\\'",$comments));

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
	          + '<td><a href="edit_entry.php?gobackto=smallgroup&id='+myrow[1]+'">' + myrow[1] + '</a></td>'
			  + '<td><a href="edit_entry.php?gobackto=smallgroup&id='+myrow[1]+'">' + myrow[2] + '</a></td>'
			  + '<td>' + myrow[3] + '</td>'
                          + '<td>' + myrow[4] + '</td>'
			  + '<td>' + myrow[5] + '</td>'
			  + '<td>' + myrow[6] + '</td>'
                          + '<td>' + myrow[7] + '</td>'
                          + '<td>' + myrow[8] + '</td>';
  }
  newHTML += tbl_html_end;


  document.getElementById('TableDiv').innerHTML = newHTML;

}

//sorting functions
function sortFunction_id(personA, personB) { return personA[1] - personB[1]; }
function sortFunction_name(personA, personB) { return alphaSort(personA[2], personB[2]); }
function sortFunction_sgl(personA, personB) { return alphaSort(personA[3], personB[3]); }
function sortFunction_sg(personA, personB) { return alphaSort(personA[4], personB[4]); }
function sortFunction_room(personA, personB) { return alphaSort(personA[5], personB[5]); }
function sortFunction_school(personA, personB) { return alphaSort(personA[6], personB[6]); }
function sortFunction_year(personA, personB) { return alphaSort(personA[7], personB[7]); }
function sortFunction_Comments(personA, personB) {return alphaSort(personA[8], personB[8]); }

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
$body_onload = "updateTable('sg')";


$additionalHeader = <<<EOF
<link rel="stylesheet" type="text/css" href="../style.css" />
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

$updateMessageHtml

<form name="FilterForm">

<div id="TableDiv" style="width:100%; margin: 0px; border: 1px solid black; background-color:#ffffff; overflow: auto;">
EOF;
echo "</div>\n";
echo "</form>\n";

include_once('../footer.php');
?>
