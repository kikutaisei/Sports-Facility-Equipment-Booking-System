<?php # Including the Db class to access the database and the EditFacility and ViewFacility classes to display/make changes to the facility table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_facility.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete Facility </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete Facility </h1> <hr>

<?php # If the user has chosen specific facilities to delete, their IDs will be assigned to this variable as an array
    $deleteIDs = $_POST['deleteID'];
    
    # Creating new instance of ViewFacility class to display the selected facilities to be deleted
    # These facilities are displayed and selected before they are deleted from the database
    echo "<h2> You have requested to delete the following facilities: </h2>";
    if (isset($_POST['clear'])){
        $deletedFacilities = new ViewFacility(viewAll);
        $deletedFacilities->showFacilities();
    }else{
        $deletedFacilities = new ViewFacility(viewSelected, $deleteIDs);
        $deletedFacilities->showFacilities();
    }
    echo "<br>";
    
    # Creating new instance of the EditFacility class to have access to the editting methods, in this case the deleteFaciliies and clearFacilities methods
    # If the user has chosen to delete all facilities, the clearFacilities method will run, otherwise the deleteFaciliies method will run
    $delete = new EditFacility;
    if (isset($_POST['clear'])){
        $delete->clearFacilities();
    }else{
        foreach ($deleteIDs as $deleteID){
            $delete->deleteFacilities($deleteID);
        }
    }
    echo "<hr>";
    
    # New, separate instance of the ViewOwner class is created to display all the remaining owners after the selected owners were deleted from the database
    echo "<h2> Updated Facility list: </h2>";
    $updatedFacilities = new ViewFacility(viewAll);
    $updatedFacilities->showFacilities();
?>
</body>
</html>
