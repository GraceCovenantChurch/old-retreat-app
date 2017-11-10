<?php
function printJsLine($fg) {
  echo <<<EOF
    var ${fg}2 = new Image; ${fg}2.src = "../images/fg12/${fg}2.jpg";

EOF;
}

$drexel_fgs = array(
  "braveheart" => array("Braveheart", "Joycelin, Chris, Aimee, Glory", "musicalmunchkin@gmail.com", "Tuesday evenings", "braveheart"),
  "hakunamatata" => array("Hakuna Matata", "Alex, Justine, Jinha, Angelica", "alexander.y.chae@gmail.com", "Wednesday evenings", NULL),
  "yourstruly" => array("Yours Truly", "Irene, Aerin, Bryant", "i.dohee.kim@gmail.com", "Thursday evenings", "yourstruly")
);

$penn_fgs = array(
  "conquerers" => array("More than Conquerors", "Jabez, Connie", "jabezyeo@gmail.com", "Monday evenings", "conquerers"), 
  "sprout" => array("Sprout", "Octavia, Chris, Wendy", "octavia.marie.8@gmail.com", "Monday evenings", "sprout"), 
  "dreamworks" => array("DreamWorks", "Hyejung, Jon, Deborah", "hyejunghyejung211@gmail.com", "Tuesday evenings", "dreamworks"), 
  "skyrocket" => array("Skyrocket", "Robyn, Linos, Sophie", "robynmchan@gmail.com", "Tuesday evenings", "skyrocket"), 
  "amplified" => array("Amplified", "Edward, Charmer, Jenny", "edward.ct.li@gmail.com", "Tuesday evenings", "amplified"), 
  "nsync" => array("'N Sync", "Patrick, Christine", "atis.patrick@gmail.com", "Tuesday evenings", "nsync"), 
  "rooted" => array("Rooted", "Jessie, Harry, Connie", "jessicayi514@gmail.com", "Wednesday evenings", "rooted"), 
  "fightclub" => array("Fight Club", "Jihae, Alice, Ting", "jihae9@gmail.com", "Wednesday evenings", "fightclub"),
  "called" => array("Called", "Courtney, Cindy, Andrew", "ashkicourt@gmail.com", "Wednesday evenings", "called"), 
  "gushers" => array("Gushers", "Cindy, Mike, Shinhaeng", "cindy.x.wei@gmail.com", "Thursday evenings", "gushers"), 
  "transformers" => array("Transformers", "David, Christina, Wing", "david.dk.kim@gmail.com", "Thursday evenings", "transformers"), 
  "polo" => array("POLO CO.", "Michelle, Jeff, Sunny", "michellekwon09@gmail.com", "Thursday evenings", "polo")
);


$usci_fgs = array(
  "coolrunnings" => array("Cool Runnings", "Kevin, Christine, Steve", "kevinwsin@gmail.com", "Thursday evenings", "coolrunnings"),
);

$all_fgs = array(
  "Drexel University" => $drexel_fgs,
  "University of Pennsylvania" => $penn_fgs,
  "University of the Sciences" => $usci_fgs
);
?>




<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
<script language="JavaScript">
  var tueYa2 = new Image; tueYa2.src = "../images/fg12/tueYa2.jpg";
  var tuesYa2 = new Image; tuesYa2.src = "../images/fg12/tuesYa2.jpg";
  var wedYa2 = new Image; wedYa2.src = "../images/fg12/wedYa2.jpg";
  var wednYa2 = new Image; wednYa2.src = "../images/fg12/wednYa2.jpg";
  var wedneYa2 = new Image; wedneYa2.src = "../images/fg12/wedneYa2.jpg";
  var thuYa2 = new Image; thuYa2.src = "../images/fg12/thuYa2.jpg";
  
<?php
foreach($all_fgs as $name => $fgs) {
  foreach($fgs as $fg => $info) { 
    if($info[4]) {
       printJsLine($fg);
     }
  }
}
?>
  
  function funny(fgname) {
      document.images[fgname].src = eval(fgname+"2.src");
  }
  function normal(fgname, idir) {
      document.images[fgname].src = "../images/"+idir+"/"+fgname+".jpg";
  }

</script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>

<?php
  function makeFgBox($imageDir, $fgName, $servants, $contact, $when, $pic, $where=NULL) {
    if ($pic==NULL) {
	  $padding="20";
	} else {
	  $padding="2";
	}

    if ($where==NULL) {
	  $whereStr = "";
	} else {
	  $whereStr = "<strong>where:</strong> $where<br>";
	}
  
    echo <<<EOF
  <table width="550" cellspacing="5" cellpadding="$padding" align="center" class="fgcontacts">
    <tr valign="middle">
EOF;
  
    if ($pic==NULL) {
	  echo "<td width='100'>&nbsp</td>";
	} else {
	  echo <<<EOF
	 <td><img src="../images/$imageDir/$pic.jpg" name="$pic" onMouseOver="javascript:funny('$pic');" onMouseOut="javascript:normal('$pic', '$imageDir');"></td>
	 <td width="2">&nbsp;</td>
EOF;
	}
	
	echo <<<EOF
	<td>
	   <h3>$fgName</h3>
       <h4>$servants</h4><br>
       <strong>when:</strong> $when<br>
       $whereStr
       <strong>email:</strong> <font color="#0000CC">$contact</font><br>
     </td>
    </tr>
  </table><br>
EOF;
  }
?>

<table id="widemaintable">
 <tr> 
  <td class="medium">

 <h4>Family Group Contacts - 2012-2013</h4>

 <p><a href="https://docs.google.com/spreadsheet/viewform?formkey=dHFkclAyMXVqYmJlb3dJR2toR3p3R2c6MQ#gid=0" target="_blank">College Signup</a> | <a href="https://spreadsheets.google.com/spreadsheet/viewform?formkey=dE5yVUhMTzV1eFd1Q04taDZIT2RpVUE6MQ" target="_blank">YA Signup</a></p>

 <p><strong><i>Young Adults</i></strong><br>

<?php
   makeFgBox("fg12", "Tuesday FG", "Chris, Sharon, Allison, Justine, Kael", "kwon.chris@gmail.com", "Tuesday evenings", "tueYa", "University City");
	 makeFgBox("fg12", "Tuesday FG", "Joe, Maria, Lit, Qiao", "gentsoschikin@gmail.com", "Tuesday evenings", "tuesYa", "University City");
	 makeFgBox("fg12", "Wednesday FG", "Brian, ChanMi, Ellen, Steven, Dan", "briandpyles@yahoo.com", "Wednesday evenings", "wedYa", "University City");
	 makeFgBox("fg12", "Wednesday FG", "Elias, Joanna, Paul, Nami", "liquidricecclxv@gmail.com", "Wednesday evenings", "wednYa", "Chinatown");
	 makeFgBox("fg12", "Wednesday FG", "Ryan, Christine, John, Sara", "rscalley@gmail.com", "Wednesday evenings", "wedneYa", "Art Museum");
	 makeFgBox("fg12", "Thursday FG", "Mike, Tracy, Kwadwo, Hanna", "waypointmty@gmail.com", "Thursday evenings", "thuYa", "Center City");
?>
   
 
<?php
foreach($all_fgs as $cat => $fgs) {
  echo <<<EOF
 <p><strong><i>$cat</i></strong></p>

EOF;
  foreach($fgs as $name => $vals) {
    makeFgBox("fg12", $vals[0], $vals[1], $vals[2], $vals[3], $vals[4]);
  }
}
?>

</table>
<?php include('../footer.html'); ?>
</html>                  

<!--  LocalWords:  newImages
 -->
