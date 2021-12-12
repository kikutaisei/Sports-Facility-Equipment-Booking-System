<?php # Include Db, ViewHouse and EditHouse classes to connect to database and add the new house and display it
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_house.view.php');
    # New instances of EditHouse and ViewHouse classes
    $addNewHouse = new EditHouse;
    $viewHouses = new ViewHouse(viewAll);
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New House </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New House </h1> <hr>
<?php # Assigning the form inputs to the following variables
    $houseName = $_POST['name'];
    $numStudent = $_POST['numStudent'];
    
    # Calling the addHouse method to add a new record
    $addNewHouse->addHouse($houseName, $numStudent);
    echo "<hr>";
    
    # Calling the showHouses method to display the updated list of houses after adding the new house
    echo "<h2> Updated House List: </h2>";
    $viewHouses->showHouses();
?>
</body>
</html>
