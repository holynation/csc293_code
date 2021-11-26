<?php
// allowing my servers to display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

// this is the mysql code to create the users table

// create table users(
// 	id int(11) not null auto_increment primary key,
//   fullname varchar(50) not null,
//   username varchar(50) not null,
//   password varchar(150) not null,
//   status tinyint(1) not null default '1',
//   date_created timestamp not null default now()
// )

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


// registering the users
if(isset($_POST['btnRegister'])){
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	// validating user password
	if($password != $confirm_password){
		exit("password is not a match to confirm password");
	}

	// encoding the password using md5 function
	$password = md5($password);

	$query = "insert into users (fullname,username,password) values('$fullname','$username','$password')";
	$result = $mysqli->query($query);
	if($mysqli->error){
		exit("Error:".$error);
	}
	echo "users inserted successfully";
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
	<h1>Registration Page</h1>

	<form action="" method="post">
		<label>Fullname</label><br>
		<input type="text" name="fullname">
		<br/><br/>

		<label>Username</label><br>
		<input type="text" name="username"><br/>
		<br/><br/>

		<label>Password</label><br>
		<input type="password" name="password">
		<br/><br/>

		<label>Confirm Password</label><br>
		<input type="password" name="confirm_password">
		<br/><br/>

		<a href="index.php" >Login</a>
		<br><br/>

		<input type="submit" name="btnRegister" value="Register" />
	</form>
</body>
</html>