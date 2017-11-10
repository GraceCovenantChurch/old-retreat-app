<?php

include("plan_funcs.php");

$days = array();

$days["January 1-12"] = "Join us for intensive reading in our <a href='http://uc.gracecovenant.net/misc/feast-fast-cal.pdf'>Feasting, Fasting, & Prayer Campaign</a>!";

for($i = 1; $i <= 16; $i++) {
  $days["January $i"] = "Romans $i";
}

for($i = 17; $i <= 30; $i++) {
  $b = $i - 16;
  $days["January $i"] = "Mark $b";
}

$days["January 31"] = "Mark 15-16";

$YEAR = "2014";

echo_list($days, $YEAR);

?>