<?php # Include the Db class for access to the database, and the EditOwner and ViewOwner classes to display the available options
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_owner.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_owner.view.php');
    # Creating new instance of the EditOwner to have access to all the owners
    $getAllOwners = new EditOwner;
    $ownerOptions = $getAllOwners->getAllOwners();
?>
<!DOCTYPE>
<html>
<head>
<title> Change Owner Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Owner Details </h1> <hr>

<!-- Form to select the owner and change its name -->
<form method='post' action='/classes/view/change_owner.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down select to choose one of the existing owners -->
<b> Select which owner you want to change: </b><br>
<select name='owner' style='width:20%; font-size:15px'>
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
</select><br><br>

<!-- Text box to input the new name of the owner -->
<b> New Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName" required> <br><hr>

<!-- Submit/Change button to proceed to the next page, and a reset button to restart if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # Creating instance of ViewOwner class to display all the owners
    $viewOwners = new ViewOwner(viewAll);
    $viewOwners->showOwners();
?>
</body>
</html>
