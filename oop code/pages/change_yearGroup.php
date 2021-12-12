<?php # Include Db, EditYearGroup and ViewYearGroup classes to display the options for the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_yearGroup.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_yearGroup.view.php');
    # New instance of the EditYearGroup class and the getAllYearGroups method
    $yearGroupOptions = new EditYearGroup;
    $yearGroups = $yearGroupOptions->getAllYearGroups();
?>
<!DOCTYPE>
<html>
<head>
<title> Change Year Group Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change Year Group Details </h1> <hr>

<!-- Form to change the number of students in a chosen year groups -->
<form method='post' action='/classes/view/change_yearGroup.view.php' onsubmit="return confirm('Are you sure you want to make these changes?')">

<!-- Drop down menu to select the year group -->
<b> Select which year group you want to change: </b><br>
<select name='yearGroup' style='width:20%; font-size:15px'>
<?php
    foreach ($yearGroups as $yearGroup){ ?>
        <option value='
        <?php
            echo $yearGroup['groupID'];
        ?>
        '>
        <?php
            echo $yearGroup['groupName'];
        ?>
        </option>
        <?php
    }
?>
</select><br><hr>

<!-- Number input to enter the new number of students -->
<b> Number of Students </b><br>
<input type="number" name="numStudent" min="0" required <br><hr>

<!-- Submit/Change button to move on  to the next page, and a reset button to start again -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Change"><hr>
</form>

<?php # New instance of the ViewYearGroup class and showYearGroups method to display all the year groups
    $viewYearGroups = new ViewYearGroup(viewAll);
    $viewYearGroups->showYearGroups();
?>
</body>
</html>
