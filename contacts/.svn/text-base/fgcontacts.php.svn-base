<?php
function printJsLine($fg) {
  echo <<<EOF
    var ${fg}2 = new Image; ${fg}2.src = "../images/fg13/${fg}2.jpg";

EOF;
}

$ya_fgs = array(
  "tues_a" => array("CrossProduct", "Paul, Christine, Steven, Micky", "yptzen@gmail.com", "Tuesday evenings", "paul", "University City (44th and Spruce)"),
  "tues_b" => array("ADIDAS", "Joe, Soo, Allison, Priscilla, Jun", "gentsoschikin@gmail.com", "Tuesday evenings", "joe", "Center City (19th and Arch)"),
  "wed_a" => array("Wednesday LRSM", "Brian, Chris, Sharon, Robyn, Steph", "briandpyles@gmail.com", "Wednesday evenings", "wlrsm", "University City (33rd and Walnut)"),
  "wed_b" => array("Love Notes", "Elias, Priscila, Andrew, Joy, Tina", "liquidricecclxv@gmail.com", "Wednesday evenings", "elias", "University City (39th and Chestnut)"),
  "thurs_a" => array("The Running Company", "John, Joanna, Katherine, Peter, Ellen", "nguyen.john.v@gmail.com", "Thursday evenings", NULL, "University City (39th and Chestnut)"),
  "thurs_b" => array("Rise Up", "Chris, Esther, Vince, Christy, Karen", "kwon.chris@gmail.com", "Thursday evenings", "chris", "Center City (21st and Locust)")
);

$penn_fgs = array(
  "finders_keepers" => array("Finders Keepers", "Jessie, Jack, Melissa", "jessicayi514@gmail.com", "Monday evenings", "jessie", NULL),
  "breakfast_club" => array("The Breakfast Club", "Chris, Alice", "cwang731@gmail.com", "Monday evenings", "chrisw", NULL),
  "happy_feet" => array("Happy Feet", "Michelle, Jay, Ola", "michellekwon09@gmail.com", "Tuesday evenings", "michelle", NULL),
  "stereo_hearts" => array("StereoHearts", "Jeff, Christina, Melissa", "riceice777@gmail.com", "Tuesday evenings", "jeff", NULL),
  "ice_climbers" => array("Ice Climbers", "Jon, Amy", "choumein@gmail.com", "Tuesday evenings", "jon", NULL),
  "rain_or_shine" => array("Rain or Shine", "Ting, Connie, Michelle", "tinglau81792@gmail.com", "Wednesday evenings", "ting", NULL),
  "man_of_steel" => array("Man of Steel", "Andrew, Jenny, Wendy", "andrewel@sas.upenn.edu", "Wednesday evenings", "andrew", NULL),
  "skyfall" => array("Skyfall", "Wing, Taylor", "wingli41@gmail.com", "Wednesday evenings", "wing", NULL),
  "minions" => array("Minions", "Cindy, Bryan, Sue", "cindy.x.wei@gmail.com", "Wednesday evenings", "cindy", NULL),
  "shout" => array("Shout", "Christine, Dylan", "ctedijanto@gmail.com", "Thursday evenings", "christine", NULL),
  "triforce" => array("Triforce", "Harry, Ethel, David", "hehrhee@gmail.com", "Thursday evenings", "harry", NULL),
  "he_reigns" => array("He Reigns", "Wonah, Jason", "wsung91@gmail.com", "Thursday evenings", "wonah", NULL)
);

$drexel_fgs = array(
  "fruit_ninjas" => array("Fruit Ninjas", "Joycelin, Mike, Angelica, Vincent", "musicalmunchkin@gmail.com", "Tuesday evenings", NULL, NULL),
  "olive_garden" => array("Olive Garden", "Jinha, Kang Hee, Kate, Hilary", "jinhalee1992@gmail.com", "Wednesday evenings", NULL, NULL),
  "hobbits" => array("Hobbits", "Patrick, Aerin, Joanna, Dan, Henderson", "atis.patrick@gmail.com", "Wednesday evenings", NULL, NULL),
  "embers" => array("Embers", "Irene, Steph, Rachel, Dan", "i.dohee.kim@gmail.com", "Thursday evenings", "embers", NULL),
  "white_flag" => array("White Flag", "Glory, Shirley, Nicole", "coreaglory@gmail.com", "Thursday evenings", "whiteflag", NULL),
);

$international_fgs = array(
  "international" => array("International Students FG", "Jabez, Octavia, SeMi", "jabezyeo@gmail.com", "Thursday evenings", "jabez", NULL),
);

$usp_fgs = array(
  "usp" => array("Springs of Water", "Edward, Aran", "edward.ct.li@gmail.com", "Wednesday evenings", "springs", NULL),
);

$all_fgs = array(
  "Young Adults" => $ya_fgs,
  "International Students" => $international_fgs,
  "College - Drexel" => $drexel_fgs,
  "College - Penn" => $penn_fgs,
  "College - USciences" => $usp_fgs
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
  
<?php
foreach($all_fgs as $name => $fgs) {
  foreach($fgs as $fg => $info) { 
    if($info[4]) {
       printJsLine($info[4]);
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

 <h4>Family Group Contacts - 2013-2014</h4>

 <p>Contact a family group leader to join, or sign up here: <a href="/fg/index.php">College</a> | <a href="/fg/ya.php">Young adult</a></p>

<?php
foreach($all_fgs as $cat => $fgs) {
  echo <<<EOF
 <p><strong><i>$cat</i></strong></p>

EOF;
  foreach($fgs as $name => $vals) {
    makeFgBox("fg13", $vals[0], $vals[1], $vals[2], $vals[3], $vals[4], $vals[5]);
  }
}
?>

</table>
<?php include('../footer.html'); ?>
</html>                  

<!--  LocalWords:  newImages
 -->
