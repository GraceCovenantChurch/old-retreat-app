var selectedmenu = 'none'; // so mouseout knows which to hide
var selectedsub = 'none';
var delayedHideTimeout = 0;
var fadingTimeout = 0;
var opacity = 100;

function mouseover_sub(page) {
  if (delayedHideTimeout > 0) {
    clearTimeout(delayedHideTimeout);
    delayedHideTimeout = 0;
  }
  if (fadingTimeout > 0) {
    clearTimeout(fadingTimeout);
    fadingTimeout = 0;
    changeOpac(100,selectedmenu+'_sub');
  }
  if (selectedsub != 'none') {
    var black = '#000000';
    document.getElementById(selectedsub).style.color = black;
  }
  document.getElementById(page).style.color = 'white';
  selectedsub = page;
}
function mouseout_sub() {
  mouseout(true);
}
function mouseclick_sub() {
  window.location='/'+selectedmenu+'/'+selectedsub+'.php';
}
function mouseover(menuname) {
  var orange = '#fea000';
  if (delayedHideTimeout > 0) {
    clearTimeout(delayedHideTimeout);
    delayedHideTimeout = 0;
  }
  if (fadingTimeout > 0) {
    clearTimeout(fadingTimeout);
    fadingTimeout = 0;
    changeOpac(100,selectedmenu+'_sub');
  }
  if (selectedmenu != 'none') {
    _realmouseout(selectedmenu);
  }
  document.getElementById(menuname).style.backgroundColor = orange;
  document.getElementById(menuname+'_sub').style.display = 'block';
  selectedmenu = menuname;
}
function mouseout(subout) {
  delayedHideTimeout = setTimeout('_realmouseout("'+selectedmenu+'")',840);
  //if (subout) {
    fadingTimeout = setTimeout('_fadeOutSub("'+selectedmenu+'_sub");',50);
    opacity = 100;
  //}
}
function _fadeOutSub(fadingmenu) {
  opacity -= 6;
  changeOpac(opacity,fadingmenu);
  if (opacity > 0) {
    fadingTimeout = setTimeout('_fadeOutSub("'+fadingmenu+'")',50);
  } else {
    fadingTimeout = 0;
  }
}
//change the opacity for different browsers
function changeOpac(opacity, id) {
    var object = document.getElementById(id).style;
    object.opacity = (opacity / 100);
    object.MozOpacity = (opacity / 100);
    object.KhtmlOpacity = (opacity / 100);
    object.filter = "alpha(opacity=" + opacity + ")";
}
function _realmouseout(lastmenu) {
  var gold = '#fed201';
  var black = '#000000';
  document.getElementById(lastmenu).style.backgroundColor = 'transparent';
  document.getElementById(lastmenu+'_sub').style.display = 'none';
  if (selectedsub != 'none') {
    document.getElementById(selectedsub).style.color = black;
  }
  if (fadingTimeout > 0) {
    clearTimeout(fadingTimeout);
    fadingTimeout = 0;
  }
  changeOpac(100,selectedmenu+'_sub');
  selectedmenu = 'none';
  selectedsub = 'none';
}
function mouseclick() {
  window.location = '/'+selectedmenu+'/';
}
//var numimgs = 8;
//var menubg = new Image();
//menubg.src = '/images/menubg/'+(Math.floor(Math.random()*numimgs)+1)+'.jpg';
function onLoad() {
  //document.getElementById('imagebg').style.backgroundImage = "url("+menubg.src+")";
}

//Google tracking code
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-10628559-2']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();