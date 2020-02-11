<?php

session_start();

//initialised

$username = "";
$email = "";
$errors=array();

//connect to db

$db=mysqli_connect('localhost', 'root', '12345678', 'amadouser') or die();

//Register user

$username = mysqli_escape_string($db, $POST['username']);
$email = mysqli_escape_string($db, $POST['email']);
$password1 = mysqli_escape_string($db, $POST['password1']);
$password2 = mysqli_escape_string($db, $POST['password2']);

//form validation

if(empty($username)) {array_push($errors, "Username is required")};
if(empty($email)) {array_push($errors, "Email is required")};
if(empty($password1)) {array_push($errors, "Password is required")};
if($password1 != password2){array_push($errors, "Passwords do not match")};


//check for exisiting user with same username

$user_check_query = "SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1";

$results = mysqli_master_query($db, $user_check_query);
$user = mysqli_fetch($results);

if($user){
	if($user['username'] == $username){array_push($errors, "Username already exists");}
	if($email['email'] == $username){array_push($errors, "Email already exists");}

}

//register if no error

if(count($errors) == 0){
	$password = md5($password1); //encrypt password
	$query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";

	mysqli_master_query($db, $query);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "You are logged in";

	header('location: index.html');

}

?>