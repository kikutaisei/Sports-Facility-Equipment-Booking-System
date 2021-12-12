<?php # Include Db, EditOwner and ViewOwner classes to have access and display the new owner
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_owner.view.php');
    # Create new instances of the EditOwner and ViewOwner classes for access to the necessary methods
    $addNewOwner = new EditOwner;
    $viewOwners = new ViewOwner(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New Owner </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Owner </h1> <hr>

<?php # Assign the form values to new variables
    $ownerName = $_POST['name'];
    # Call the addOwner method to add a new record to the owner table
    $addNewOwner->addOwner($ownerName);
    echo "<hr>";
    
    # Calling the showOwners method to display the updated owners list
    echo "<h2> Updated Owner List: </h2>";
    $viewOwners->showOwners();
?>
</body>
</html>
