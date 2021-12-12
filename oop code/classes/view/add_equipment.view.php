<?php # Include Db, EditEquipment and ViewEquipment classes to have access and display the new equipment
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_equipment.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_equipment.view.php');
    # Create new instances of the ViewEquipment and EditEquipment classes for access to the methods
    $addNewEquipment = new EditEquipment;
    $viewEquipment = new ViewEquipment(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add New Equipment </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add New Equipment </h1> <hr>
<?php # Assign the form values to the 3 variables below
    $equipmentName = $_POST['name'];
    $storageID = $_POST['storage'];
    $numAvailable = $_POST['numAvailable'];
    
    # Call the addEquipment method to add a new record to the equipment table
    $addNewEquipment->addEquipment($equipmentName, $storageID, $numAvailable);
    echo "<hr>";
    # Call the showEquipment method to display the updated equipment list
    echo "<h2> Updated Equipment List: </h2>";
    $viewEquipment->showEquipment();
?>
</body>
</html>
