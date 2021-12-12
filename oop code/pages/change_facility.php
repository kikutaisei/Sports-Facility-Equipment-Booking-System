<?php # Include the Db class for access to the database, and the EditOwner, EditFacility and ViewFacility classes to display the available options
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_facility.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_facility.view.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    # Creating new instance of the EditFacility to have access to all the facilities
    $getFacilities = new EditFacility;
    $facilityOptions = $getFacilities->getAllFacilities();
    # Creating new instance of the EditOwner to have access to all the owners
    $getOwners = new EditOwner;
    $ownerOptions = $getOwners->getAllOwners();
?>
<!DOCTYPE>
<html>
<head>
<title> Change Facility Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Facility Details </h1> <hr>

<!-- Form to select the facility and change its name and/or owner -->
<form method='post' action='/classes/view/change_facility.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down select to choose one of the existing facilities -->
<b> Select which facility you want to change: </b><br>
<select name='facility' style='width:20%; font-size:15px'>
<?php # Foreach loop through all the existing facilities
    foreach ($facilityOptions as $facilityOption){ ?>
        <option value='
        <?php # The value assigned to each of the options will be the facilities ID
            echo $facilityOption['facilityID'];
        ?>
        '>
        <?php # The option that will be visible on the webpage will be the facility's name
            echo $facilityOption['facilityName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text box to input the new name of the facility -->
<b> New Name (Optional): </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName"> <br><hr>

<!-- Drop down select to choose one of the existing owners -->
<b> New Owner (Optional): </b><br>
<select name='owner' style='width:20%; font-size:15px'>
<option disabled selected value> Select an option </option>
<?php # Foreach loop through all the existing owners
    foreach ($ownerOptions as $ownerOption){ ?>
        <option value='
        <?php # The value assigned to each of the options will be the owners ID
            echo $ownerOption['ownerID'];
        ?>
        '>
        <?php # The option that will be visible on the webpage will be the owner's name
            echo $ownerOption['ownerName'];
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

<?php # Creating instance of ViewFacility class to display all the facilties
    $viewFacilities = new ViewFacility(viewAll);
    $viewFacilities->showFacilities();
?>
</body>
</html>
