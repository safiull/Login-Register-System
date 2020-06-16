<?php
	include 'library/Session.php';
	Session::init();
	Session::checkSession();
	include 'library/Database.php';
	include 'library/User.php';
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css">
	<title>Login Register System PHP</title>
</head>
<?php
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy();
	}
?>
<body>

<?php
	include 'header.php';
?>


<div class="container">
<?php
	$loginmsg = Session::get("loginmsg");
	if (isset($loginmsg)) {
		echo "$loginmsg";
	}
	Session::set("loginmsg", NULL);
?>
</div>
<!-- User list -->
<div id="user-list" class="mt-2">
	<div class="container">
		<div class="card">
	  	<h5 class="card-header text-left">User list <span class="float-right">Welcome! <strong>
	  		<?php
	  			$name = Session::get("name");
	  			if (isset($name)) {
	  				echo $name;
	  			}
	  		?>
	  		</strong> 
	  	</span></h5>
	  	<div class="card-body">

		  	<table class="table table-striped table-hover">
			  	<thead class="thead-dark">
						<tr>
							<th>Serial</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email Address</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	$user = new User();
	$userdata = $user->userData();
	if ($userdata) {
		$i = 0;
		foreach ($userdata as $data) {
			$i++;

?>
 						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td><?php echo $data['username']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td>
								<a class="btn btn-info" href="profile.php?id=<?php echo $data['id']; ?>">View</a>
							</td>
						</tr>
<?php
	}
}else{
	echo "No user data here";
}
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="inc/jquery.min.js"></script>
<script src="inc/bootstrap.min.js"></script>

</body>
</html>