<?php
if(isset($_POST['username'])){
	require_once('skinc/common.php');
	global $db;

    $canLogin = true;

    if(empty($_POST['username'])) {
        $usernameErr =  "Enter username";
        $canLogin = false;
    }

    if(empty($_POST['password'])) {
        $passwordErr =  "Enter password";
        $canLogin = false;
    }

    if($canLogin) {
    	if(isset($_POST['username'])){
    		$db->where ("password", $_POST['password']);
    		$db->where ("username", $_POST['username']);
    	}
    	$users = $db->getOne('login');
    	if(!empty($users)){
    		session_start();
    		$_SESSION["username"] = $_POST['username'];
    		header('Location: index.php');
    	}else{
            $loginErr = "Username or Password is Incorrect.";
    	}
    }
}else{
	session_start();
}
if(isset($_SESSION["username"]) && $_SESSION["username"] != ''){ require 'navbar.php';?>
    <br>
    <body>
        <div class="col-sm-12 text-center">
            <a href="form.php"><button class="btn btn-primary btn-md">Insert Data</button></a>
            <a href="view.php"><button class="btn btn-primary btn-md">View Data</button></a>
        </div>
    </body>
    
    
        
	

<?php }else{ ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
    </head>
    <body>
        <form method="post" name="login">
        <div class="container-fluid">
        <div class="back">
        <div class="div-center">
            <div class="content">
                <h3>Login</h3>
                <hr />
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" name="username" class="form-control" id="" placeholder="Username">
                        <?php echo isset($usernameErr) ? '<br>'.$usernameErr : ''; ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="Password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <?php echo isset($passwordErr) ? '<br>'.$passwordErr : ''; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <?php echo isset($loginErr) ? '<br>'.$loginErr : ''; ?>
            </div>
            </span>
        </div>
        </form>
    </body>
</html>
<?php }
?>