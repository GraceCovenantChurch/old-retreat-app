<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 28; $i++) {
  $days["April $i"] = "Acts $i";
}
for($i = 29; $i <= 30; $i++) {
  $psalm_chap = $i - 28;
  $days["April $i"] = "Psalm $psalm_chap";
}

$YEAR = "2012";

echo_list($days, $YEAR);

?>