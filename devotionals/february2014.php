<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 16; $i++) {
  $days["February $i"] = "1 Corinthians $i";
}

for($i = 1; $i <= 12; $i++) {
  $d = $i + 16;
  $days["February $d"] = "Daniel $i";
}

$YEAR = "2014";

echo_list($days, $YEAR);

?>