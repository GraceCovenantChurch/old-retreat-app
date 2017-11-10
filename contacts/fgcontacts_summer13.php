<?php
function printJsLine($fg) {
  echo <<<EOF
    var ${fg}2 = new Image; ${fg}2.src = "../images/fg12/${fg}2.jpg";

EOF;
}

$ya_men_fgs = array(
  "chris" => array("Tuesday FG", "Chris", "kwon.chris@gmail.com", "Tuesday evenings", NULL, "Center City"),
  "joe" => array("Tuesday FG", "Joe", "gentsoschikin@gmail.com", "Tuesday evenings", NULL, "Upper Darby"),
  "brian" => array("Wednesday FG", "Brian", "briandpyles@gmail.com", "Wednesday evenings", NULL, "University City"),
  "elias" => array("Wednesday FG", "Elias", "liquidricecclxv@gmail.com", "Wednesday evenings", NULL, "Chinatown")
);

$ya_women_fgs = array(
  "sharon" => array("Tuesday FG", "Sharon", "tsen.shan@gmail.com", "Tuesday evenings", NULL, "University City"),
  "joy" => array("Tuesday FG", "Joy, Esther", "joyyful@gmail.com", "Tuesday evenings", NULL, "University City"),
  "chanmi" => array("Wednesday FG", "ChanMi", "chanmij@gmail.com", "Wednesday evenings", NULL, "University City"),
  "joanna" => array("Wednesday FG", "Joanna", "josung2@gmail.com", "Wednesday evenings", NULL, "Chinatown"),
  "sara" => array("Wednesday FG", "Sara, Christine", "samathew917@gmail.com", "Wednesday evenings", NULL, "Art Museum"),
  "hanna" => array("Thursday FG", "Tracy", "tracy.tzen@gmail.com", "Thursday evenings", NULL, "University City")
);

$college_fgs = array(
  "tues1" => array("Tuesday FG", "Bryant, Christine", "the4thslegacy@gmail.com", "Tuesday evenings", NULL, NULL),
  "tues2" => array("Tuesday FG", "Wonah, Jon", "wsung91@gmail.com", "Tuesday evenings", NULL, NULL),
  "wed1" => array("Wednesday FG", "Jinha, Jeff", "jinhalee1992@gmail.com", "Wednesday evenings", NULL, NULL),
  "wed2" => array("Wednesday FG", "Andrew, Aerin", "andrewel@sas.upenn.edu", "Wednesday evenings", NULL, NULL),
  "wed3" => array("Wednesday FG", "Jenny, Ting", "baeji@sas.upenn.edu", "Wednesday evenings", NULL, NULL),
);

$all_fgs = array(
  "Young Adult Men" => $ya_men_fgs,
  "Young Adult Women" => $ya_women_fgs,
  "College" => $college_fgs
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

 <h4>Family Group Contacts - Summer 2013</h4>

 <p>Contact a family group leader or <a href="/fg/index.php">click here</a> to join a family group!</p>

<?php
foreach($all_fgs as $cat => $fgs) {
  echo <<<EOF
 <p><strong><i>$cat</i></strong></p>

EOF;
  if($cat == "Young Adult Women") {
    echo "<p>Young Adult Women are studying <i>Lies Women Believe: And the Truth that Sets Them Free</i> by Nancy Demoss.</p>";
  } elseif($cat == "Young Adult Men") {
    echo "<p>Young Adult Men are studying <i>Counterfeit Gods</i> by Tim Keller.</p>";
  }
  foreach($fgs as $name => $vals) {
    makeFgBox("fg12", $vals[0], $vals[1], $vals[2], $vals[3], $vals[4], $vals[5]);
  }
}
?>

</table>
<?php include('../footer.html'); ?>
</html>                  

<!--  LocalWords:  newImages
 -->
