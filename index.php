<?php
// allowing my servers to display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

// declaring constant in php
define("DB_SERVER","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","Since_feb_2015");
define("DB_NAME","csc293");

// connecting to mysqli server
$mysqli = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_POST['btnLogin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "select * from users where username='$username'";
	$result = $mysqli->query($query);
	if($result->num_rows <= 0){
		exit("invalid username/password");
	}

	// if got to this point, it means username exist in the table
	$result = $result->fetch_assoc();
	$db_password = $result['password'];
	$password = md5($password);

	if($password != $db_password){
		exit("invalid username/password");
	}
 	// if users got to this point, it means they are authenticated users in our database system
	echo "users successfully authenticated";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tutorial</title>
</head>
<body>
	<h1>Login System</h1>

	<form action="" method="post">
		<label>Username</label><br>
		<input type="text" name="username"><br/>
		<br/>
		<label>Password</label><br>
		<input type="password" name="password">
		<br/><br/>
		<a href="register.php" >Register here</a>
		<br><br/>

		<input type="submit" name="btnLogin" value="Login" />

	</form>
</body>
</html>