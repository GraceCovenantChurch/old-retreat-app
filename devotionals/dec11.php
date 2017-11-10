<?php

$BASEDIR = "docs";

date_default_timezone_set("America/New_York");
$now = date("M d");

$devotionals = array();
$dates = array();

function echoRows($rowArr) {

  global $devotionals;

  $rowspan = count($rowArr);
  $top = True;
  foreach($rowArr as $row) {
    list($date, $reading, $devotional) = $row;

    echo "<tr>";
    echo getDateAndReadingHtml($date, $reading);

    // print first row for devotionals
    if ($top) {
      $devotionalArr = $devotionals['id' . strval($devotional)];
      echo getDevotionalInfoHtml($devotionalArr, $rowspan, $date);
      $top = False;
    } 

    echo "</tr>";
  }
}

function getDateAndReadingHtml($date, $reading) {

  global $now;

  // highlight depending on time
  $comp = strcmp($date, $now);
  if($comp < 0) {
    $dateStyleStr = ' class="past"';
  } elseif($comp == 0) {
    $dateStyleStr = ' class="present"';
  } else {
    $dateStyleStr = '';
  }

  echo "<td $dateStyleStr>$date</td> <td $dateStyleStr>$reading</td>";
}

function getDevotionalInfoHtml($devotionalArr, $rowspan, $date) {

  global $now, $BASEDIR;
  list($category, $title, $filename, $featuring) = $devotionalArr;

  // add link if it is today or before
  $linkStr = (strcmp($now, $date) >= 0) ? "<a href='$BASEDIR/$filename'>$title</a>" : "$title";

  echo <<<EOF
    <td rowspan="$rowspan">$category</td>
    <td rowspan="$rowspan">$linkStr</td>
    <td rowspan="$rowspan">$featuring</td>
EOF;
}

?>

<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>

  <!-- Stylesheet for this -->
  <style type="text/css">
#devotionals 
{
border-collapse:collapse;  
}

#devotionals td, #devotionals th 
{
font-size:.8em;
border:1px solid #98bf21;
padding:3px 7px 2px 7px;
}

#devotionals th 
{
font-weight: bold;
padding: 3px;
background-color:#A7C942;
color:#ffffff;
}

td .present
{
background-color: yellow;
}

td .past
{
background-color: #EEDC82;
}

#devotionals #date
{
width: 60px;
}
  </style>
</head>

<?php include('../header.html'); ?>
<?php include('../sidebar.html'); ?>
<?php include('../home/dblogin.php'); ?>

<table id="widemaintable">
  <tr>
    <td valign="top">
 <h4>Devotionals</h4><br><br>

    <table id="devotionals">
      <tr><th id="date">Date</th> <th>Bible Reading</th> <th>Category</th> <th>Devotional</th> <th>Featuring</th></tr>

<?php

 // loop over Devotionals and put in $devotionals
 $qry1 = "SELECT ID, Category, Title, Filename, Featuring FROM Devotionals_2011_Files ORDER BY ID";
 $res1 = mysql_query($qry1);
 while ($row = mysql_fetch_array($res1)) {
    list($id, $category, $title, $filename, $featuring) = $row;
    $devotionals['id' . strval($id)] = array($category, $title, $filename, $featuring); 
 }

 // loop over Dates and put in $dates
 $qry2 = "SELECT DATE_FORMAT(`Date`,'%b %d'), Reading, Devotional FROM Devotionals_2011_Dates ORDER BY Date";
 $res2 = mysql_query($qry2);
 while ($row = mysql_fetch_array($res2)) {
    list($date, $reading, $devotional) = $row;
    $dates[$date] = array($reading, $devotional);
 }


 $currentDevotional = 0;
 $rowArr = array();
 // loop over $dates and write rows
 foreach($dates as $date => $dateArr) {

   // look at devotional
   $thisDevotional = $dateArr[1];

   if ($thisDevotional != $currentDevotional) {

     // write out rows in $rowArr
     echoRows($rowArr);

     $currentDevotional = $thisDevotional;
     unset($rowArr);
     $rowArr = array();
   }
   
   array_push($rowArr, array($date, $dateArr[0], $thisDevotional));
 }
 echoRows($rowArr);

?>

  </table>


     </td>
  </tr>
</table>

</body>
</html>
<?php include('../footer.html'); ?>

</HTML>


