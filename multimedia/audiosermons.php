<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>

<table id="widemaintable">
  <tr>
    <td valign="top">
<?php
include('../home/dblogin.php');
$year = $_GET['year'];
$filt = " AND Type NOT LIKE 'F' AND Type NOT LIKE 'Y' AND Site=0";
$type_link = "";
if ($_GET['type'] == "F") {
    $filt = " AND Type LIKE 'F' AND Site=0";
    $type_link = "&type=F";
} elseif ($_GET['type'] == "Y") {
    $filt = " AND Type LIKE 'Y' AND Site=0";
    $type_link = "&type=Y";
}
$year_found = 0;
$first = 1;
$yr = 0;

if ($year <= 0) {
    $res_1 = mysql_query("SELECT MAX(YEAR(`Date`)) FROM Sermons");
    list($year) = mysql_fetch_array($res_1);
}

$head = "<h4>Audio Sermons";
if ($_GET['type'] == "F") {
  $top_types = "<a href=\"?year=$year&type=Y\">Young Adult FNL</a> - <b>College FNL</b> - <a href=\"?year=$year\">Sunday Morning</a> - <a href=\"gccpodcasting.php\">Podcasting</a>";  
} elseif ($_GET['type'] == "Y") {
  $top_types = "<b>Young Adult FNL</b> - <a href=\"?year=$year&type=F\">College FNL</a> - <a href=\"?year=$year\">Sunday Morning</a> - <a href=\"gccpodcasting.php\">Podcasting</a>";
} else {
  $top_types = "<a href=\"?year=$year&type=Y\">Young Adult FNL</a> - <a href=\"?year=$year&type=F\">College FNL</a> - <b>Sunday Morning</b> - <a href=\"gccpodcasting.php\">Podcasting</a>";
}

echo <<<EOF1
      $head - [ 
EOF1;

$res = mysql_query("SELECT DISTINCT YEAR(`Date`) FROM Sermons ORDER BY `Date`");
while ($arr = mysql_fetch_array($res))
{
    if ($first == 1) { $first = 0; } else { echo " | \n"; }
    if ($year == $arr[0]) { $year_found = 1; }
    $yr = $arr[0];
    if ($year == $yr) { 
	$year_found = 1;
	echo "$yr";
    } else {
	echo "<a href=\"?year=$yr$type_link\">$yr</a>";
    }
}
echo "\n";

// if year wasn't set, set it to this year (last one we have sermons for).
if ($year_found == 0) { $year = $yr; }

echo <<< EOF
 ]</h4><br>
  <div align="center" style="font-size: 10pt; padding: 5px;">$top_types</div>
EOF;
?>

      <table width="100%" border="0" cellspacing="3" cellpadding="0">

<?php
function build_ref($book,$ch1,$ch2,$vs1,$vs2)
{
    $ret = "";
    if ($book !== "" && $ch1 > 0)
    {
	$ret = $ch1;
	if ($vs2 != 0)
	{
	    $ret .= ":$vs1";
	}
	if ($vs2 != $vs1 && $vs2 != 0 || $ch2 != $ch1)
	{
	    $ret .= "-";
	    if ($ch2 != $ch1)
	    {
		$ret .= "$ch2:";
	    }
	    $ret .= $vs2;
	}
    }
    return $ret;
}

function getGoogleAnalyticsStr($date)
{
  return "onClick=\"_gaq.push(['_trackEvent', 'Sermons', 'Play', '$date']);\"";
}

function getTypeText($type)
{
  if($type=="F" or $type=="Y") {
    return "Friday";
  } else if($type=="S") {
    return "Sunday";
  } else if($type=="R") {
    return "Retreat";
  } else if($type=="E") {
    return "Easter";
  } else if($type=="P") {
    return "Passion<br>Revival";
  } else {
    return "";
  }
}

function echo_series($ser)
{
    global $year;
    $qry1 = "SELECT Title,Pastor,DATE_FORMAT(`StartDate`,'%b %e, %Y'),DATE_FORMAT(`EndDate`,'%b %e, %Y'),Image,ImageSmall,Description FROM Sermon_Series WHERE SeriesID = $ser";
    $res1 = mysql_query($qry1);
    list($stitle,$pastor,$sdate,$edate,$img,$imgsm,$desc) = mysql_fetch_array($res1);

    $qry = "SELECT Series, Type, DATE_FORMAT(`Date`,'%m.%d.%y'), Title, MP3, M3U, Pdf, BibleBooks.Book, ch_start, ch_end, vs_start, vs_end, Speakers.Name, Extra FROM Sermons, BibleBooks, Speakers WHERE Series = $ser AND BibleBooks.Num = Sermons.Book AND Speakers.ID = Speaker ORDER BY `Date` DESC, `MP3` DESC";
    $res = mysql_query($qry);
    if ($res === false) {
        echo mysql_error() . "<-- mysql error";
    }
    $num_sermons = 0;
    $html = "";
    while ($row = mysql_fetch_array($res))
    {
	$num_sermons++;
	list($series, $type, $date, $title, $mp3, $m3u, $pdf, $book, $ch1, $ch2, $vs1, $vs2, $spk, $extra) = $row;
	$spk = preg_replace('@<[^>]*>@',' ',$spk);
	$ref = build_ref($book, $ch1, $ch2, $vs1, $vs2);
	if ($num_sermons > 1) {
	    $html .= "			 <tr align=\"center\" class=\"text\">\n";
	}
        $title = str_replace('&quot;', '', $title);
        if ($m3u != NULL && strlen($m3u)) {
	    $title = "<a href=\"audiofiles/$m3u\" " . getGoogleAnalyticsStr($date) . ">$title</a>";
	    if ($mp3 != NULL && strlen($mp3) > 0) {
		$title .= "&nbsp;&nbsp;<a href=\"audiofiles/$mp3\" " . getGoogleAnalyticsStr($date) . "><img src=\"images/mp3_mini.gif\" border=1 align=bottom alt=\"mp3\"></a>";
	    }
        } else if ($mp3 != NULL && strlen($mp3) > 0) {
	    $title = "<a href=\"audiofiles/$mp3\" " . getGoogleAnalyticsStr($date) . ">$title</a>";
	}
        if ($pdf) {
            $extensions = explode('.', $pdf);
            $extension = $extensions[1];
	    $pdf_str = " [<a href='http://gracecovenant.net/resources/audiosermons/sermonFiles/" . $pdf . "'>" . $extension . "</a>]";
        } else {
            $pdf_str = "";
        }
	$book_and_ref = "$book $ref";
	if (strlen($book_and_ref)>1) {
	    $book_and_ref = "                              $book_and_ref";
	}

	$html .= <<<EOR
                            <td height="28" bgcolor="#F0F0F0" width="241" valign="top" colspan=2>
			      <table width="100%" height="100%">
				<tr valign=center>
				  <td>$date</td>
				  <td align=right>$spk</td>
				</tr><tr>
				  <td colspan=2 align=center valign=center>
				    <b>$title</b>$pdf_str<br>$book_and_ref<br>
				  </td>
				</tr>
			      </table>
			    </td>
                          </tr>
EOR;
    }
    if ($pastor != "" && $pastor != NULL) { $pastor .= "<br>\n"; }
    $dates = "";
    if ($sdate && $edate) { $dates = "$sdate - $edate<br>"; }
	
    echo <<<EOF
        <tr><td colspan=5 bgcolor="#CCCCCC">&nbsp;</td>
	<tr><td colspan=3 rowspan=$num_sermons bgcolor="#F0F0F0" border=2>
	    <p align=center><a href="audioseries.php?series=$series&year=$year"><img src="images/sermons/$imgsm"></a><br>
	    $dates
	    $pastor
	    [ <a href="audioseries.php?series=$series&year=$year">more info</a> ]
	  </td>
	  $html
	</tr>
EOF;
}
    $qry = "SELECT Series, Type, DATE_FORMAT(`Date`,'%m.%d.%y'), Title, MP3, M3U, Pdf, BibleBooks.Book, ch_start, ch_end, vs_start, vs_end, Speakers.Name, Extra FROM Sermons, BibleBooks, Speakers WHERE YEAR(`Date`) = $year AND BibleBooks.Num = Sermons.Book AND Speakers.ID = Speaker $filt ORDER BY `Date` DESC, `MP3` DESC";
    $res = mysql_query($qry);
    $series_used = array();
    $last_series = -1;
    if (!$res) {
	die("  Error: ".mysql_error()."\n");
    }
    while ($row = mysql_fetch_array($res))
    {
	list($series, $type, $date, $title, $mp3, $m3u, $pdf, $book, $ch1, $ch2, $vs1, $vs2, $spk, $extra) = $row;
	if ($series > 0)
	{
	    if (isset($series_used[$series])==false)
	    {
		echo_series($series);
		$series_used[$series] = true;
	    }
	    $last_series = $series;
	    continue;
	} else if ($last_series != 0) {
	    echo <<<EOF
	<tr align="center" class="text"> 
	  <td width="65" height="4" bgcolor="#CCCCCC">&nbsp;</td>
	  <td width="65" height="4" bgcolor="#CCCCCC"><b>Date</b></td>
	  <td height="4" bgcolor="#CCCCCC"><b>Message Title</b></td>
	  <td height="4" bgcolor="#CCCCCC"><b>Scripture</b></td>
	  <td height="4" bgcolor="#CCCCCC"><b>Speaker</b></td>
	</tr>
EOF;
	}
	$last_series = $series;
	$ref = build_ref($book,$ch1,$ch2,$vs1,$vs2);

	// take care of anything in the "extra" field
	$pos = 0;
	$end_pos = strlen($extra);
	$more = true;
	while ($more)
	{
	    $more = false;
	    switch( substr($extra,$pos,$pos+1) )
	    {
	    case "B":
		$ref .= substr($extra,$pos+1,$end_pos);
		break;
	    // TODO - M for multi, set more back to true and modify pos and end_pos
	    //	    - H for 'html', put this html code in instead of the entire <tr>.
	    }
	}

        $typeText = getTypeText($type);

	echo <<<EOF
                          <tr align="center" class="text"> 
                            <td height=28 bgcolor="#F0F0F0" class="text"><strong><font class="$type">$typeText</font></strong></td>
                            <td height=28 bgcolor="#F0F0F0" class="text"><font face="Verdana, Arial, Helvetica, sans-serif">$date</font></td>
                            <td height="28" bgcolor="#F0F0F0" class="text"><font face="Verdana, Arial, Helvetica, sans-serif">$title<br>
EOF;

	if ($mp3 != NULL && strlen($mp3) > 0) {
	  $line = "<a href=\"audiofiles/$mp3\" " . getGoogleAnalyticsStr($date) . ">file</a> | <a href=\"audiofiles/$m3u\" " . getGoogleAnalyticsStr($date) . ">stream</a></font>";
	}
        if ($pdf) {
            $extensions = explode('.', $pdf);
            $extension = $extensions[1];
	    $line .= " | <a href='http://gracecovenant.net/resources/audiosermons/sermonFiles/" . $pdf . "'>" . $extension . "</a>";
        }
        echo $line;
echo <<<EOF
                              </td>
                            <td height=28 valign=center bgcolor="#F0F0F0"><font size="1"><nobr>$book</nobr> $ref</font></td>
                            <td height=28 bgcolor="#F0F0F0"><font size="1">$spk</font></td>
                          </tr>
EOF;
    }
?>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php include('../footer.html'); ?>

</HTML>


