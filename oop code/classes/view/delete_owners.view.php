<?php # Including the Db class to access the database and the EditOwner and ViewOwner classes to display/make changes to the owner table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_owner.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete Owner </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete Owner </h1> <hr>
<?php
    # If the user has chosen specific owners to delete, their IDs will be assigned to this variable
    $deleteIDs = $_POST['deleteID'];
    
    # Creating new instance of ViewOwner class to display the selected owners to be deleted
    # These owners are displayed and selected before they are deleted from the database
    echo "<h2> You have requested to delete the following owners: </h2>";
    if (isset($_POST['clear'])){
        $deletedOwners = new ViewOwner(viewAll);
        $deletedOwners->showOwners();
    }else{
        $deletedOwners = new ViewOwner(viewSelected, $deleteIDs);
        $deletedOwners->showOwners();
    }
    echo "<br>";
    
    # Creating new instance of the EditOwner class to have access to the editting methods, in this case the deleteOwners and clearOwners methods
    # If the user has chosen to delete all owners, the clearOwners method will run, otherwise the deleteOwners method will run
    $deleteOwners = new EditOwner;
    if (isset($_POST['clear'])){
        $deleteOwners->clearOwners();
    }else{
        foreach ($deleteIDs as $deleteID){
            $deleteOwners->deleteOwners($deleteID);
        }
    }
    echo "<hr>";
    
    # New, separate instance of the ViewOwner class is created to display all the remaining owners after the selected owners were deleted from the database
    echo "<h2> Updated Owner list: </h2>";
    $updatedOwners = new ViewOwner(viewAll);
    $updatedOwners->showOwners();
?>
</body>
</html>
