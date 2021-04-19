<?php
//database server
define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_DATABASE', "employee");

// table
define('PROFILE', "profile");
		
require_once('skdb.class.php');
// initializing class
 $db = new skdb(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
?>