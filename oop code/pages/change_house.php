<?php # Including the Db, EditHouse and View House classes to connect to the databse and display the options for the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_house.view.php');
    # New instance of the EditHouse class and getAllHouses method
    $houseOptions = new EditHouse;
    $houses = $houseOptions->getAllHouses();
?>
<!DOCTYPE>
<html>
<head>
<title> Change House Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change House Details </h1> <hr>

<!-- Form to make changes to the house table -->
<form method='post' action='/classes/view/change_house.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down menu to select the house -->
<b> Select which house you want to change: </b><br>
<select name='house' style='width:20%; font-size:15px'>
<?php
    foreach ($houses as $house){ ?>
        <option value='
        <?php
            echo $house['houseID'];
        ?>
        '>
        <?php
            echo $house['houseName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text nox to enter the house's new name -->
<b> New Name (Optional): </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName"> <br><hr>

<!-- Number input to enter the new number of students -->
<b> Number of Students (Optional): </b><br>
<input type="number" name="numStudent" min="0"><br><hr>

<!-- Submit/Change button to proceed to the next page, and a reset button to start again if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # New instance of the ViewHouse class and the showHouses method to display all the houses
    $viewHouses = new viewHouse(viewAll);
    $viewHouses->showHouses();
?>
</body>
</html>
