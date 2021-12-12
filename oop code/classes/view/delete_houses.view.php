<?php # Including the Db, EditHouse and the ViewHouse classes to connect to the databse and delete the houses and display the updated table
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_house.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete House </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete House </h1> <hr>
<?php # If user selects specific houses to delete through the checkboxes, their IDs will be assigned to this varibale
    $deleteIDs = $_POST['deleteID'];
    
    # New instance of the ViewHouse class and showHouses method to display the houses that will be deleted
    # Theses houses are displayed before they are deleted from the database
    echo "<h2> You have requested to delete the following houses: </h2>";
    if (isset($_POST['clear'])){
        $deletedHouses = new ViewHouse(viewAll);
        $deletedHouses->showHouses();
    }else{
        $deletedHouses = new ViewHouse(viewSelected, $deleteIDs);
        $deletedHouses->showHouses();
    }
    echo "<br>";
    
    # New instance of EditHouse class and deleteHouses method to delete the chosen houses
    $deleteHouse = new EditHouse;
    if (isset($_POST['clear'])){
        $deleteHouse->clearHouses();
    }else{
        foreach ($deleteIDs as $deleteID){
            $deleteHouse->deleteHouses($deleteID);
        }
    }
    echo "<hr>";
    
    # Separate ViewHouses class instance to display the updated list of houses
    echo "<h2> Updated House list: </h2>";
    $updatedHouses = new ViewHouse(viewAll);
    $updatedHouses->showHouses();
?>
</body>
</html>
