<?php # Include Db, EditUserType and ViewUserType classes to connect to the database and make changes to the userType table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_userType.view.php');
    # Creating new instance of the EditUserType class to make changes
    $changeUserTypeDetails = new EditUserType;
?>
<!DOCTYPE>
<html>
<head>
<title> Change User Type </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change User Type </h1> <hr>

<?php # The form data will be assigned to the following variables
    $userTypeID = $_POST['userType'];
    $newName = $_POST['newName'];
    
    # Calls the changeUserTypeName method to change the user type's anme with the form data
    $changeUserTypeDetails->changeUserTypeName($userTypeID, $newName);
    echo "<hr>";
    
    # Creates new instance of the ViewUserType class and calls the showUserTypes method to display the updates user types list
    echo "<h2> Updated User Type List: </h2>";
    $updatedUserType = new ViewUserType(viewAll);
    $updatedUserType->showUserTypes();
?>
</body>
</html>
