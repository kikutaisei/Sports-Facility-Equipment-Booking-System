<?php # Include Db, EditOwner and ViewOwner classes to have access and display the new owner
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_facility.view.php');
    # Create new instances of the EditFacility and ViewFacility classes for access to the necessary methods
    $newFacility = new EditFacility;
    $viewFacilities = new ViewFacility(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New Facility </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Facility </h1> <hr>

<?php # Assign the form values to new variables
    $facilityName = $_POST['name'];
    $facilityOwner = $_POST['owner'];
    # Call the addFacility method to add a new record to the facility table
    $newFacility->addFacility($facilityName, $facilityOwner);
    echo "<hr>";
    
    # Calling the showFaciities method to display the updated facility list
    echo "<h2> Updated Facility List: </h2>";
    $viewFacilities->showFacilities();
?>
</body>
</html>
