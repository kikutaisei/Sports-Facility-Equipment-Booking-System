<?php # Include Db, EditHouse and EditUserType classes to connect to database and have options for house and user types in the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_house.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    # New instance of EditHouse class for the drop down menu below
    $houseOptions = new EditHouse;
    $houses = $houseOptions->getAllHouses();
    # New instance of EditUserType class for the drop down menu below
    $userTypeOptions = new EditUserType;
    $userTypes = $userTypeOptions->getAlluserTypes();
?>
<!DOCTYPE>
<html>
<head>
<title> Add a New User </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New User </h1> <hr>

<!-- Form that takes input to add a new record in the user table -->
<form method='post' action='/classes/view/add_user.view.php' onsubmit="return confirm('Are you sure you want to add this user?')">

<!-- Text input to add new user's name -->
<b> User Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Text/Email input for new user's email/ID -->
<b> User Email: </b><br>
<input style="width:30%; font-size:20px" type="email" name="ID" required> <br><hr>

<!-- Drop down select menu to choose the user's house -->
<b> House: </b><br>
<select name='house' style='width:20%; font-size:15px'>
<?php # Foreach loop through all houses
    foreach ($houses as $house){ ?>
        <option value='
        <?php # Each option will be assigned with the houseID
            echo $house['houseID'];
        ?>
        '>
        <?php # Each option on the form will display the houseName
            echo $house['houseName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Drop down select menu to choose the user's type -->
<b> User Type: </b><br>
<select name='userType' style='width:20%; font-size:15px'>
<?php #Foreach loop through all user types
    foreach ($userTypes as $userType){ ?>
        <option value='
        <?php # Each option will be assigned with the userTypeID
            echo $userType['userTypeID'];
        ?>
        '>
        <?php # Each option on the form will display the typeName
            echo $userType['typeName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Submit/Add button to proceed and a reset button to start over -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>
</body>
</html>
