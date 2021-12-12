<?php # Include Db, EditUserType and ViewUserType classes to connect to the database and access to methods to delete the user types from its table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_userType.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete User Type </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete User Type </h1> <hr>
<?php # If user has selected specific user types, their IDs will be assigned to this variable as an array
    $deleteIDs = $_POST['deleteID'];
    
    # Creates new instance of the ViewUserType class based on whether or not the user has selected the user types they want to delete
    # Calls showUserTypes method to dsiplay user types in table form
    echo "<h2> You have requested to delete the following user types: </h2>";
    if (isset($_POST['clear'])){
        $deletedUserTypes = new ViewUserType(viewAll);
        $deletedUserTypes->showUserTypes();
    }else{
        $deletedUserTypes = new ViewUserType(viewSelected, $deleteIDs);
        $deletedUserTypes->showUserTypes();
    }
    
    # Creates new instance of EditUserType class depending on if the user chose to clear or delete the user types
    $delete = new EditUserType;
    if (isset($_POST['clear'])){
        $delete->clearUserTypes();
    }else{
        foreach ($deleteIDs as $deleteID){
            $delete->deleteUserTypes($deleteID);
        }
    }
    
    # Creates a separate, new instance of the ViewUserType class and calls the showUserTypes method to display the updated user types list
    echo "<hr>";
    echo "<h2> Updated User Type list: </h2>";
    $updatedUserTypes = new ViewUserType(viewAll);
    $updatedUserTypes->showUserTypes();
?>
</body>
</html>
