<?php # Including the Db class for access to the database, and the EditUserType and ViewUserType classes to display the user types
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_userType.view.php');
    $getUserTypes = new ViewUserType(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit User Type </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Edit User Type </h1> <hr>

<button class="navButton" onclick= "window.location.href='add_userType.php'"> Add a New User Type </button>
<button class="navButton" onclick= "window.location.href='change_userType.php'"> Make Change(s) to a User Type </button>
<br><hr>
<?php # Calls the showUserTypes method to display all user types with the withDelete and withClear parameters set so the delete form is on the webpage
    $getUserTypes->showUserTypes(withDelete, withClear);
?>
</body>
</html>
