<?php

date_default_timezone_set("America/New_York");

function prices_get_cost_and_expl(&$explanation, &$expl_ascii, $school = 'SCHOOL')
{  
  // prices and dates
  $EARLY_DATE = 20161218;
  $EARLY_PRICE = 90;

  $NORMAL_DATE = 20170115;
  $NORMAL_PRICE = 105;

  $LATE_PRICE = 120;

  $myDate = date("Ymd");
  if ($myDate < $EARLY_DATE) {
    $price = $EARLY_PRICE;
    $period = "Early Signup  ";
  } else if ($myDate < $NORMAL_DATE) {
    $price = $NORMAL_PRICE;
    $period = "Normal Signup ";
  } else {
    $price = $LATE_PRICE;
    $period = "Late Signup   ";
  }

  $explanation = <<<EOF
  <div style="border: 1px #009900 solid; width:400px">
    <table cellpadding='4' align='center'>
      <tr><td>$period Price: </td><td align=\"right\"> \$$price</td></tr> 
    </table>
  </div>
EOF;
  
  $expl_ascii  = "    +------------------------------+------+\n";
  $expl_ascii .= "    | $period               | " .($price<100?" ":""). "\$$price |\n";
  $expl_ascii .= "    +------------------------------+------+\n";

  return $price;
}
?>
