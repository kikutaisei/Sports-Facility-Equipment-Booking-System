<?php # Include the Db, EditHouse and ViewHouse classes to make the changes and to display the house table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_house.view.php');
    # New instance of EditHouse class to access methods to change house details
    $changeHouseDetails = new EditHouse;
?>
<!DOCTYPE>
<html>
<head>
<title> Change House Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change House Details </h1> <hr>
<?php # Assign the form values to the following variables
    $houseID = $_POST['house'];
    $newName = $_POST['newName'];
    $numStudent = $_POST['numStudent'];
    
    # Test and compare for all combination of results, and run a different set of code for each
    if ((empty($newName)) AND (empty($numStudent))){
        echo "<b> You made no changes to the house </b>";
    }elseif (!(empty($newName)) AND (empty($numStudent))){
        $changeHouseDetails->changeHouseName($houseID, $newName);
    }elseif ((empty($newName)) AND !(empty($numStudent))){
        $changeHouseDetails->changeHouseNumStudent($houseID, $numStudent);
    }elseif (!(empty($newName)) AND !(empty($numStudent))){
        $changeHouseDetails->changeHouseName($houseID, $newName);
        $changeHouseDetails->changeHouseNumStudent($houseID, $numStudent);
    }
    echo "<hr>";
    
    # New instance of ViewHouse class and showHouses method to display the updated list of houses
    echo "<h2> Updated House List: </h2>";
    $updatedHouses = new ViewHouse(viewAll);
    $updatedHouses->showHouses();
?>
</body>
</html>
