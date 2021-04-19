<?php
require_once(__DIR__.'/skinc/common.php');
session_start();
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
if(isset($_POST) && !empty($_POST)){
	$insert = array(
		'name'	=> $_POST['name'],
		'lname'	=> $_POST['email'],
		'cno'	=> $_POST['phone'],
		'gender'	=> $_POST['education'],
		'city'	=> $_POST['gender'],
		'vehicle'	=> implode(':',$_POST['hobbies']),
		
	);
	
	$id = $db->insert (USER, $insert);
	if($id)
	    echo 'user was created. Id=' . $id;	
}

} else {
	header('Location: index.php');
}
?>
