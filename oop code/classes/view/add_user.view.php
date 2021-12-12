<?php # Include Db, ViewUser and Edit user classes to connect to database and dsiplay the users and add a new record to the user table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_user.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_user.view.php');
    # New instance of both EditUser and ViewUser classes to make changes and display them
    $addNewUser = new EditUser;
    $viewUsers = new ViewUser(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New User </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New User </h1> <hr>
<?php # Assigning form data to new variables
    $userID = $_POST['ID'];
    $userName = $_POST['name'];
    $houseID = $_POST['house'];
    $userTypeID = $_POST['userType'];
    
    # Calling addUser method to add new record to table
    $addNewUser->addUser($userID, $userName, $houseID, $userTypeID);
    echo "<hr>";
    
    # Calling showUsers method to display updated user table
    echo "<h2> Updated User List: </h2>";
    $viewUsers->showUsers();
?>
</body>
</html>
