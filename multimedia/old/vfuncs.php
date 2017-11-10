<?php

function yearLine($ycurrent)
{
  $ybegin = 2000;
  $yend = 2009;
  echo "<tr>
   	<td>
     	<h4 align='left'>Videos - <br>[";
 
  for($count=$ybegin; $count<=$yend; $count++){
	echo "&nbsp;";
	if($count!=$ycurrent){
		echo "<a href='./videos$count" . ".php'>$count</a>";
	}
	else{
	     	echo $count;
	}
	echo "&nbsp;";
	if($count<$yend){
		echo "|";
	}
  }

  echo "]</h4>";
}

function addLink($dir, $file, $title)
{
  echo "<a href='" . $dir . "/" . $file . "'>" . $title . "</a>";
}

function addLink2($file, $title)
{
  echo "<a href='" . $file . "' target='_blank'>" . $title . "</a>";
}

?>