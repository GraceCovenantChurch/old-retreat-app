<?php

include_once('db_verify.php');

$res = mysql_query("SELECT *, count(*) FROM Retreat_Participants GROUP BY fname, lname HAVING count(*)>1 ORDER BY count(*) DESC");
$i = 0;
$nBoys = 0;
$nGirls = 0;
$people = "";

while ($row = mysql_fetch_assoc($res)) 
{
    $p_id = $row['id'];
	$p_name = $row['fname'] . ' ' . $row['lname'];
	$p_email = $row['email'];
    $p_gender = $row['gender'];
	$p_paid = $row['deposit'];
	$p_price = $row['price'];
	$p_owed = $p_price - $p_paid;
	$p_signuptime = substr($row['signuptime'],0,strpos($row['signuptime'],' '));

    //create Javascript  arrays
    $person = 'people[' . $i . '] = {'
			  . 'id:' . $p_id . ','
	          . 'name:"' . $p_name . '",'
			  . 'email:"' . $p_email . '",'
			  . 'gender:"' . $p_gender . '",'
			  . 'paid:' . $p_paid . ','
			  . 'price:' . $p_price . ','
			  . 'owed:' . $p_owed . ','
			  . 'signup:"' . $p_signuptime . '"'
			  . '};';
	
	//add break
	$people = <<<EOF
$people
$person
EOF;

    //count boys and girls
    if($p_gender == "1")
	{
	    $nBoys++;
	}
	else
	{
	    $nGirls++;
	}
	$i++;
}
$total = $i;

//set Javascript
$js = <<<EOF

var people = new Array();
$people

var tableBegin = "<table bgcolor='#009900' border=0 cellspacing=2 cellpadding=4 width='100%' align='center'><tr bgcolor='#ffffff'>";
var headerRow = '<tr bgcolor="#ffffff">' + '<td><a href="javascript:updateTable(\'id\')">ID</a></td>'
			  + '<td><a href="javascript:updateTable(\'name\')">Name</a></td>'
			  + '<td><a href="javascript:updateTable(\'email\')">Email</a> [<a href="javascript:showEmails()">list</a>]</td>'
			  + '<td><a href="javascript:updateTable(\'paid\')">Paid</a> / <a href="javascript:updateTable(\'price\')">Price</a></td>'
			  + '<td><a href="javascript:updateTable(\'owed\')">Owed</a></td>'
			  + '<td><a href="javascript:updateTable(\'signup\')">Last Updated</a></td>'
			  + '</tr>';
var tableEnd = "</table>";

//sorts people by header
function updateTable(header)
{
    //call specific sort function
    people.sort(this['sortFunction_' + header]);;
	
	//get new html for the table
    var newHtml = tableBegin + headerRow;
	for(i in people)
	{
		person = people[i];
	    newHtml += '<tr class="gender' + person.gender + '">'
			   + '<td>' + person.id + '</td>'
	           + '<td><a href="edit_entry.php?id=' + person.id + '">' + person.name + '</a></td>'
			   + '<td>' + person.email + '</td>' 
			   + '<td>' + person.paid + ' / ' + person.price + '</td>'
	           + '<td>' + person.owed + '</td>'
			   + '<td>' + person.signup + '</td>' 
			   + '</tr>';
	}
	newHtml += tableEnd;
	
	//replace html
    document.getElementById('TableDiv').innerHTML = newHtml;
}


//sorting functions
function sortFunction_id(personA, personB)
{
   return personA.id - personB.id;
}

function sortFunction_name(personA, personB)
{
   return alphaSort(personA.name, personB.name);
}

function sortFunction_email(personA, personB)
{
   return alphaSort(personA.email, personB.email);
}

function sortFunction_paid(personA, personB)
{
   return personA.paid - personB.paid;
}

function sortFunction_price(personA, personB)
{
   return personA.price - personB.price;
}

function sortFunction_owed(personA, personB)
{
   return personA.owed - personB.owed;
}

function sortFunction_signup(personA, personB)
{
   return alphaSort(personA.signup, personB.signup);
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

//opens popup and lists emails
function showEmails()
{
    var emailHtml = "<b>Email addresses</b> [<a href='javascript:closePopup()'>Done</a>] <p class='small' style='text-align:left;'>";
    for (i in people) 
	{
	    person = people[i];
        emailHtml += person.email + ', ';
    }
	emailHtml += "</p>";
    document.getElementById('opts').innerHTML = emailHtml;
    document.getElementById('opts').style.display = 'block';
}

function closePopup()
{
    document.getElementById('opts').style.display = 'none';
}

EOF;

$title = "Admin Interface";
$body_onload = "updateTable('id')";
include_once('../header.php');
echo <<<EOF

<div align="center" class="popup" id="opts">
[<a href='#' onClick='hideOptions();'>done</a>]
</div>

<table width="100%">
 <tr>
  <td style="text-align: left"><b>Welcome, $name</b></td>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<!--div align="center" id="TableDiv" style="width:98%; height:90%; margin: 0px; border: 1px solid black; background-color:#ffffff; overflow:auto;"-->
<div id="TableDiv">
</div>

<p>Total: $total - $nBoys brothers, $nGirls sisters</p>
EOF;

include_once('../footer.php');
?>
