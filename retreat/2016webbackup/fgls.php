<?php
$title = "Sign Up";
include_once("db_fields.php"); // defines $fields
include_once("db_connect.php");

// check for ?view at end
$view_flag = ($_GET['view'] != NULL) ? True : False;
$owes_flag = ($_GET['owes'] != NULL) ? True : False;

// add tablesorter
$extra_header = <<<EOF
  <script language="JavaScript" src="/jquery/current.js"></script>
  <script language="JavaScript" src="/js/tablesorter/current.js"></script>
  <script language="JavaScript" src="retreat.js"></script>
EOF;

include_once("gcc_header.php");

if ($view_flag) {
  $select_str = "SELECT * FROM Retreat_Participants ORDER BY School, Class, fname";
  $col_title = "Paid Deposit?";
} else if ($owes_flag) {
  $select_str = "SELECT * FROM Retreat_Participants WHERE deposit!=price AND CheckInTime IS NOT NULL ORDER BY School, Class, fname";
  $col_title = "Owes Money?";
} else {
  include_once("gcc_footer.php");
  exit();
}

echo "<div align='center'>";
echo <<<EOF
<table cellpadding='3' style='border: 1px solid black' class='tablesorter' id='people_table'>
  <thead>
    <tr bgcolor='orange'>
      <th class="header"><b>Name</b></th>
      <th class="header"><b>School</b></th>
      <th class="header"><b>Year</b></th>
      <th class="header"><b>$col_title</b></th>
    </tr>
  </thead>
  <tbody>
EOF;
?>

<?php
$res = mysql_query($select_str);
while ($row = mysql_fetch_assoc($res)) {
  $deposit_str = ($row['deposit'] > 0) ? 'Y' : 'N';
  $owes = $row['price'] - $row['deposit'];
  $full_str = ($owes == 0) ? 'Y' : "N - owes \$$owes";
  $col_str = $view_flag ? $deposit_str : $full_str;
  echo "<tr onMouseover=\"this.bgColor='#ADDFFF'\" onMouseout=\"this.bgColor='#FFFFFF'\"><td>" . $row['fname'] . " " . $row['lname'] . "</td><td>" . $row['school'] . "</td><td>" . $row['class'] . "</td><td>" . $col_str .  "</td></tr>\n";

}
echo "</tbody>";
echo "</table>";
echo "</div>";

include_once("gcc_footer.php");
?>
