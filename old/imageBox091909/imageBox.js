var selected = 0;
function change(num){
  document.bigpic.src=imgsrcs[num];
  if(urls[num]!=''){
     document.getElementById('imagediv').className="pointerStyle";
  }
  else
  {
     document.getElementById('imagediv').className="defaultStyle";
  }
  if(captions[num]==''){
     document.getElementById('captionbox').className="captioningOFF";
     document.getElementById('captionboxbg').className="captioningOFF";
     document.getElementById('captioningtext').className="captiontextOFF";
     document.getElementById('captioningtextbg').className="captiontextOFF";
  }
  else
  {
     document.getElementById('captionbox').className="captioningON";
     document.getElementById('captionboxbg').className="captioningON";
     document.getElementById('captioningtext').className="captiontextON";
     document.getElementById('captioningtextbg').className="captiontextON";
  }
  if(infront[num]==''){
     document.getElementById('infront').className="infrontOFF";
     document.getElementById('infrontbg').className="infrontOFF";
  }
  else
  {
     document.getElementById('infront').className="infrontON";
     document.getElementById('infrontbg').className="infrontON";
  }
  document.getElementById('captioningtext').innerHTML=captions[num];
  document.getElementById('infront').innerHTML=infront[num];
  st = 'pic'+selected;
  st2 = 'pic'+num;
  if(num!=selected){
    document.getElementById(st).className = "transON";
    document.getElementById(st2).className = "transOFF";
    selected = num;
  }
}
function preloadpics(){
  for(x=0; x<imgsrcs.length; x++){
    psrcs = new Image();
    psrcs.src = imgsrcs[x];
  }
}
function initialize(){
  document.getElementById('pic0').className="transOFF";
  change(0);
  tid=setTimeout('auto(0)', 4000);
}
function mOut(n){
  str = 'pic'+n;
  if(n!=selected){
    document.getElementById(str).className = "transON";
  }
}
function redirect(){
  if(urls[selected]!=''){
    document.location.href=urls[selected];
  }
}
function auto(x){
  nn = nextnum(x);
  change(nn);
  tid = setTimeout('auto(nn)', 4000);
}
function nextnum(c){
  if(c==urls.length-1){
    return 0;
  }
  else{return c+1;}
}
function clickChange(num){
  clearTimeout(tid);
  change(num);
}
