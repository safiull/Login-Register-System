<?php
	include_once 'library/Session.php';
	
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

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand font-weight-bold" href="index.php">Login Register System & PDO</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav ml-auto">

<?php
	$id = Session::get("id");
	$userlogin = Session::get("login");
	if ($userlogin == true) {
		
	
?>

	      <li class="nav-item active">
	        <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="?action=logout">Logout</a>
	      </li>
<?php
 }else{
?>
	      <li class="nav-item">
	        <a class="nav-link" href="login.php">Login</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="register.php">Register</a>
	      </li>
<?php
}
?>
	    </ul>
	  </div>
	</div>
</nav>
</body>
</html>