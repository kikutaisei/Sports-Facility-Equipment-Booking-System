<?php # Include the Db class for access to the database, and the EditStorage and ViewStorage classes to make the changes to the storage table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_storage.view.php');
    # Creating new instance of the EditStorage class
    $changeStorageDetails = new EditStorage;
?>
<!DOCTYPE>
<html>
<head>
<title> Change Storage Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Storage Details </h1> <hr>
<?php # Assigns the form data to new varibles
    $storageID = $_POST['storage'];
    $facilityID = $_POST['facility'];
    $newName = $_POST['newName'];
    # Tests for each combination of form results
    # Depending on this combination, a different set of methods are called to make changes to the storage table
    if ((empty($newName)) AND (empty($facilityID))){
        echo "<b> You made no changes to the storage </b>";
    }elseif (!(empty($newName)) AND (empty($facilityID))){
        $changeStorageDetails->changeStorageName($storageID, $newName);
    }elseif ((empty($newName)) AND !(empty($facilityID))){
        $changeStorageDetails->changeStorageFacility($storageID, $facilityID);
    }elseif (!(empty($newName)) AND !(empty($facilityID))){
        $changeStorageDetails->changeStorageName($storageID, $newName);
        $changeStorageDetails->changeStorageFacility($storageID, $facilityID);
    }
    echo "<hr>";
    
    # Displaying the new, updated stoarge table by creating a new instance of the ViewStorage class and calling the showStorages method
    echo "<h2> Updated Storage List: </h2>";
    $updatedStorage = new ViewStorage(viewAll);
    $updatedStorage->showStorages();
?>
</body>
</html>
