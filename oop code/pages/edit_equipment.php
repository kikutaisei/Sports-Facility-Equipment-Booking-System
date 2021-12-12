<?php # Including the Db class for access to the database, and the EditEquipment and ViewEquipment classes to display the equipment
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_equipment.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_equipment.view.php');
    $getEquipment = new ViewEquipment(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Equipment </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Equipment </h1> <hr>

<button class="navButton" onclick= "window.location.href='add_equipment.php'"> Add New Equipment </button>
<button class="navButton" onclick= "window.location.href='change_equipment.php'"> Make Change(s) to Equipment </button>
<br><hr>
<?php # Calls the showStorages method to display all storages with the withDelete and withClear parameters set so the delete form is on the webpage
    $getEquipment->showEquipment(withDelete, withClear);
?>
</body>
</html>
