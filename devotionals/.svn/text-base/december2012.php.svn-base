<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 24; $i++) {
  $days["December $i"] = "Luke $i";
}

for($i = 1; $i <= 5; $i++) {
  $d = $i + 24;
  $days["December $d"] = "1 Peter $i";
}

$days["December 30"] = "2 Peter 1";
$days["December 31"] = "2 Peter 2-3";

$YEAR = "2012";

echo_list($days, $YEAR);

?>