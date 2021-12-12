<?php # Including the Db class for access to the database, and the EditOwner and ViewOwner classes to display the owner data
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_owner.view.php');
    $viewOwners = new ViewOwner(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit Owner </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>

<h1> View/Edit Owner </h1> <hr>
<button class="navButton" onclick= "window.location.href='add_owner.php'"> Add a New Owner </button>
<button class="navButton" onclick= "window.location.href='change_owner.php'"> Make Change(s) to an Owner </button>
<br><hr>
<?php # Calls the showOwners method to display all owners with the withDelete and withClear parameters set so the delete form is on the webpage
    $viewOwners->showOwners(withDelete, withClear);
?>
</body>
</html>
