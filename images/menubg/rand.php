<?php /**/ ?><?php
// thanks to http://blog.rd2inc.com/archives/2004/12/29/cache_dynamic_images/
$numimages = 6;
$rand = rand(1,$numimages);


$path = './'.$rand.'.jpg';
$uniqueid = 'randbg'.$rand.'jpg';
// Grab all the HTTP headers since If-None-Match and If-Modified-Since are not grabbed by the globals
$lastupdate = date("r", filemtime($path)); // Wed, 07 Oct 2007 03:22:55 +0200
$ifmodifiedsince = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;
$ifnonematch = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : false;

$usecache = 1;
if(!$ifmodifiedsince && !$ifnonematch) $usecache = 0; // @NOTE $usecache always gets set to 0 here. =(
if($ifnonematch && $ifnonematch != $etag) $usecache = 0;
if($ifmodifiedsince && $ifmodifiedsince != $lastupdate) $usecache = 0;
// Check the If-None-Match and If-Modified-Since headers
//if ((strpos($headers['If-None-Match'], $uniqueid)) && ($lastupdate == $headers['If-Modified-Since'])) {
if ($usecache) {
  // They already have the most up to date copy of the image so tell them
  header('HTTP/1.1 304 Not Modified');
  header("Cache-Control: private");
  // Turn off the no-cache pragma, expires and content-type header
  header("Pragma: ");
  header("Expires: ");
  header("Content-Type: ");
  // The Etag must be enclosed with double quotes
  header('ETag: "asset-'.$uniqueid.'"');
  exit;
} else {
  // They need a new copy of the image so open it up
  $fh = fopen($path, 'rb');
  // Set the content-type to something like image/jpeg and set the length
  header("Content-Type: image/jpeg");
  header("Content-Length: ".filesize($path));
  // Change php"s default caching mechanisms
//header("Cache-Control: private");
//header("Pragma: ");
//header("Expires: ");
  // Send the browser the last modified date and etag so they can cache it
//header("Last-Modified: ".$lastupdate);
  //header('ETag: "asset-'.$uniqueid.'"');
  // Dump all the image data back to the browser
  fpassthru($fh);
}
header("Content-Type: image/jpeg");
header("Content-Length: ".filesize($path));
fpassthru($fh);
?>
