<?php # Include the Db class for access to the database, and the EditFacility and ViewFacility classes to make the changes to the facility table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_facility.view.php');
    # Creating new instance of the EditFacility class
    $changeFacilityDetails = new EditFacility;
?>
<!DOCTYPE>
<html>
<head>
<title> Change Facility Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Facility Details </h1> <hr>

<?php # Assigns the form data to new varibles
    $facilityID = $_POST['facility'];
    $ownerID = $_POST['owner'];
    $newName = $_POST['newName'];
    # Tests for each combination of form results
    # Depending on this combination, a different set of methods are called to make changes to the facility table
    if ((empty($newName)) AND (empty($ownerID))){
        echo "<b> You made no changes to the facility </b>";
    }elseif (!(empty($newName)) AND (empty($ownerID))){
        $changeFacilityDetails->changeFacilityName($facilityID, $newName);
    }elseif ((empty($newName)) AND !(empty($ownerID))){
        $changeFacilityDetails->changeFacilityOwner($facilityID, $ownerID);
    }elseif (!(empty($newName)) AND !(empty($ownerID))){
        $changeFacilityDetails->changeFacilityName($facilityID, $newName);
        $changeFacilityDetails->changeFacilityOwner($facilityID, $ownerID);
    }
    echo "<hr>";
    
    # Displaying the new, updated facility table by creating a new instance of the ViewFacility class and calling the showFacilities method
    echo "<h2> Updated Facility List: </h2>";
    $updatedFacilities = new ViewFacility(viewAll);
    $updatedFacilities->showFacilities();
?>
</body>
</html>
