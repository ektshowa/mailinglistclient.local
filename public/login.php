<?php
//get the form values
$email = $_POST['email'];
$password = $_POST['password'];
 
//TODO: Authenticate the User and check is role to determine which action he is 
// allowed to take. Create a security token 
 
session_start();
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
header('Location: mailingList.php');
exit();