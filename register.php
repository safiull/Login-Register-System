<?php
	include 'library/User.php';
?>
<?php
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
		$userReg = $user->userRegistration($_POST);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css">
	<title>Login Register System PHP</title>
	<style>
		label{
			font-weight: bold;
		}
	</style>
</head>
<body>

<?php
	include 'header.php';
?>

<!-- User list -->
<div id="user-list" class="mt-2">
	<div class="container">
		<div class="card">
	  	<h5 class="card-header text-left">User Registration</h5>
	  	<div class="card-body">
	  		<div style="max-width: 650px; margin: 0 auto;">
<?php 
	if (isset($userReg)) {
		echo $userReg;
	}
?>

		  		<form action="" method="POST">
			  		<div class="form-group">
			  			<label for="name">Your Name</label>
			  			<input type="text" name="name" class="form-control" placeholder="Enter your name">
			  		</div>
			  		<div class="form-group">
			  			<label for="username">Username</label>
			  			<input type="text" name="username" class="form-control" placeholder="Enter your username">
			  		</div>
			  		<div class="form-group">
			  			<label for="email">Email Address</label>
			  			<input type="email" name="email" class="form-control" placeholder="Enter your email">
			  		</div>
			  		<div class="form-group">
			  			<label for="password">Password</label>
			  			<input type="password" placeholder="Enter your password" name="password" class="form-control">
			  		</div>
			  		<button type="submit" name="register" class="btn btn-info btn-lg">Register</button>
		  		</form>
		  	</div>
			</div>
		</div>
	</div>
</div>







<script src="inc/jquery.min.js"></script>
<script src="inc/bootstrap.min.js"></script>

</body>
</html>