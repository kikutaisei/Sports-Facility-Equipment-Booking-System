<?php # Include the Db, EditYearGroup and ViewYearGroup classes to make display all the year groups
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_yearGroup.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_yearGroup.view.php');
    # New instance of the ViewYearGroup class
    $getYearGroups = new ViewYearGroup(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> Edit Year Group </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Edit Year Group Data </h1> <hr>
<button class="navButton" onclick= "window.location.href='change_yearGroup.php'"> Make Change(s) to a Year Group </button>
<br><hr>
<?php # Calling the showYearGroups method to display the year groups
    $getYearGroups->showYearGroups();
?>
</body>
</html>
