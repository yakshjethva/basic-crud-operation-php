<?php
require 'navbar.php';
require_once('skinc/common.php');
global $db;
session_start();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
if(isset($_POST) && !empty($_POST))
{	
	$canSubmit = true;
	if(empty($_POST['name'])) {
		$nameErr = "Name is required field";
		$canSubmit = false;
	} else {
		$name = test_input($_POST["name"]);
    	// check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
	      $nameErr = "Only letters and white space allowed";
	      $canSubmit = false;
	    }
	}

	if(empty($_POST['email'])) {
		$emailErr = "Email is required field";
		$canSubmit = false;
	} else{
		$email = test_input($_POST["email"]);
	    // check if e-mail address is well-formed
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      $emailErr = "Invalid email format";
	      $canSubmit = false;
	    }
	}

	if(empty($_POST['phone'])) {
		$phoneErr = "Phone is required field";
		$canSubmit = false;
	} else{
		$phone = test_input($_POST["phone"]);
	    // check if e-mail address is well-formed
	    if (!preg_match("/^[0-9]{10}$/",$phone)) {
	      $phoneErr = "Enter valid Phone number.";
	      $canSubmit = false;
	    }
	}

	if(empty($_POST['education'])) {
		$educationErr = "Education is required field";
		$canSubmit = false;
	}

	if(empty($_POST['gender'])) {
		$genderErr = "Gender is required field";
		$canSubmit = false;
	}

	if(empty($_POST['hobbies'])) {
		$hobbiesErr = "Hobbies are required field";
		$canSubmit = false;
	} else if(count($_POST['hobbies']) < 2) {
		$hobbiesErr = "Select minimum 2 hobbies";
		$canSubmit = false;
	}

	if($_FILES['file']['size'] <= 0){
		$fileErr = "Please Upload your file.";
		$canSubmit = false;	
	}

if($canSubmit) {
	if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'. $_FILES["file"]['name'])) {
	   $file_name = $_FILES["file"]['name'];  
	} else {
	   $file_name = '';
	}
	$insert = array(
		'name'	=> $_POST['name'],
		'email'	=> $_POST['email'],
		'phone'	=> $_POST['phone'],
		'education'	=> $_POST['education'],
		'gender'	=> $_POST['gender'],
		'hobbies'	=> implode(':',$_POST['hobbies']),
		'image' => $file_name,
	);
	$id = $db->insert (PROFILE , $insert);
	if($id){
		echo 'user is created. Id=' . $id;
	}else 
	{
	   	$db -> getLastError();
	}	
}
}

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS only -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<style>
			span {color: red;}
		</style>
</head>
<body>
	
<div class="container">

	<br>
	<form method="post" enctype="multipart/form-data" >
	<!-- name -->
	<div class="row">
		<div class="col-sm">
			<div class="form-group">
				<input type="text" name="name" value = "<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>" class="form-control" placeholder="Enter Name *" />
				<span><?php echo isset($nameErr) ? '<br>'.$nameErr : ''; ?></span>
        	</div>
    	</div>
	    <div class="col-sm">
			<LABEL>(*required)</LABEL>
	    </div>
  	</div>

	<!-- email -->
	<div class="row">
		<div class="col-sm">
			<div class="form-group">
				<input type="text" value = "<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" name="email" class="form-control" placeholder="Enter Email *" />
				<span><?php echo isset($emailErr) ? '<br>'.$emailErr : ''; ?></span>
			</div>
		</div>
		<div class="col-sm">
    		<LABEL>(*required) </LABEL>
    	</div>
  	</div>

<!-- phone -->
	<div class="row">
		<div class="col-sm">
			<div class="form-group">
				<input type="text" name="phone" value = "<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : ''; ?>" class="form-control" placeholder="Enter Phone *" />
				<span><?php echo isset($phoneErr) ? '<br>'.$phoneErr : ''; ?></span>
			</div>
		</div>
		<div class="col-sm">
			<LABEL>(*required)</LABEL>
		</div>
	</div>

  <!-- education -->
	<div class="row">
	    <div class="col-sm">
			<select name="education">
						<option value="none">Select an Education</option>
						<option value="be" <?php if(isset($_POST['education'])) {if ($_POST['education'] == 'be'){ echo "selected";} } ?>>BE</option>
					  	<option value="btech" <?php if(isset($_POST['education'])) {if ($_POST['education'] == 'btech'){ echo "selected";} } ?>>BTech</option>
					  	<option value="bca" <?php if(isset($_POST['education'])) { if ($_POST['education'] == 'bca'){ echo "selected";} } ?>>BCA</option>
					 	<option value="mca" <?php if(isset($_POST['education'])) { if ($_POST['education'] == 'mca'){ echo "selected";} } ?>>MCA</option>
					</select>
					<span><?php echo isset($educationErr) ? '<br>'.$educationErr : ''; ?> <span>
		</div>
	    <div class="col-sm">
	    	<LABEL>(*required)</LABEL>
	    </div>
	</div>

<br>

<!-- gender -->
	<div class="row">
		<div class="col-sm">
			<div class="form-check-inline">
				<label class="form-check-label" for="radio2">Select gender
				</label>
    		</div>
	    	<div class="form-check-inline">
				<label class="form-check-label" for="radio1">
		        	<input type="radio" class="form-check-input" name="gender" value="male" <?php if(isset($_POST['gender'])) {if ($_POST['gender'] == 'male'){ echo "checked";}} ?>><label class="form-check-label">Male</label>
    		</div>
			<div class="form-check-inline">
		      <label class="form-check-label" for="radio2">
					<input type="radio" class="form-check-input" name="gender" value="female" <?php if(isset($_POST['gender'])) {if ($_POST['gender'] == 'female'){ echo "checked";} }?>><label class="form-check-label" >Female</label>
				</label>
		    </div>
		    <span><?php echo isset($genderErr) ? '<br>'.$genderErr : ''; ?></span>
    	</div>
	</div>
<br>

	<!-- hobbie -->
	<div class="row">
		
	    <div class="col-sm">
	    	<div class="form-check-inline">
	      <label class="form-check-label">Chooose hobbies
	      </label>
		</div>
	   	<div class="form-check-inline">
	    	<input type="checkbox" name="hobbies[]" value="cricket" <?php if(isset($_POST['hobbies'])) {if (in_array('cricket',$_POST['hobbies'])){ echo "checked";} } ?>>
						<label for="cricket"> Cricket</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" value="dancing" <?php if(isset($_POST['hobbies'])) {if (in_array('dancing',$_POST['hobbies'])){ echo "checked";} }?>>
						<label for="dancing"> Dancing</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" value="singing" <?php if(isset($_POST['hobbies'])) {if (in_array('singing',$_POST['hobbies'])){ echo "checked";} }?>>
							<label for="singing"> Singing</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" value="reading" <?php if(isset($_POST['hobbies'])) {if (in_array('reading',$_POST['hobbies'])){ echo "checked";} }?>>
							<label for="reading"> Reading</label>
		</div>
	    <label class="form-check-label" for="radio2">(Select minimum 2 hobbies)</label>
	    <span><?php echo isset($hobbiesErr) ? '<br>'.$hobbiesErr : ''; ?></span>
      <br>
      <br>	
    <div class="row">
    	<div class="col-sm">
	    	<div class="custom-file">
	    		<input type="file" name="file" id="file" accept=" .doc , .pdf">
	    		<a target="_blank" href="uploads/<?php echo $users['image']; ?>">File</a>
		    
    	</div>
    </div>
    <div class="col-sm">
    	<LABEL>.pdf and .docx only</LABEL>
    	<span><?php echo isset($fileErr) ? '<br>'.$fileErr : ''; ?></span>
    </div>
	</div>
  <br>
  <button type="submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
  </div>


</form>

</div>
</br>
<div class="row">
	    <div class="col-sm">
			<a href="view.php"><button class="btn btn-primary btn-lg">View Data</button></a>
		</div>
</div>
	
</body>
</html>
<?php 
} else {
	header('Location: index.php');
}