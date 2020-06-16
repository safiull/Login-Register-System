 <?php

include_once 'Session.php';
include_once 'Database.php';
class User{
	private $db;
	public function __construct(){
		$this->db = new myDataBase();
	}

	public function userRegistration($data){
		$name      = $data['name'];
		$username  = $data['username'];
		$email     = $data['email'];
		$password  = $data['password'];
		$checkEmail = $this->emailCheck($email);

		// Field must not be empty validation
		if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Field must not be empty</div>";
			return $message;
		}

		// Username is too short and you can't use without alphanumerical, dashes and underscores! in your password.
		if (strlen($username) < 3) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Username is too short</div>";
			return $message;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Username must only contain alphanumerical, dashes and underscores</div>";
			return $message;
		}

		// Your email is not valid
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Your email is not valid</div>";
			return $message;
		}

		// The email is already exists
		if ($checkEmail == true ){
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>The email is already exists</div>";
			return $message;
		}

		$password  = md5($data['password']);
		$sql = "INSERT INTO user (name, username, email, password) VALUES(:name, :username, :email, :password)";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':name', $name);
		$query->bindValue(':username', $username);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		$result = $query->execute();
		if ($result) {
			$message = "<div class='alert-success p-3'><strong>Success ! </strong>Thank you! You have been register</div>";
			return $message;
		}else{
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Sorry there has been problem your inserting detail</div>";
		}
	}


	// email validation
	public function emailCheck($email){
		$sql = "SELECT email FROM user WHERE email = :email";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email', $email);
		$query->execute();
		if ($query->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}

	// This code for login
	public function getLoginUser($email, $password){
		$sql = "SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	// for User login
	public function userLogin($data){
		$email     = $data['email'];
		$password  = md5($data['password']);

		$checkEmail = $this->emailCheck($email);

		// Field must not be empty validation
		if ($email == "" OR $password == "") {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Field must not be empty</div>";
			return $message;
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Your email is not valid</div>";
			return $message;
		}

		// The email is already exists
		if ($checkEmail == false ){
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>The email is not exists</div>";
			return $message;
		}

		$result = $this->getLoginUser($email, $password);
		if ($result) {
			Session::init();
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("name", $result->name);
			Session::set("uesrname", $result->uesrname);
			Session::set("loginmsg", "<div class='alert alert-success'><strong>Success ! </strong>You are loggedIn!</div>");
			header("Location: index.php");

		}else{
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Your email or password is incorrect</div>";
			return $message;
		}

	}

	public function userData(){
		$sql = "SELECT * FROM user ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function getUserById($Id){
		$sql = "SELECT * FROM user WHERE id = :id LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id', $Id);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function updateUserData($id, $data){
		$name      = $data['name'];
		$username  = $data['username'];
		$email     = $data['email'];

		// Field must not be empty validation
		if ($name == "" OR $username == "" OR $email == "") {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Field must not be empty</div>";
			return $message;
		}

		// Username is too short and you can't use without alphanumerical, dashes and underscores! in your password.
		if (strlen($username) < 3) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Username is too short</div>";
			return $message;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Username must only contain alphanumerical, dashes and underscores</div>";
			return $message;
		}

		

		$sql = "UPDATE user SET 
					name     = :name,
					username = :username,
					email    = :email
					WHERE id = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':name', $name);
		$query->bindValue(':username', $username);
		$query->bindValue(':email', $email);
		$query->bindValue(':id', $id);
		$result = $query->execute();
		if ($result) {
			$message = "<div class='alert-success p-3'><strong>Success ! </strong>Userdata updated Successfully.</div>";
			return $message;
		}else{
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Userdata not Updated</div>";
		}
	}

	public function checkPassword($id, $old_pass){
		$password = md5($old_pass);
		$sql = "SELECT password FROM user WHERE id = :id AND password = : password";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id', $id);
		$query->bindValue(':password', $password);
		if ($query->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}


	public function updatePassword($id, $data){
		$old_pass = $data['old_pass'];
		$new_pass = $data['new_pass'];
		$chk_pass = $this->checkPassword($id, $old_pass);

		if ($old_pass == "" OR $new_pass == "") {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Field must not be empty</div>";
			return $message;
		}

		
			if ($chk_pass == false) {
				$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Your old password is incorrect</div>";
				return $message;
			}
		
		if (strlen($new_pass < 6)) {
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Your password is too short</div>";
				return $message;
		}

		$password = md5($new_pass);
		$sql = "UPDATE user SET 
					password = :password
					WHERE id = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':password', $password);
		$query->bindValue(':id', $id);
		$result = $query->execute();
		if ($result) {
			$message = "<div class='alert-success p-3'><strong>Success ! </strong>Password Updated successfully.</div>";
			return $message;
		}else{
			$message = "<div class='alert-danger p-3'><strong>Error ! </strong>Password not updated</div>";
		}
	}
}

$obj = new User();
$id = 5;
$pass = 12345;
$obj->checkPassword($id, $pass);
