<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 28; $i++) {
  $days["November $i"] = "Acts $i";
}

for($i = 29; $i <= 30; $i++) {
  $b = $i - 15;
  $days["November $i"] = "Psalm $b";
}

$YEAR = "2013";

echo_list($days, $YEAR);

?>