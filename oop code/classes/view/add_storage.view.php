<?php # Include Db, EditOwner and ViewOwner classes to have access and display the new owner
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_storage.view.php');
    # Create new instances of the EditFacility and ViewFacility classes for access to the necessary methods
    $addNewStorage = new EditStorage;
    $viewStorages = new ViewStorage(viewAll);
?>
<!DOCTYPE>
<html>

<head>
<title> Add a New Storage </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>

<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Storage </h1> <hr>
<?php # Assign the form values to new variables
    $storageName = $_POST['name'];
    $facilityID = $_POST['facility'];
    
    # Call the addStorage method to add a new record to the storage table
    $addNewStorage->addStorage($storageName, $facilityID);
    echo "<hr>";
    
    # Calling the showStorages method to display the updated storage list
    echo "<h2> Updated Storage List: </h2>";
    $viewStorages->showStorages();
?>
</body>
</html>
