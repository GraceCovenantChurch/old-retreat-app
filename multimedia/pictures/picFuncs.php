<?php

function newAlbum($title, $picasalink, $imgsrc, $day, $col)
{
  $NUM_COLS = 4;
  if($col==0) echo "<tr>";
  echo "<td align='center'>";
  start_subbox(175,'orange', $title ,'center','center','');
  echo "<a href=" . $picasalink . " target='_blank'>
        <img width='145' height='145' src=" . $imgsrc . " border='0' style='margin-top: 8px'>
        </a><br>
        <p class='medium' style='color:#888888'>" . $day . "</p>";
  end_subbox('orange','');
  echo "</td>";
  if($col==$NUM_COLS-1){
	echo "</tr>";
	return 0;
  }
  else{
	return $col + 1;
  }
}

function endAlbums($col)
{
  if($col!=0) echo "</tr>";
  echo "</table>";
}

function yearLine($ycurrent)
{
  $ybegin = 2000;
  $yend = 2014;
  echo "<tr>
   	<td colspan='4'>
     	<span align='left'><b>Pictures</b> -  [";
 
  for($count=$ybegin; $count<=$yend; $count++){
	echo "&nbsp;";
	if($count!=$ycurrent){
		echo "<a href='./pictures$count" . ".php'>$count</a>";
	}
	else{
	     	echo "<b>$count</b>";
	}
	echo "&nbsp;";
	if($count<$yend){
		echo "|";
	}
  }

  echo "]</span>
   	</td>
 	</tr>
    	<tr>";
}

?>