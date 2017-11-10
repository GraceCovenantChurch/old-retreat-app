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
      <h4>Audio Sermons - [ 
<?php

include('../home/dblogin.php');
$year = $_GET['year'];
$year_found = 0;
$first = 1;
$yr = 0;

if ($year <= 0) {
    $res_1 = mysql_query("SELECT MAX(YEAR(`Date`)) FROM Sermons");
    list($year) = mysql_fetch_array($res_1);
}

$res = mysql_query("SELECT DISTINCT YEAR(`Date`) FROM Sermons ORDER BY `Date`");
while ($arr = mysql_fetch_array($res))
{
    if ($first == 1) { $first = 0; } else { echo " | \n"; }
    if ($year == $arr[0]) { $year_found = 1; }
    $yr = $arr[0];
    if ($year == $yr) { 
	$year_found = 1;
    }
    echo "                                  <a href=\"audiosermons.php?year=$yr\">$yr</a>";
}
echo "\n";

// if year wasn't set, set it to this year (last one we have sermons for).
if ($year_found == 0) { $year = $yr; }


?> ]</h4>
      <br><br>
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
    $ser = $_GET['series'];
    $qry1 = "SELECT Title, Pastor, Image, Description FROM Sermon_Series WHERE SeriesID = $ser";
    $res1 = mysql_query($qry1);
    list($stitle, $spastor, $simage, $sdesc) = mysql_fetch_array($res1);
    if ($sdesc != "" && $sdesc != NULL) {
	$sdesc = "
	<br><br>
$sdesc";
    }
    echo <<<EOF
      <p align=center><b><font size=+1>$stitle</font></b><br>
      $spastor
      <p align=center>
      <img src="images/sermons/$simage" align=center><table>
      $sdesc
      </table>
EOF;
    echo "
      <table width=\"500\" border=\"0\" cellspacing=\"3\" cellpadding=\"3\" class=\"text\" align=\"center\">\n";
    // find out if there are any scripture references in this series.  If not, don't list.
    $res2 = mysql_query("SELECT Book FROM Sermons WHERE Series = $ser AND Book > 0 LIMIT 1");
    $has_scriptures = false;
    $scripture_line = "";
    if (mysql_fetch_array($res2))
    {
	$has_scriptures = true;
	$scripture_line = "<td width=\"120\" height=\"4\" bgcolor=\"#CCCCCC\"><b>Scripture</b></td>";
    }

    $qry = "SELECT Type, DATE_FORMAT(`Date`,'%m.%d.%y'), Title, MP3, M3U, BibleBooks.Book, ch_start, ch_end, vs_start, vs_end, Speakers.Name, Extra FROM Sermons, BibleBooks, Speakers WHERE Series = $ser AND BibleBooks.Num = Sermons.Book AND Speakers.ID = Speaker ORDER BY `Date` DESC";
    $res = mysql_query($qry);

    $series_used = array();
    $last_series = -1;

    if (!$res) {
	die("  Error: ".mysql_error()."\n");
    }
    while ($row = mysql_fetch_array($res))
    {
	list($type, $date, $title, $mp3, $m3u, $book, $ch1, $ch2, $vs1, $vs2, $spk, $extra) = $row;
	if ($last_series != 0) {
	    echo <<<EOF
        <tr align="center" class="text">
	  <td width="10" height="4" bgcolor="#CCCCCC">&nbsp;</td>
	  <td width="55" height="4" bgcolor="#CCCCCC"><b>Date</b></td>
	  <td width="170" height="4" bgcolor="#CCCCCC"><b>Message Title</b></td>
	  $scripture_line
	  <td width="103" height="4" bgcolor="#CCCCCC"><b>Speaker</b></td>
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
	$file_line = "";
	if ($mp3) {
	    $file_line .= "<a href=\"audiofiles/$mp3\">file</a>";
	    if ($m3u) { $file_line .= " | "; }
	}
	if ($m3u) {
	    $file_line .= "<a href=\"audiofiles/$m3u\">stream</a>";
	}

	echo <<<EOF
	<tr align="center" class="text"> 
	  <td height=28 bgcolor="#F0F0F0" class="text"><strong><font class="$type">$type</strong></td>
	  <td height=28 bgcolor="#F0F0F0" class="text">$date</td>
	  <td height="28" bgcolor="#F0F0F0">$title<br> $file_line </td>
EOF;

	if ($has_scriptures) { echo "            <td height=28 valign=center bgcolor=\"#F0F0F0\"><nobr>$book</nobr> $ref</td>"; }
	echo <<<EOF
	  <td height=28 bgcolor="#F0F0F0">$spk</td>
        </tr>
EOF;
    }
?>
      </table><br>
      <table width="250" border="0" cellspacing="2" cellpadding="2" class="text" align="right">
        <tr bgcolor="#F0F0F0"> 
	  <td width="5%" align="center" class="S"><b>S</b></td>
	  <td width="95%">indicates Sunday Service message</td>
	</tr>
	<tr bgcolor="#F0F0F0"> 
  	  <td width="5%" bordercolor="#FFFFFF" align="center" class="F"><b>F</b></td>
	  <td width="95%">indicates Friday Night message</td>
	</tr>
	<tr bgcolor="#F0F0F0"> 
  	  <td width="5%" bordercolor="#FFFFFF" align="center" class="P"><b>P</b></td>
	  <td width="95%">indicates Passion Revival Message</td>
	</tr>
	<tr bgcolor="#F0F0F0"> 
	  <td width="5%" bordercolor="#FFFFFF" align="center" class="R"><b>R</b></td>
	  <td width="95%">indicates Retreat message</td>
	</tr>
	<tr bgcolor="#F0F0F0">
	  <td width="5%" bordercolor="#FFFFFF" align="center" class="E"><b>E</b></td>
	  <td width="95%">indicates Easter message</td>
	</tr>
	<tr bgcolor="#FFFF99"> 
	  <td width="5%" bordercolor="#FFFFFF" align="center" class="V"><b>V</b></td>
	  <td width="95%">Indicates Video</td>
	</tr>
      </table><br clear="all">
      <table width=100%> <tr>
          <td><img src="./images/itunes.gif" width=47 height=45> </td>
          <td class="medium"> To play MP3 sermons on your computer, you can use <br>
	    <a href="http://www.apple.com/itunes/" target="_blank">iTunes</a>,
	    <a href="http://www.winamp.com" target="_blank">Winamp</a>,
	    or <a href="http://www.microsoft.com/windows/windowsmedia/default.aspx" target="_blank">Windows Media Player</a>.
	  </td></tr>
      </table>
    </td>
  </tr>
</table>

<?php include('../footer.html'); ?>
