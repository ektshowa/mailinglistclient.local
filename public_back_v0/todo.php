<?php

/**
 * Move this PHP script to another file.
 * It will be the action attribute of the form for Post requests.
 * Read request will be done through Ajax 
 */

session_start();
include_once 'apicaller.php';
 
$apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'http://api_centric_app/');

if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == 'create') {
		$data = $_POST;
	}
	$todo_items = $apicaller->sendRequest(array(
    	'controller' => 'todo',
    	'action' => $_REQUEST['action'],
    	'username' => $_SESSION['username'],
    	'userpass' => $_SESSION['userpass'],
    	'title' => $_POST['title'],
    	'description' => $_POST['description'],
    	'due_date' => $_POST['due_date'],
    	'is_done' => $_POST['is_done']
	));
}
else {
	//$todo_items['title'] = 'default title';
	//$todo_items['description'] = 'default description';
	//$todo_items['due_date'] = date();
	//$todo_items['is_done'] = FALSE;
	$todoItems = $apicaller->sendRequest(array(
		'controller' => 'todo',
    	'action' => 'read',
    	'username' => $_SESSION['username'],
    	'userpass' => $_SESSION['userpass'],
	));
}

print_r($todo_items);
?>
<!DOCTYPE html>
<html>
<head>
    <title>SimpleTODO</title>
     
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
    #newtodo_window {
        text-align: left;
        display: none;
    }
    </style>
     
    <script>
    $(document).ready(function() {
        $("#todolist").accordion({
            collapsible: true
        });
        $(".datepicker").datepicker();
        $('#newtodo_window').dialog({
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            modal: true
        });
        $('#newtodo').click(function() {
            $('#newtodo_window').dialog('open');
        });
    });
    </script>
</head>
<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <a class="brand" href="index.php">SimpleTODO</a>
            </div>
        </div>
    </div>
    <div id="main" class="container">
        <div class="textalignright marginbottom10">
            <span id="newtodo" class="btn info">Create a new TODO item</span>
            <div id="newtodo_window" title="Create a new TODO item">
                <form method="POST" action="todo.php">
                    <p>Title:<br /><input type="text" class="title" name="title" placeholder="TODO title" /></p>
                    <p>Date Due:<br /><input type="text" class="datepicker" name="due_date" placeholder="MM/DD/YYYY" /></p>
                    <p>Description:<br /><textarea class="description" name="description"></textarea></p>
                    <input type="hidden" value="false" name="is_done" />
                    <input type="hidden" value="create" name="action"/>
                    <div class="actions">
                        <input type="submit" value="Create" name="new_submit" class="btn primary" />
                    </div>
                </form>
            </div>
        </div>
        <div id="todolist">
            <?php foreach($todo_items as $todo): ?>
            <h3><a href="#"><?php echo $todo->title; ?></a></h3>
            <div>
                <form method="POST" action="update_todo.php">
                <div class="textalignright">
                    <a href="delete_todo.php?todo_id=<?php echo $todo->id; ?>">Delete</a>
                </div>
                <div>
                    <p>Date Due:<br /><input type="text" id="datepicker_<?php echo $todo['due_date']; ?>" class="datepicker" name="due_date" value="12/09/2011" /></p>
                    <p>Description:<br /><textarea class="span8" id="description_<?php echo $todo['description']; ?>" class="description" name="description"><?php echo $todo->description; ?></textarea></p>
                </div>
                <div class="textalignright">
                    <?php if( $todo->is_done == 'false' ): ?>
                    <input type="hidden" value="false" name="is_done" />
                    <input type="submit" class="btn" value="Mark as Done?" name="markasdone_button" />
                    <?php else: ?>
                    <input type="hidden" value="true" name="is_done" />
                    <input type="button" class="btn success" value="Done!" name="done_button" />
                    <?php endif; ?>
                    <input type="hidden" value="<?php echo $todo['id']; ?>" name="id" />
                    <input type="hidden" value="<?php echo $todo['title']; ?>" name="title" />
                    <input type="submit" class="btn primary" value="Save Changes" name="update_button" />
                </div>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>