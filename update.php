<?php
session_start();
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
require_once(__DIR__.'/skinc/common.php');
if(isset($_POST) && !empty($_POST)){
	if (!move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'. $_FILES["file"]['name'])) {
	   $file_name = $_FILES["file"]['name'];  
	} else {
	   $file_name = '';
	}
	$update = array(
		'name'	=> $_POST['name'],
		'email'	=> $_POST['email'],
		'phone'	=> $_POST['phone'],
		'education'	=> $_POST['education'],
		'gender'	=> $_POST['gender'],
		'hobbies'	=>implode(':',$_POST['hobbies']),
		'image' => $file_name,
	);
	$db->where ('id',$_POST['id']);
if ($db->update (PROFILE, $update))
    echo $db->count . ' records were updated.<br><a href="View.php" >View </a> <br> <a href="logout.php">logout</a>';
	
else
    echo 'update failed: ' . $db->getLastError();

}
} else {
	header('Location: index.php');
}

?>