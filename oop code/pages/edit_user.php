<?php # Include Db, ViewUser and EditUSer classes to connect to the database and be able to display all the users on the webpage
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_user.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_user.view.php');
    # New instsnace of the ViewUsser class to display all users
    $getUsers = new ViewUser(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit User </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Edit User </h1> <hr>

<button class="navButton" onclick= "window.location.href='add_user.php'"> Add A New User </button>
<button class="navButton" onclick= "window.location.href='change_user.php'"> Make Change(s) to a User </button>
<br><hr>
<?php # Call showUsers method with withClear and withDelete parameters set for delete options on
    $getUsers->showUsers(True, True);
?>
</body>
</html>
