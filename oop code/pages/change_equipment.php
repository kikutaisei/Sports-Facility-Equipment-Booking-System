<?php # Include the Db class for access to the database, and the EditStorage, EditEquipment and ViewEquipment classes to display the available options
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_equipment.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_equipment.view.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_storage.ctrl.php');
    # Creating new instance of the EditEquipment to have access to all the equipment
    $equipmentOptions = new EditEquipment;
    $equipment = $equipmentOptions->getAllEquipment();
    # Creating new instance of the EditStorage to have access to all the storages
    $storageOptions = new EditStorage;
    $storages = $storageOptions->getAllStorages();
?>
<!DOCTYPE>
<html>
<head>
<title> Change Equipment Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Equipment Details </h1> <hr>

<!-- Form to select the equipment and change its name and/or storage and/or number -->
<form method='post' action='/classes/view/change_equipment.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down select to choose one of the existing equipment -->
<b> Select which equipment you want to change: </b><br>
<select name='equipment' style='width:20%; font-size:15px'>
<?php
    foreach ($equipment as $equipment){ ?>
        <option value='
        <?php
            echo $equipment['equipmentID'];
        ?>
        '>
        <?php
            echo $equipment['equipmentName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text box to input the new name of the equipment -->
<b> New Name (Optional): </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName"> <br><hr>

<!-- Drop down select to choose one of the existing storages -->
<b> New Storage (Optional): </b><br>
<select name='storage' style='width:20%; font-size:15px'>
<option disabled selected value> Select an option </option>
<?php
    foreach ($storages as $storage){ ?>
        <option value='
        <?php
            echo $storage['storageID'];
        ?>
        '>
        <?php
            echo $storage['storageName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Number input for equipment availability -->
<b> Number Available (Optional): </b><br>
<input type="number" name="numAvailable" min="1"><br><hr>

<!-- Submit/Change button to proceed to the next page, and a reset button to restart if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # Creating instance of ViewEquipment class to display all the equipment
    $viewEquipment = new ViewEquipment(viewAll);
    $viewEquipment->showEquipment();
?>
</body>
</html>
