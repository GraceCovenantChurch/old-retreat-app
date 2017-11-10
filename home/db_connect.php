<?php
set_include_path('/usr/local/lib/php');
require_once 'DB.php';	//require the PEAR::DB classes.

$db_engine = 'mysql';
$db_user = 'gccweb';
$db_pass = 'webuser';
$db_host = 'mysql.gracecovenant.net';
$db_name = 'gcc';

$datasource = $db_engine.'://'.$db_user.':'.$db_pass.'@'.$db_host.'/'.$db_name;

$db_object = DB::connect($datasource, TRUE);
/* assign database object in $db_object, if the connection fails $db_object will contain
the error message. */

if(DB::isError($db_object)) {
	die($db_object->getMessage());	// If $db_object contains an error print out the
}							// error and exit.

$db_object->setFetchMode(DB_FETCHMODE_ASSOC);
?>
