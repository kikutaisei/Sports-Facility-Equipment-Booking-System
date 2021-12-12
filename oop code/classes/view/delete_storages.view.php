<?php # Including the Db class to access, EditStorage and ViewStorage classes to display/make changes to the storage table and access the database
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_storage.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete Storage </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete Storage </h1> <hr>
<?php # If the user has chosen specific storages to delete, their IDs will be assigned to this variable as an array
    $deleteIDs = $_POST['deleteID'];
    
    # Creating new instance of ViewStorage class to display the selected storages to be deleted
    # These storages are displayed and selected before they are deleted from the database
    echo "<h2> You have requested to delete the following storages: </h2>";
    if (isset($_POST['clear'])){
        $deletedStorages = new ViewStorage(viewAll);
        $deletedStorages->showStorages();
    }else{
        $deletedStorages = new ViewStorage(viewSelected, $deleteIDs);
        $deletedStorages->showStorages();
    }
    
    # Creating new instance of the EditStorage class to have access to the editting methods, in this case the deleteStorages and clearStorages methods
    # If the user has chosen to delete all storages, the clearStorages method will run, otherwise the deleteStorages method will run
    $delete = new EditStorage;
    if (isset($_POST['clear'])){
        $delete->clearStorages();
    }else{
        foreach ($deleteIDs as $deleteID){
            $delete->deleteStorages($deleteID);
        }
    }
    
    # New, separate instance of the ViewStorage class is created to display all the remaining storages after the selected storage were deleted from the table
    echo "<hr>";
    echo "<h2> Updated Storage list: </h2>";
    $updatedStorages = new ViewStorage(viewAll);
    $updatedStorages->showStorages();
?>
</body>
</html>
