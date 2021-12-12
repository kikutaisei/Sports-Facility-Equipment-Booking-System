<?php # Including the Db class for access to the database, and the EditFacility and ViewFacility classes to display the facility data
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_facility.view.php');
    $facilities = new ViewFacility(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit Facility </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>

<h1> View/Edit Facility </h1> <hr>
<button class="navButton" onclick= "window.location.href='add_facility.php'"> Add a New Facility </button>
<button class="navButton" onclick= "window.location.href='change_facility.php'"> Make Change(s) to a Facility </button>
<br><hr>
<?php # Calls the showfacilities method to display all facilities with the withDelete and withClear parameters set so the delete form is on the webpage
    $facilities->showFacilities(withDelete, withClear);
?>
</body>
</html>
