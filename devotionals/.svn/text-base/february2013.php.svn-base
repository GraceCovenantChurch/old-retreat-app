<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 16; $i++) {
  $days["February $i"] = "1 Corinthians $i";
}

for($i = 1; $i <= 11; $i++) {
  $d = $i + 16;
  $days["February $d"] = "2 Corinthians $i";
}

$days["February 28"] = "2 Corinthians 12-13";

$YEAR = "2013";

echo_list($days, $YEAR);

?>