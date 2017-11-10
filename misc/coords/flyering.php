<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../../header.html'); ?>
<?php include('../../sidebar.html'); ?>

<?php
$flyering = array(
  array(
    "Highrises",
    "3 x 24 = 72",
    "3 x 2 = 6",
    array(
      "Use tape",
      "Use elevator to go quickly"
    )
  ),
  array(
    "Quad",
    "~50",
    "at least 7",
    array(
      "Get people who know the quad",
      "Be careful to post in only the allowed spots b/c we got an email once."
    )
  ),
  array(
    "Hill",
    "~25",
    "2",
    array(
      "Flyer lobby, by each staircase on each floor."
    )
  ),
  array(
    "KC / EH",
    "~17",
    "2",
    array(
    )
  ),
  array(
    "Mayer / Gregory / DuBois",
    "6 + 8 + 4 = 18",
    "2",
    array(
      "Give to people at DuBois to put up."
    )
  ),
  array(
    "Locust Walk / Williams / Meyerson",
    "20",
    "2",
    array(
      "Can do Stietler, Stieny D, DRL also"
    )
  ),
  array(
    "Off Campus: Domus / Chestnut Hall / Radian",
    "~25",
    "2",
    array(
      "Haven't tried this before"
    )
  )
);
?>


<table id="widemaintable">
 <tr>
   <td>
     <p><b>FLYERING</b></p>

     <h4>Penn</h4>
     <table class="coords_table">
         <tr><th>Building</th><th>Flyers</th><th>Suggested People</th><th>Notes</th></tr>

<?php
  foreach($flyering as $f) {
  $notes = "<ul>";
  foreach($f[3] as $note) {
    $notes .= "<li>" . $note . "</li>";
  }
  $notes .= "</ul>";
  echo <<<EOF
  <tr>
    <td>$f[0]</td>
    <td>$f[1]</td>
    <td>$f[2]</td>
    <td>$notes</td>
  </tr>
EOF;
  }
?>
     </table>
   <i>* updated August 8, 2012</i>

     
   </td>
 </tr>
</table>
<?php include('../../footer.html'); ?>

</HTML>

