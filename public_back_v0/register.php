<?php
session_start();
include_once 'apicaller.php';
 
$apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'http://mailinglistmanager.local/');

if (isset($_REQUEST['action'])) {
	//if ($_REQUEST['action'] == 'create') {
	//	$data = $_POST;
	//}
	$subscriber = $apicaller->sendRequest(array(
    	'controller' => 'subscriber',
    	'action' => $_REQUEST['action'],
    	'username' => $_SESSION['register_username'],
    	'password' => $_SESSION['register_password'],
    	'firstname' => $_SESSION['register_firstname'],
    	'lastname' => $_SESSION['register_lastname'],
    	'email' => $_SESSION['register_email'],
	));
}
else {
	//$todo_items['title'] = 'default title';
	//$todo_items['description'] = 'default description';
	//$todo_items['due_date'] = date();
	//$todo_items['is_done'] = FALSE;
	//$subscriber = $apicaller->sendRequest(array(
	//	'controller' => 'subscriber',
    //	'action' => 'read',
    //	'username' => $_SESSION['username'],
    //	'userpass' => $_SESSION['userpass'],
	//));
}

//print_r($subscriber);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email List Manager</title>
     
    <link rel="stylesheet" href="css/reset.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/register.css" type="text/css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="jquery-ui/jquery-ui.min.js"></script>
     
    <style>
    body {
        padding-top: 40px;
    }
    #main {
        margin-top: 80px;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="index.php">Email List Manager</a>
            </div>
        </div>
    </div>
    <div id="main" class="container">
        <form class="form-stacked" method="POST" action="login.php">
            <div class="row" id="register_form_div">
                <div class="span5 offset5">
                	<label for="register_firstname">First Name:</label>
                    <input type="text" id="register_firstname" name="register_firstname" placeholder="First Name" />
                    
                    <label for="register_lastname">Last Name:</label>
                    <input type="text" id="register_lastname" name="register_lastname" placeholder="Last Name" />
                    
                    <label for="register_email">Email:</label>
                    <input type="text" id="register_email" name="register_email" placeholder="Email" />
                                                
                    <label for="register_username">Username <br />(max 16 chars):</label>
                    <input type="text" id="register_username" name="register_username" placeholder="username" />
                 
                    <label for="register_password">Password <br />(between 6 and 16 chars):</label>
                    <input type="password" id="register_password" name="register_password" placeholder="password" />
                    
                    <label for="register_password_conf">Confirm Password:</label>
                    <input type="password" id="register_password_conf" name="register_password_conf" placeholder="password" /> 
                </div>
            </div>
            <div class="actions">
                <button type="submit" name="register_submit" class="btn primary large">Register</button>
            </div>
        </form>
    </div>
</body>
</html>

 