#!/usr/bin/perl

$fname = shift;
$phase = 0;
$body = "";
$counttables = 0;

#$_ = $fname;
#s|^\./||;
#s|[^/]*/|\.\./|g;
#s|/[^/]*$|/|;
#$reldir = $_;
#print "reldir $reldir for fname $fname\n";

open(OLDP,"<$fname") or die("ARR");
while (<OLDP>) {
  s|../archive.php|index.php|;
  $body .= $_;
}
close(OLDP);

system("mv $fname $fname".'.bk');

open(NEWP,">$fname") or die("ARR2");
print NEWP $body;
close(NEWP);

print "converted $fname.\n";
