<?php # Including the Db class for access to the database, and the EditStorage and ViewStorage classes to display the storage data
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_storage.view.php');
    $displayStorages = new ViewStorage(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit Storage </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Edit Storage </h1> <hr>

<button class="navButton" onclick= "window.location.href='add_storage.php'"> Add a New Storage </button>
<button class="navButton" onclick= "window.location.href='change_storage.php'"> Make Change(s) to a Storage </button>
<br><hr>
<?php # Calls the showStorages method to display all storages with the withDelete and withClear parameters set so the delete form is on the webpage
    $displayStorages->showStorages(withDelete, withClear);
?>
</body>
</html>


