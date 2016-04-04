<?php
//LOGIN get the form values
/*
$username = $_POST['login_username'];
$userpass = $_POST['login_password'];
 
 
session_start();
$_SESSION['username'] = $username;
$_SESSION['userpass'] = $userpass;
header('Location: todo.php');*/

session_start();
$_SESSION['register_username'] = $_POST['register_username'];
$_SESSION['register_password'] = $_POST['register_password'];
$_SESSION['register_firstname'] = $_POST['register_firstname'];
$_SESSION['register_lastname'] = $_POST['register_lastname'];
$_SESSION['register_email'] = $_POST['register_email']; 
$_SESSION['action'] = 'create';
header('Location: register.php');