<?php # Include the Db and EditFacility classes to retrieve and display facility data as options in the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    $getFacilityOptions = new EditFacility;
    $facilities = $getFacilityOptions->getAllFacilities();
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New Storage </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Storage </h1> <hr>

<!-- Form with text box for name and a drop down select for the storage -->
<form method='post' action='/classes/view/add_storage.view.php' onsubmit="return confirm('Are you sure you want to add this storage?')">

<!-- Text box for user to input the storage's name -->
<b> Storage Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Drop down select menu to choose the facility/location for the storage -->
<b> Storage Location: </b><br>
<select name='facility' style='width:20%; font-size:15px'>
<?php # Foreach loop through all facilities retrieved from the getAllFacilities method
    foreach ($facilities as $facility){ ?>
        <option value='
        <?php # The value assigned to each option will be the facility's ID
            echo $facility['facilityID'];
        ?>
        '>
        <?php # The value that will be visible on the webpage drop down menu will be the facility's name
            echo $facility['facilityName'];
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
