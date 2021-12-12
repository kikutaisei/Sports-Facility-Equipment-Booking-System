<?php # Including the Db class to access, EditEquipment and ViewEquipment classes to display/make changes to the equipment data
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_equipment.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_equipment.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete Equipment </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete Equipment </h1> <hr>
<?php # If the user has chosen specific equipment to delete, their IDs will be assigned to this variable as an array
    $deleteIDs = $_POST['deleteID'];
    
    # Creating new instance of ViewEquipment class to display the selected equipment to be deleted
    # These equipment are displayed and selected before they are deleted from the database
    echo "<h2> You have requested to delete the following equipment: </h2>";
    if (isset($_POST['clear'])){
        $deletedEquipment = new ViewEquipment(viewAll);
        $deletedEquipment->showEquipment();
    }else{
        $deletedEquipment = new ViewEquipment(viewSelected, $deleteIDs);
        $deletedEquipment->showEquipment();
    }
    
    # Creating new instance of the EditEquipment class to have access to the editting methods, in this case the deleteEquipment and clearEquipment methods
    # If the user has chosen to delete all storages, the clearEquipment method will run, otherwise the deleteEquipment method will run
    $delete = new EditEquipment;
    if (isset($_POST['clear'])){
        $delete->clearEquipment();
    }else{
        foreach ($deleteIDs as $deleteID){
            $delete->deleteEquipment($deleteID);
        }
    }
    echo "<hr>";
    
    # New, separate instance of the ViewEquipment class is created to display all the remaining equipment after the selected equipment were deleted from the database
    echo "<h2> Updated Equipment list: </h2>";
    $updatedEquipment = new ViewEquipment(viewAll);
    $updatedEquipment->showEquipment();
?>
</body>
</html>
