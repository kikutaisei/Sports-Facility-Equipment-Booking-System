<?php # Include the Db class for access to the database, and the EditFacility, EditStorage and ViewStorage classes to display the available options
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_storage.view.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    # Creating new instance of the EditStorage to have access to all the storages
    $storageOptions = new EditStorage;
    $storages = $storageOptions->getAllStorages();
    # Creating new instance of the EditFacility to have access to all the facilities
    $facilityOptions = new EditFacility;
    $facilities = $facilityOptions->getAllFacilities();
?>
<!DOCTYPE>
<html>
<head>
<title> Change Storage Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Storage Details </h1> <hr>

<!-- Form to select the storage and change its name and/or facility -->
<form method='post' action='/classes/view/change_storage.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down select to choose one of the existing storages -->
<b> Select which storage you want to change: </b><br>
<select name='storage' style='width:20%; font-size:15px'>
<?php # Foreach loop through all the existing storages
    foreach ($storages as $storage){ ?>
        <option value='
        <?php # The value assigned to each of the options will be the storages ID
            echo $storage['storageID'];
        ?>
        '>
        <?php # The option that will be visible on the webpage will be the storage's name
            echo $storage['storageName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text box to input the new name of the facility -->
<b> New Name (Optional): </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName"> <br><hr>

<!-- Drop down select to choose one of the existing facilities -->
<b> New Facility (Optional): </b><br>
<select name='facility' style='width:20%; font-size:15px'>
<option disabled selected value> Select an option </option>
<?php # Foreach loop through all the existing facilities
    foreach ($facilities as $facility){ ?>
        <option value='
        <?php # The value assigned to each of the options will be the facilities ID
            echo $facility['facilityID'];
        ?>
        '>
        <?php # The option that will be visible on the webpage will be the facility's name
            echo $facility['facilityName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Submit/Change button to proceed to the next page, and a reset button to restart if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # Creating instance of ViewStorage class to display all the storages
    $viewStorages = new ViewStorage(viewAll);
    $viewStorages->showStorages();
?>
</body>
</html>
