<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 22; $i++) {
  $days["May $i"] = "1 Kings $i";
}
for($i = 23; $i <= 27; $i++) {
  $chap = $i - 22;
  $days["May $i"] = "1 Thessalonians $chap";
}
for($i = 28; $i <= 30; $i++) {
  $chap = $i - 27;
  $days["May $i"] = "2 Thessalonians $chap";
}
$days["May 31"] = "Proverbs 31";

$YEAR = "2013";

echo_list($days, $YEAR);

?>