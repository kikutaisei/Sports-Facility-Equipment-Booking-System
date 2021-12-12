<?php # Include Db, EditUserType and ViewUserType classes to connect to the database and display the userType table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_userType.view.php');
    # Creating new instance of the EditUserType and ViewUserType classes
    $test = new EditUserType;
    $viewUserTypes = new ViewUserType(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New User Type </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New User Type </h1> <hr>

<?php # Assign form data to new variable
    $typeName = $_POST['name'];
    
    # Call addUserType method to add the new record to the userType table using the form data
    $test->addUserType($typeName);
    echo "<hr>";
    
    # Call the showUserTypes method to display the updated user type list
    echo "<h2> Updated User Type List: </h2>";
    $viewUserTypes->showUserTypes();
?>
</body>
</html>
