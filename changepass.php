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
	include 'library/User.php';
	include 'header.php';
?>

<?php
	if (isset($_GET['id'])) {
		$userId = (int)$_GET['id'];
	}
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updatePass = $user->updatePassword($userId, $_POST);
	}
?>

<!-- User list -->
<div id="user-list" class="mt-2">
	<div class="container">
		<div class="card">
	  	<h5 class="card-header text-left font-weight-bold">Change Password <span class="float-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userId; ?>">Back</a></span></h5>
	  	<div class="card-body">
	  		<div style="max-width: 650px; margin: 0 auto;">

<?php
	if (isset($updatePass)) {
		echo $updatePass;
	}
?>

		  		<form action="" method="POST">
			  		<div class="form-group">
			  			<label for="old_pass">Old Password</label>
			  			<input id="old_pass" type="password" name="old_pass" class="form-control">
			  		</div>
			  		<div class="form-group">
			  			<label for="new_pass">New Password</label>
			  			<input id="new_pass" type="password" name="new_pass" class="form-control"
			  			>
			  		</div>
			  			<button type="submit" name="update" class="btn btn-warning text-light">Update</button>
			  			
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