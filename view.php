<?php
require 'navbar.php';
session_start();

if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){
	
require_once('skinc/common.php');
$users= $db->get(PROFILE);

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.1/content/tables/"> -->
       <!-- CSS only -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	 -->
	<title>User View Listing Page</title>
</head>

<body>
	<br>
	 <h2 class="pull-left">Employees Details</h2>
	<a href="form.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>

	<table class="table">
	<thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    
			<?php
			foreach ($users as $key => $value) { ?>
				<tr>
					<td><?php echo $value['id']; ?></td>
					<td><?php echo $value['name']; ?></td>
					<td><?php echo $value['email']; ?></td>
					<td><?php echo $value['phone']; ?></td>
					<td><a href="edit.php?id=<?php echo $value['id']; ?>"><span class="fa fa-pencil"></span></a> &emsp;
						<a href="delete.php?id=<?php echo $value['id']; ?>"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
			<?php }
			?>
		</tbody>
	</table>
</body>
</html>
<?php
} else {header('Location: index.php');
}