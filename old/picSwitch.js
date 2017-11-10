function change1()
{
  document.sun.src = pic1.src;
  document.sun.style.cursor = "pointer";
  pic = 1;
  setTimeout("change2()", 5000);
}

function change2()
{
  document.sun.src = pic2.src;
  document.sun.style.cursor = "default";
  pic = 2;
  setTimeout("change1()", 5000);
}

function change3()
{
  document.sun.src = pic3.src;
  document.sun.style.cursor = "default";
  pic = 3;
  setTimeout("change1()", 5000);
}

function redirect()
{
  if(pic==2){
    return;
  }
  else if(pic==1){
    document.location.href = 'http://site366.mysite4now.com/amichurches/626Mandate/Default.aspx';
  }
  else{
    return;
  }
}

var pic = 1;
setTimeout('change1()', 0);