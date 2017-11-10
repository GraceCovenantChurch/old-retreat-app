<?php

include_once('db_verify.php');
include_once('../db_connect.php');

include_once('sg-funcs.php');

// build up mysql string 
$mysql_str = "select * from Retreat_Participants WHERE sg NOT IN ('Coords','Band','Staff') ORDER BY sg, sgleader desc, class desc";

// get rows
$res = mysql_query($mysql_str);

?>

<html>
<head>
    <style>
    body {
        width: 8.5in;
        }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
     }
    .spacer {
        height: 0.625in;
    }
   
    /* page break */
    .sg_pb {
      page-break-before: always;
    }

    .sg, .sg_pb {
      min-height: 4.5in;
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
    table, th, td {
    	     border: 1px solid black;
    padding: 5px;
    }
    table {
border-collapse:collapse;
}
    </style>

</head>
<body>

<?php

$i = 0;

function start_sg() {
  $SGS_PER_PAGE =   2;
  global $i;
  $class = (($i % $SGS_PER_PAGE) == 0) ? "sg_pb" : "sg";
  echo "<div class='$class'><table>";
  $i = $i + 1;
}

function finish_sg() {
  echo "</table></div>";
  echo <<<EOF
  <ul>
   <!--li>Please mark down your small group attendance and give this to Kevin during Sat lunch!</li-->
   <li>Have a great small group =)</li>
  </ul>
EOF;
}

$top = True;
while ($row = mysql_fetch_assoc($res)) {

  $sgStr = sg_to_name($row['sg']) . " (" . $row['sg'] . ")";
  if ($row['sgleader']==1) {
    // do not finish and start sg if it is the first one
    if($top) {
      $top = False;
    } else {
      finish_sg();
    }

    // start sg
    start_sg();

    echo "<tr><td colspan=5><h1>$sgStr</h1></td></tr>";
    echo "<tr><th>Name</th><th>School</th><th>Class</th><th>Room</th><th>Phone</th><!--th>Fri PM</th><th>Sat AM</th><th>Sat PM</th><th>Sun AM</th--></tr>";
  }
  echo <<<ROW
  <tr>
    <td>$row[fname] $row[lname]</td>
    <td>$row[school]</td>
    <td>$row[class]</td>
    <td>$row[roomnumber]</td>
    <td>$row[cphone]</td>
    <!--td></td>
    <td></td>
    <td></td>
    <td></td-->
  </tr>
ROW;

}

// finish last sg
finish_sg();

?>


</body>
</html>

