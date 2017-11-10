#!/usr/bin/perl

$fname = shift;
$phase = 0;
$body = "";
$counttables = 0;

$_ = $fname;
s|^\./||;
s|[^/]*/|\.\./|g;
s|[^/]*$||;
$reldir = $_;
$reldir = '../'.$reldir;
print "reldir $reldir for fname $fname\n";

open(OLDP,"<$fname") or die("ARR");
while (<OLDP>) {
  s|include\('|include\('$reldir|g;
  s|include\("|include\("$reldir|g;
  if ($phase==0) {
    if (/middle\.jpg/) {
      $phase++; #go to phase 1 or 2 (see below)
      $body .= <<EOF;
<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>

<table width="556" height="100%" cellspacing="8">
 <tr>
  <td>
EOF
      $counttables += s/<table/<table/g;
      $counttables -= s|</table|</table|g;
      if ($counttables == 1) {
	$phase++; # go to phase 2
      } else {
	print "initial line has $counttables != 1 table(s): \n".$_;
      }
    }
  } elsif ($phase==1) {
    $counttables += s/<table/<table/g;
    $counttables -= s|</table|</table|g;
    if ($counttables == 1) {
      $phase++; # go to phase 2
    }
    print $_;
  } elsif ($phase==2) {
    $counttables += s/<table[^>]*>//g; # delete start-tables, but count them
    $counttables -= s|</table[^>]*>||g; # delete end-tables, but count them
    s|</?t[drh][^>]*>||g; #strip table-related items.
    s|</?font[^>]*>||g; #strip font-related stuff.
    s|&nbsp;||g; #strip nbsp's, probably
    if (/[^\s]/) {
      $body .= $_;
    }
    if ($counttables == -1) {
      $phase++;
    }
  } elsif ($phase==3) {
    print $_;
  }
}
$body .= <<EOF2;
<?php include('../footer.html'); ?>
  </td>
 </tr>
</table>
</HTML>

EOF2

close(OLDP);

system("mv $fname $fname".'.bk');

open(NEWP,">$fname") or die("ARR2");
print NEWP $body;
close(NEWP);

print "converted $fname.\n";
