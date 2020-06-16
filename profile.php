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
		$updateUser = $user->updateUserData($userId, $_POST);
	}
?>

<!-- User list -->
<div id="user-list" class="mt-2">
	<div class="container">
		<div class="card">
	  	<h5 class="card-header text-left font-weight-bold">User list <span class="float-right"><a class="btn btn-primary" href="index.php">Back</a></span></h5>
	  	<div class="card-body">
	  		<div style="max-width: 650px; margin: 0 auto;">
<?php
	if (isset($updateUser)) {
		echo $updateUser;
	}
?>
<?php
	$userdata = $user->getUserById($userId);
	if ($userdata) {
?>
		  		<form action="" method="POST">
			  		<div class="form-group">
			  			<label for="name">Your Name</label>
			  			<input type="text" name="name" class="form-control" value="<?php echo $userdata->name; ?>">
			  		</div>
			  		<div class="form-group">
			  			<label for="username">Username</label>
			  			<input type="text" name="username" class="form-control" value="<?php echo $userdata->username; ?>">
			  		</div>
			  		<div class="form-group">
			  			<label for="email">Email Address</label>
			  			<input type="email" name="email" class="form-control" value="<?php echo $userdata->email; ?>">
			  		</div>

			  			<button type="submit" name="update" class="btn btn-warning text-light">Update</button>
			  			<a class="btn btn-secondary" href="changepass.php?id=<?php echo $userId; ?>">Change Password</a>
		  		</form>

<?php
	}
?>
		  	</div>
			</div>
		</div>
	</div>
</div>







<script src="inc/jquery.min.js"></script>
<script src="inc/bootstrap.min.js"></script>

</body>
</html>