<?php #Include Db, EditUser, ViewUser, EditUserType and EditHouse classes to connect to the database and display options for the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_user.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_user.view.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    # New instance of EditUser class and calling getAllUsers method to display options in drop down
    $userOptions = new EditUser;
    $users = $userOptions->getAllUsers();
    # New instance of EditHouse class and calling getAllHouses method to display options in drop down
    $houseOptions = new EditHouse;
    $houses = $houseOptions->getAllHouses();
    # New instance of EditUserType class and calling getAllUserTypes method to display options in drop down
    $userTypeOptions = new EditUserType;
    $userTypes = $userTypeOptions->getAllUserTypes();
?>
<!DOCTYPE>
<html>
<head>
<title> Change User Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change User Details </h1> <hr>

<!-- Form to change an existing user's details -->
<form method='post' action='/classes/view/change_user.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down menu to select the user to change -->
<b> Select which user you want to change: </b><br>
<select name='user' style='width:20%; font-size:15px'>
<?php # Foreach loop throu all users
    foreach ($users as $user){ ?>
        <option value=
        <?php # Each option will be assigned with the user's ID
            echo $user['userID'];
        ?>
        >
        <?php # Each option on the form will be displayed with the user's name
            echo $user['userName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text/Email input to enter user's new email -->
<b> New ID/Email (Optional): </b><br>
<input style="width:30%; font-size:20px" type="email" name="newEmail"> <br><hr>

<!-- Text input to enter the user's new name -->
<b> New Name (Optional): </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName"> <br><hr>

<!-- Drop down menu to select the user's new house -->
<b> New House (Optional): </b><br>
<select name='house' style='width:20%; font-size:15px'>
<option disabled selected value> Select an option </option>
<?php # Foreach loop throu all houses
    foreach ($houses as $house){ ?>
        <option value=
        <?php # Each option will be assigned with the house's ID
            echo $house['houseID'];
        ?>
        >
        <?php # Each option on the form will be displayed with the house's name
            echo $house['houseName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Drop down menu to select the user's new type -->
<b> New User Type (Optional): </b><br>
<select name='userType' style='width:20%; font-size:15px'>
<option disabled selected value> Select an option </option>
<?php # Foreach loop throu all user types
    foreach ($userTypes as $userType){ ?>
        <option value='
        <?php # Each option will be assigned with the type's ID
            echo $userType['userTypeID'];
        ?>
        '>
        <?php # Each option on the form will be displayed with the user type's name
            echo $userType['typeName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Submit/Change button to proceed and a reset button to start again if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # New instance of ViewUser class and running showUsers method to display all users
    $viewUsers = new ViewUser(viewAll);
    $viewUsers->showUsers();
?>
</body>
</html>
