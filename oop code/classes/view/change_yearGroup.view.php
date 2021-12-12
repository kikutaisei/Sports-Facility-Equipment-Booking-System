<?php # Include Db, ViewYearGroup and EditYearGroup classes to make changes and display them to the user
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_yearGroup.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_yearGroup.view.php');
    # New instance of the EditYearGroup class to make changes to the yearGroup table
    $changeYearGroupDetails = new EditYearGroup;
?>
<!DOCTYPE>
<html>
<head>
<title> Change Year Group Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Year Group's Details </h1> <hr>
<?php # The form results/values will be set to these variables
    $groupID = $_POST['yearGroup'];
    $numStudent = $_POST['numStudent'];
    
    # Calling the changeNumStudent method to update the yearGroup table
    $changeYearGroupDetails->changeNumStudent($groupID, $numStudent);
    echo "<hr>";
    
    # New instance of the ViewYearGroup class and showYearGroups method to display the updated yearGroup table
    echo "<h2> Updated Year Group List: </h2>";
    $updatedYearGroups = new ViewYearGroup(viewAll);
    $updatedYearGroups->showYearGroups();
?>
</body>
</html>
