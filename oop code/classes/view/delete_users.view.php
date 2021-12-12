<?php # Include Db, EditUser and ViewUser classes to connect to the database and delete the users and then show the updataed user table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_user.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_user.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete User </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete User </h1> <hr>
<?php # If user selects specific users to delete, their IDs are assigned to this variable
    $deleteIDs = $_POST['deleteID'];
    
    # Creates new instance of ViewUser class and displays selected/all users
    echo "<h2> You have requested to delete the following users: </h2>";
    if (isset($_POST['clear'])){
        $deletedUsers = new ViewUser(viewAll);
        $deletedUsers->showUsers();
    }else{
        $deletedUsers = new ViewUser(viewSelected, $deleteIDs);
        $deletedUsers->showUsers();
    }
    echo "<br>";
    
    # Creates new instance of EditUser class and runs clearUsers/deleteUsers method based on user form input
    $deleteUser = new EditUser;
    if (isset($_POST['clear'])){
        $deleteUser->clearUsers();
    }else{
        foreach ($deleteIDs as $deleteID){
            $deleteUser->deleteUsers($deleteID);
        }
    }
    
    # Creates another instance of ViewUser class and displays updated user table after removal of the chosen user(s)
    echo "<hr>";
    echo "<h2> Updated User list: </h2>";
    $updatedUsers = new ViewUser(viewAll);
    $updatedUsers->showUsers();
?>
</body>
</html>
