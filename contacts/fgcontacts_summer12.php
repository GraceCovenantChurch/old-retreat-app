<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
<script language="JavaScript">
  var wedYa2 = new Image; wedYa2.src = "../images/fg11/wedYa2.jpg";
  var wednesYa2 = new Image; wednesYa2.src = "../images/fg11/wednesYa2.jpg";
  var tuesYa2 = new Image; tuesYa2.src = "../images/fg11/tuesYa2.jpg";
  var thursYa2 = new Image; thursYa2.src = "../images/fg11/thursYa2.jpg";
  var rocketeers2 = new Image; rocketeers2.src = "../images/fg12summer/rocketeers2.jpg";
//  var alive2 = new Image; alive2.src= "../images/fg12summer/alive2.jpg";
  var tributes2 = new Image; tributes2.src= "../images/fg12summer/tributes2.jpg";
  var xmen2 = new Image; xmen2.src= "../images/fg12summer/xmen2.jpg";
  var infinity2 = new Image; infinity2.src= "../images/fg12summer/infinity2.jpg";

  
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

 <h4>Family Group Contacts - Summer 2012</h4>

 <p><strong>Young Adults</strong><br>

<?php
     makeFgBox("fg11", "Tuesday FG", "Joe, Tracy, LaVida, Melodie", "josephkso@gmail.com", "Tuesday evenings", "tuesYa", "University City");
	 makeFgBox("fg11", "Wednesday FG", "Chris, Christine, Nami", "kwon.chris@gmail.com ", "Wednesday evenings", "wednesYa", "Art Museum");
	 makeFgBox("fg11", "Wednesday FG", "P. Kirt, Joanna, Christine, Lit", "josung2@gmail.com ", "Wednesday evenings", "wedYa", "Chinatown");
	 makeFgBox("fg11", "Thursday FG", "Brian, Chanmi, Maria, Sharon", "briandpyles@gmail.com", "Thursday evenings", "thursYa", "University City");
?>
   
 <p><strong>College</strong></p>
<?php
     makeFgBox("fg12summer", "Rocketeers", "Edward, Connie, Jon, Aerin", "edward.ct.li@gmail.com", "Tuesday evenings", "rocketeers");
     makeFgBox("fg12summer", "Alive", "Octavia, Ting, Kiet, Cindy", "octavia.marie.8@gmail.com", "Tuesday evenings", NULL);
     makeFgBox("fg12summer", "Tributes", "Courtney, Steve, Dave, Wing", "ashkicourt@gmail.com", "Tuesday evenings", "tributes");
     makeFgBox("fg12summer", "X-men", "Michelle, Harry, Joycelin, Alex", "miykwon@seas.upenn.edu", "Wednesday evenings", "xmen");
     makeFgBox("fg12summer", "Infinity & Beyond", "Hyejung, Jihae, Jinha, Jack", "jihae9@gmail.com", "Wednesday evenings", "infinity");


?>

</table>
<?php include('../footer.html'); ?>
</html>                  

<!--  LocalWords:  newImages
 -->
