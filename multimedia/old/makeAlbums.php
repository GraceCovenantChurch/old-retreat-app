<?php

function newAlbum($title, $picasalink, $imgsrc, $day)
{
  echo "<td align='center'>";
  start_subbox(165,'orange', $title ,'center','center','');
  echo "<a href=" . $picasalink . " target='_blank'>
        <img width='145' height='145' src=" . $imgsrc . " border='0' style='margin-top: 8px'>
        </a><br>
        <p class='medium' style='color:#888888'>" . $day . "</p>";
  end_subbox('orange','');
  echo "</td>";
}

function yearLine($ycurrent)
{
  $ybegin = 2000;
  $yend = 2009;
  echo "<tr>
   	<td colspan='3'>
     	<h4 align='left'>Pictures -  [";
 
  for($count=$ybegin; $count<=$yend; $count++){
	echo "&nbsp;";
	if($count!=$ycurrent){
		echo "<a href='./pictures$count" . ".php'>$count</a>";
	}
	else{
	     	echo $count;
	}
	echo "&nbsp;";
	if($count<$yend){
		echo "|";
	}
  }

  echo "]</h4>
   	</td>
 	</tr>
    	<tr>";
}

?>