<?php
require 'navbar.php';
require_once(__DIR__.'/skinc/common.php');
session_start();
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
if(isset($_GET['id'])){
	$db->where ("id", $_GET['id']);
}
$users = $db->getOne(PROFILE); //contains an Array of all users

$hobbies = explode(':',$users['hobbies']);

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS only -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body>
	<br>
<div class="container">
	<form method="post" enctype="multipart/form-data" action="update.php">
	<!-- name -->
	<div class="row">
		<div class="col-sm">
			<div class="form-group">
				<input type="text" name="name" value="<?php echo $users['name'] ?>" class="form-control" placeholder="Enter Name *" />
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
				<input type="text" name="email" value="<?php echo $users['email'] ?>" class="form-control" placeholder="Enter Email *" />
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
				<input type="text" name="phone" value="<?php echo $users['phone'] ?>" class="form-control" placeholder="Enter Phone *" />
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
						<option value="be" <?php if ($users['education'] == 'be'){ echo "selected";} ?>>BE</option>
					  	<option value="btech" <?php if ($users['education'] == 'btech'){ echo "selected";} ?>>BTech</option>
					  	<option value="bca" <?php if ($users['education'] == 'bca'){ echo "selected";} ?>>BCA</option>
					 	<option value="mca" <?php if ($users['education'] == 'mca'){ echo "selected";} ?>>MCA</option>
					</select> 
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
		        	<input type="radio" class="form-check-input" name="gender" value="male" <?php if ($users['gender'] == 'male'){ echo "checked";} ?>><label class="form-check-label">Male</label>
    		</div>
			<div class="form-check-inline">
		      <label class="form-check-label" for="radio2">
					<input type="radio" class="form-check-input" name="gender" value="female" <?php if ($users['gender'] == 'female'){ echo "checked";} ?>><label class="form-check-label">Female</label>
				</label>
		    </div>
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
	    	<input type="checkbox" name="hobbies[]" <?php if (in_array('cricket',$hobbies)){ echo "checked";} ?> value="cricket">
						<label for="cricket"> Cricket</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" <?php if (in_array('dancing',$hobbies)){ echo "checked";} ?> value="dancing">
						<label for="dancing"> Dancing</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" <?php if (in_array('singing',$hobbies)){ echo "checked";} ?> value="singing">
							<label for="singing"> Singing</label>
	    </div>
	    <div class="form-check-inline">
	      <input type="checkbox" name="hobbies[]" <?php if (in_array('reading',$hobbies)){ echo "checked";} ?> value="reading">
							<label for="reading"> Reading</label>
		</div>
	    <label class="form-check-label" for="radio2">(Select minimum 2 hobbies)</label>
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
    </div>
	</div>
  <br>
  <button type="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
  </div>
  <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
</div>
</form>
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
