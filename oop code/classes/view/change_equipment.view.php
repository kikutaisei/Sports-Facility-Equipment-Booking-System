<?php # Include the Db class for access to the database, and the EditEquipment and ViewEquipment classes to make the changes to the equipment table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_equipment.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_equipment.view.php');
    # Creating new instance of the EditStorage class
    $changeEquipmentDetails = new EditEquipment;
?>
<!DOCTYPE>
<html>
<head>
<title> Change Equipment Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Equipment Details </h1> <hr>
<?php # Assigns the form data to new varibles
    $equipmentID = $_POST['equipment'];
    $newName = $_POST['newName'];
    $storageID = $_POST['storage'];
    $numAvailable = $_POST['numAvailable'];
    
    # Tests for each combination of form results
    # Depending on this combination, a different set of methods are called to make changes to the equipment table
    if ((empty($newName)) AND (empty($storageID)) AND (empty($numAvailable))){
        echo "<b> You made no changes to the equipment </b>";
    }elseif ((empty($newName)) AND (empty($storageID)) AND !(empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentNum($equipmentID, $numAvailable);
    }elseif ((empty($newName)) AND !(empty($storageID)) AND (empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentStorage($equipmentID, $storageID);
    }elseif ((empty($newName)) AND !(empty($storageID)) AND !(empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentStorage($equipmentID, $storageID);
        $changeEquipmentDetails->changeEquipmentNum($equipmentID, $numAvailable);
    }elseif (!(empty($newName)) AND (empty($storageID)) AND (empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentName($equipmentID, $newName);
    }elseif (!(empty($newName)) AND (empty($storageID)) AND !(empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentName($equipmentID, $newName);
        $changeEquipmentDetails->changeEquipmentNum($equipmentID, $numAvailable);
    }elseif (!(empty($newName)) AND !(empty($storageID)) AND (empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentName($equipmentID, $newName);
        $changeEquipmentDetails->changeEquipmentStorage($equipmentID, $storageID);
    }elseif (!(empty($newName)) AND !(empty($storageID)) AND !(empty($numAvailable))){
        $changeEquipmentDetails->changeEquipmentName($equipmentID, $newName);
        $changeEquipmentDetails->changeEquipmentStorage($equipmentID, $storageID);
        $changeEquipmentDetails->changeEquipmentNum($equipmentID, $numAvailable);
    }
    echo "<hr>";
    
    # Displaying the new, updated equipment table by creating a new instance of the ViewEquipment class and calling the showEquipment method
    echo "<h2> Updated Equipment List: </h2>";
    $updatedEquipment = new ViewEquipment(viewAll);
    $updatedEquipment->showEquipment();
?>
</body>
</html>
