function change1()
{
  document.sun.src = "images/ugandabanner.jpg";
  document.sun.style.cursor = "pointer";
  pic = 1;
  setTimeout("change2()", 5000);
}

function change2()
{
  document.sun.src = "images/otrbanner.jpg";
  document.sun.style.cursor = "pointer";
  pic = 2;
  setTimeout("change1()", 5000);
}

function redirect()
{
  if(pic==1){
    document.location.href='ministries/missions/summer08/uganda.php';
  }
  else if(pic==2){
    document.location.href='ministries/missions/summer08/otr.php';
  }
  else{
    return;
  }
}

var pic = 1;
setTimeout('change1()', 0);