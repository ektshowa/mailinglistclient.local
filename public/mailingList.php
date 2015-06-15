<?php

/**
 * Move this PHP script to another file.
 * It will be the action attribute of the form for Post requests.
 * Read request will be done through Ajax 
 */

session_start();
include_once 'apicaller.php';
 
$apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'http://mailinglistmanager.local/');

//This is just testing create, update and read
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == 'create') {
		$data = $_POST;
	}
	$subcsriber = $apicaller->sendRequest(array(
    	'controller' => 'Subscribers',
    	'action' => $_REQUEST['action'],
    	'username' => $_SESSION['username'],
    	'userpass' => $_SESSION['password'],
    	'firstname' => $_POST['firstname'],
    	'lastname' => $_POST['lastname'],
    	'email' => $_POST['email'],
    	'mimetype' => $_POST['mimetype'],
    	'role' => $_POST['role']
	));
}
else {
	$subscriber = $apicaller->sendRequest(array(
		'controller' => 'Subcribers',
    	'action' => 'read',
    	'username' => $_SESSION['username'],
    	'password' => $_SESSION['password'],
	));
}

print_r($subscriber);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mailing List Manager</title>
     
    <link rel="stylesheet" href="css/reset.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css" type="text/css" />
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="jquery-ui/jquery-ui.min.js"></script>
     
    <style>
    body {
        padding-top: 40px;
    }
    #main {
        margin-top: 80px;
    }
     
    .textalignright {
        text-align: right;
    }
     
    .marginbottom10 {
        margin-bottom: 10px;
    }
    
    </style>
     
    
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="index.php">Mailing list manager</a>
            </div>
        </div>
    </div>
    <div id="main" class="container">
        <div class="textalignright marginbottom10">
            <span id="newtodo" class="btn info">Create a new Subscriber</span>
            <div id="newtodo_window" title="Create a new Subscriber">
                <form method="POST" action="mailingList.php">
                    <p>First Name:<br /><input type="text" id="firstname" name="firstname" placeholder="Subscriber First Name" /></p>
                    <p>Last Name:<br /><input type="text" id="lastname" name="lastname" placeholder="Subscriber Last Name" /></p>
                    <p>Email:<br /><input type="email" id="email" name="email"/></p>
                    <p>Mimetype:<br/><select id="mimetype" name="mimetype">
                    					<option value="">Choose One</option>
                    					<option value="H">HTML Email</option>
                    					<option value="T">Text Email</option>
                    				 </select>
                    </p>
                    <p>Subscriber's Role:<br/><select id="role" name="role">
                    					<option value="">Choose One</option>
                    					<option value="admin">Administrator</option>
                    					<option value="regular">Regular</option>
                    				 </select>
                    </p>
                    <input type="hidden" value="create" name="action"/>
                    <div class="actions">
                        <input type="submit" value="Create" name="new_submit" class="btn primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>