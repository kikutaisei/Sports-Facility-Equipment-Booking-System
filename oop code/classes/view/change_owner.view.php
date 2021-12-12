<?php # Include the Db class for access to the database, and the EditOwner and ViewOwner classes to make the changes to the owner table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_owner.view.php');
    # Creating new instance of the EditOwner class
    $editOwnerDetails = new EditOwner;
?>
<!DOCTYPE>
<html>
<head>
<title> Change Owner Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Owner Details </h1><hr>

<?php # Assigns the form data to new varibles
    $ownerID = $_POST['owner'];
    $newName = $_POST['newName'];
    # Calls the changeOwnerName method from the EditOwner class by passing through the new variables as parameters
    $editOwnerDetails->changeOwnerName($ownerID, $newName);
    echo "<hr>";
    
    # Displaying the new, updated owner table
    echo "<h2> Updated Owner List: </h2>";
    $updatedOwners = new ViewOwner(viewAll);
    $updatedOwners->showOwners();
?>
</body>
</html>
