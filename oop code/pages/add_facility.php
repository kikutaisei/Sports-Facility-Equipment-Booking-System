<?php # Include the Db and EditOwner classes to retrieve and display owner data as options in the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    $getOwnerOptions = new EditOwner;
    $owners = $getOwnerOptions->getAllOwners();
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New Facility </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Facility </h1> <hr>

<!-- Form with text box for name and a drop down select for the owner -->
<form method='post' action='/classes/view/add_facility.view.php' onsubmit="return confirm('Are you sure you want to add this facility?')">

<!-- Text box for user to input the facility's name -->
<b> Facility Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Drop down select menu to choose the owner for the facility -->
<b> Facility Owner: </b><br>
<select name='owner' style='width:20%; font-size:15px'>
<?php # Foreach loop through all owners retrieved from the getAllOwners method
    foreach ($owners as $owner){ ?>
        <option value='
        <?php # The value assigned to each option will be the owner's ID
            echo $owner['ownerID'];
        ?>
        '>
        <?php # The value that will be visible on the webpage drop down menu will be the owner's name
            echo $owner['ownerName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Submit/Add button to proceed and a reset button to allow the user to restart -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>
</body>
</html>
