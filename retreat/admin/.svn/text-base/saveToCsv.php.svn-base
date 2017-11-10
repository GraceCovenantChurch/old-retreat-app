<?php

date_default_timezone_set("America/New_York");

//filename to save
$filename = "signups-" . date("Ymd-Hi") . ".csv";

include_once('db_verify.php');

//get comma separated string
function getStringFromArray($array)
{
    return implode(",", $array);
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");

//headers to keep
$HEADERS = array("id", "fname", "lname", "gender", "email", "cphone", "school", "class", "price", "deposit", "sg", "sgleader", "roomnumber", "signuptime", "lastupdate", "lastupdater", "CheckInTime", "transpo_to", "transpo_back", "Comments");

$res = mysql_query("SELECT * FROM Retreat_Participants ORDER BY id");

//array of rows for file
$fileRows = array();

//put header row into $fileRows
array_push($fileRows, getStringFromArray($HEADERS));

while ($row = mysql_fetch_assoc($res)) 
{
    //add the given values into $subrow
    $subrow = array();
    {
        foreach($HEADERS as $header)
        {
            array_push($subrow, $row[$header]);
        }
    }

    //put row into $fileRows
    array_push($fileRows, getStringFromArray($subrow));
}

echo implode("\n", $fileRows);

?>