<?php # Include the Db and EditStorage classes to display storage data as options in the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    # Creating new instance of the EditStorage class
    $storageOptions = new EditStorage;
    $storages = $storageOptions->getAllStorages();
?>
<!DOCTYPE>
<html>
<head>
<title> Add New Equipment </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add New Equipment </h1> <hr>

<!-- Form to change equipment details -->
<form method='post' action='/classes/view/add_equipment.view.php' onsubmit="return confirm('Are you sure you want to add this equipment?')">

<!-- Text box for equipment name -->
<b> Equipment Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Drop down select menu to choose the storage -->
<b> Equipment Storage: </b><br>
<select name='storage' style='width:20%; font-size:15px'>
<?php
    foreach ($storages as $storage){ ?>
        <option value='
        <?php # The storageID is assigned to each option
            echo $storage['storageID'];
        ?>
        '>
        <?php # The storageName will be displayed for each option
            echo $storage['storageName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Number input for number available (must be greater than or equal to 1) -->
<b> Number Available: </b><br>
<input type="number" name="numAvailable" min="1" required><br><hr>

<!-- Submit/Add button to proceed and a reset button to allow the user to restart -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>

</body>
</html>
