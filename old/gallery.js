var numImages = 15;
var galleryfnames =[
'1.jpg',
'a.jpg',
'c.jpg',
'2.jpg',
'3.jpg',
'4.jpg',
'5.jpg',
'd.jpg',
'8.jpg'
];
var galleryimgs = [];
var goodbrowser = true; // @TODO detect really old browsers?
var normal_timeout = 5000;
var long_timeout = 15000; // wait a while if they clicked forward or back
var crossfade_timeout = 50;
var crossfade_duration = 1200;

// shouldn't need to alter after this point.
var imgNum = -1;
var loadedImages = 0;
var timeoutnum = 0;
var timeout = normal_timeout;
var numimgs = galleryfnames.length;

var playImage = new Image();
playImage.src = "images/play.gif";
var stopImage_src = "images/stop.gif";

var cftimeout = 0; // crossfade timeout id, ret val from setTimeout
var cfstepsize = 100 / (crossfade_duration / crossfade_timeout);

function gallery_show(num) {
  _cleartimeout();

  if (goodbrowser) {
    if (cftimeout) {
      cancel_crossfade();
      return;
    }
    document.getElementById('gallerybg').style.backgroundImage = "url("+galleryimgs[imgNum].src+")";
    if (num != imgNum) {
      crossfade_start();
    }
    setTimeout("document.getElementById('gallerydiv').innerHTML = \"<img src='"+galleryimgs[num].src+"' onclick='gallery_next();'>\";", 1); // 1 ms delay
  } else {
    document.getElementById('gallery').src = galleryimgs[num].src;
  }

  preloadImageNum((num+1)%numimgs);
  timeoutnum = setTimeout("gallery_show("+((num+1)%numimgs)+");", timeout);
  timeout = normal_timeout;
  imgNum = num;
}
function gallery_next() {
  timeout = long_timeout;
  gallery_show((imgNum+1)%numimgs);
}
function gallery_prev() {
  timeout = long_timeout;
  gallery_show(imgNum>0 ? imgNum-1 : numimgs-1); // imgNum gets decremented
  preloadImageNum(imgNum>0 ? imgNum-1 : numimgs-1);
}
function gallery_pause() {
  if (!timeoutnum) { // user clicked "play"
    gallery_show(imgNum); // start gallery
    document.images.gallery_stop.src = stopImage_src;
    return;
  }
  _cleartimeout();
  document.images.gallery_stop.src = playImage.src;
}
function _cleartimeout() {
  if (timeoutnum > 0) {
    clearTimeout(timeoutnum);
    timeoutnum = 0;
  }
}
function preloadImageNum(num) {
  if (!galleryimgs[num]) {
    galleryimgs[num] = new Image();
    galleryimgs[num].src = "images/gallery/"+galleryfnames[num];
    loadedImages = imgNum+1;
  }
}

function crossfade_start()
{
  do_crossfade(0+cfstepsize);
}
function do_crossfade(percent)
{
  if (percent>100) { percent=100; }
  changeOpac(percent, 'gallerydiv');
  changeOpac(100-percent, 'gallerybg');
  if (percent<100) {
    cftimeout = setTimeout('do_crossfade('+(percent+cfstepsize)+');', crossfade_timeout);
  } else {
    finish_crossfade();
  }
}
function cancel_crossfade()
{
  clearTimeout(cftimeout);
  do_crossfade(100);
  clearTimeout(cftimeout);
  cftimeout = 0;
}
function finish_crossfade()
{
  cftimeout = 0;
}

imgNum = Math.floor(Math.random()*numimgs);
preloadImageNum(imgNum);
gallery_show(imgNum);  // show img 0 and preload 1.
preloadImageNum(imgNum>0 ? imgNum-1 : numimgs-1); // preload prev

