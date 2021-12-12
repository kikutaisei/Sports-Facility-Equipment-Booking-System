<?php # Include Db, ViewHouse and EditHouse classes to connect to the database and display all the houses in the database
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_house.view.php');
    # New instance of the ViewHouse class to display all the houses in the house table
    $getHouses = new ViewHouse(viewAll);
?>
<!DOCTYPE html>
<html>
<head>
<title> View/Edit House </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Edit House </h1> <hr>

<button class="navButton" onclick= "window.location.href='add_house.php'"> Add A New House </button>
<button class="navButton" onclick= "window.location.href='change_house.php'"> Make Change(s) to a House </button>
<br><hr>
<?php # Running showHouses method to display all houses on the webpage
    $getHouses->showHouses(True, True);
?>
</body>
</html>
