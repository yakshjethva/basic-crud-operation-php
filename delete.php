<?php
require 'navbar.php';
require_once('skinc/common.php');
session_start();
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
if(isset($_GET) && !empty($_GET)){
	$db->where ('id',$_GET['id']);
if($db->delete(PROFILE)) 
	echo 'successfully deleted';
else
    echo 'update failed: ' . $db->getLastError();
}
?>
<a href="view.php">View Data</a>
<?php
} else {
	header('Location: index.php');
} ?>