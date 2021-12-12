<?php # Include Db, EditUserType and ViewUserType classes to connect to database and to display the options in the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_userType.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_userType.view.php');
    $userTypeOptions = new EditUserType;
    $userTypes = $userTypeOptions->getAllUserTypes();
?>
<!DOCTYPE>
<html>
<head>
<title> Change User Type Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change User Type Details </h1> <hr>

<!-- Form to make changes to a user type -->
<form method='post' action='/classes/view/change_userType.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down select menu to allow user to choose the user type they want to change -->
<b> Select which user type you want to change: </b><br>
<select name='userType' style='width:20%; font-size:15px'>
<?php
    foreach ($userTypes as $userType){ ?>
        <option value='
        <?php
            echo $userType['userTypeID'];
        ?>
        '>
        <?php
            echo $userType['typeName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Text box for new user type name -->
<b> New Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="newName" required> <br><hr>

<!-- Submit/Change button to proceed and a reset button to restart in case any mistakes are made -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # Creates new instance of the ViewUserType class and calls the showUserTypes method to display the updated user type list
    $viewUserTypes = new ViewUserType(viewAll);
    $viewUserTypes->showUserTypes();
?>
</body>
</html>
