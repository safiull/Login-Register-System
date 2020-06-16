<?php
	include 'library/User.php';
?>
<?php
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$userLogin = $user->userLogin($_POST);
	}
?>

<?php
	include 'header.php';
	Session::checkLogin();
?>

<!-- User list -->
<div id="user-list" class="mt-2">
	<div class="container">
		<div class="card">
	  	<h5 class="card-header text-left">User Login</h5>
	  	<div class="card-body">
	  		<div style="max-width: 650px; margin: 0 auto;">
<?php 
	if (isset($userLogin)) {
		echo $userLogin;
	}
?>
		  		<form action="" method="POST">
			  		<div class="form-group">
			  			<label for="email">Email Address</label>
			  			<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
			  		</div>
			  		<div class="form-group">
			  			<label for="password">Password</label>
			  			<input type="password" placeholder="Enter your password" name="password" class="form-control">
			  		</div>
			  		<button type="submit" name="login" class="btn btn-success btn-lg">Login</button>
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