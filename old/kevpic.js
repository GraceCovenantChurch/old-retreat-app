function change1()
{
  document.sun.src = "images/fnluncovered.jpg";
  document.sun.style.cursor = "pointer";
  pic = 1;
  setTimeout("change2()", 5000);
}

function change2()
{
  document.sun.src = "images/peter1.jpg";
  document.sun.style.cursor = "default";
  pic = 2;
  setTimeout("change1()", 5000);
}

function redirect()
{
  if(pic==1){
    document.location.href='uncovered.php';
  }
  else{
    return;
  }
}

var pic = 2;
setTimeout('change1()', 5000);