<?php

include_once('../db_connect.php');

$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY fname, class");
$i = 0;
$nBoys = 0;
$nGirls = 0;
$people = "";

while ($row = mysql_fetch_assoc($res)) 
{
	$p_name = $row['fname'] . ' ' . $row['lname'];
	$p_paid = $row['deposit'];
	$p_price = $row['price'];
	$p_school = $row['school'];
	if($p_paid == 0 && $p_price != 0)
	{
	    $p_deposit = 'N';
	}
	else
	{
	    $p_deposit = 'Y';
	}

    //create Javascript  arrays
    $person = 'people[' . $i . '] = {'
	          . 'name:"' . $p_name . '",'
			  . 'deposit:"' . $p_deposit . '",'
			  . 'school:"' . $p_school . '"'
			  . '};';
	
	//add break
	$people = <<<EOF
$people
$person
EOF;

	$i++;
}

//set Javascript
$js = <<<EOF

var people = new Array();
$people

var tableBegin = "<table bgcolor='#ffffff' border=1 cellspacing=2 cellpadding=4 align='center'>";
var headerRow = '<tr bgcolor="#ffffff">'
			  + '<td><a href="javascript:updateTable(\'name\')">Name</a></td>'
			  + '<td>Paid Deposit</td>'
			  + '<td><a href="javascript:updateTable(\'school\')">School</a></td>'
			  + '</tr>';
var tableEnd = "</table>";

//sorts people by header
function updateTable(header)
{
    //call specific sort function
    people.sort(this['sortFunction_' + header]);
	
	//get new html for the table
    var newHtml = tableBegin + headerRow;
	for(i in people)
	{
		person = people[i];
	    newHtml += '<tr>'
	           + '<td>' + person.name + '</td>'
			   + '<td>' + person.deposit + '</td>'
			   + '<td>' + person.school + '</td>' 
			   + '</tr>';
	}
	newHtml += tableEnd;
	
	//replace html
    document.getElementById('TableDiv').innerHTML = newHtml;
}


//sorting functions
function sortFunction_name(personA, personB)
{
   return alphaSort(personA.name, personB.name);
}

function sortFunction_school(personA, personB)
{
   return alphaSort(personA.school, personB.school);
}

//general sorting functions
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
$body_onload = "updateTable('school')";
include_once('../header.php');
echo <<<EOF

<div align="center" id="TableDiv" style="margin: 0px; overflow:auto;">
</div>

EOF;

include_once('../footer.php');
?>
