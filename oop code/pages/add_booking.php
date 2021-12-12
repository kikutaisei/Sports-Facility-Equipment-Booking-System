
<?php
    # Including the pages to have access to the Db and AddBooking classes for the form
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/add_booking.ctrl.php');
    # Creating new instance of the AddBooking class
    $addBookingForm = new AddBooking;
?>

<!DOCTYPE>
<html>
<head>
<title> Add a Booking </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a Booking </h1> <hr>

<!-- Form to add a booking -->
<form action="booking_confirm.php" method="post">
<b style="color:red"> The first 3 fields are required </b> <br>

<!-- Text box to input name -->
<b> Your Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><br>

<!-- Input/Time for start time -->
<b> Start Time: </b><br>
<input style="width:30%; font-size:20px" type="datetime-local" name="startTime" required> <br><br>

<!-- Input/Time for end time -->
<b> End Time: </b><br>
<input style="width:30%; font-size:20px" type="datetime-local" name="endTime" required> <br><hr>

<!-- Text box to input event name -->
<p> What would you like the name of your event to be called? If you leave this field blank, the default name will be 'PE Lesson' </p>
<b> Event Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="eventName" placeholder="PE Lesson"> <br><hr>

<!-- Checkbox to select multiple facilities -->
<p> Which facilities would you like to use for your event? You can select multiple by holding control or command </p>
<b> Facility: </b><br>
<?php # Using the getOptions method in the AddBooking class to select all the facilities from the facility table
    $facilityOptions = $addBookingForm->getOptions(facility);
    foreach($facilityOptions as $facilityOption){
        $facilityID = $facilityOption['facilityID'];
        $facilityName = $facilityOption['facilityName'];
        echo "<input type='checkbox' name='facility[]' value='$facilityID'>" . $facilityName . "<br>";
    }
?> <hr>

<!-- Multiple select for equipment -->
<p> Which equipment would you like to use for your event? You can select multiple by holding control or command </p>
<b> Equipment: </b><br>
<?php # Using the getOptions method in the AddBooking class to select all the equipment from the equipment table
    $equipmentOptions = $addBookingForm->getOptions(equipment);
    echo "<select name='equipment[]' multiple size='20' style='width:40%; font-size:15px'>";
    foreach($equipmentOptions as $equipmentOption){
        $equipmentID = $equipmentOption['equipmentID'];
        $equipmentName = $equipmentOption['equipmentName'];
        $numAvailable = $equipmentOption['numAvailable'];
        $storageName = $equipmentOption['storageName'];
        echo "<option value='$equipmentID'>" . $equipmentName . " (" . $numAvailable . " Available): " . $storageName . "</option>";
    }
    echo "</select>";
?> <hr>

<!-- Multiple select for users -->
<p> Which users would you like to use for your event? You can select multiple by holding control or command </p>
<b> User: </b><br>
<?php
    # Using the getOptions method in the AddBooking class to select all the users from the user table
    $userOptions = $addBookingForm->getOptions(user);
    echo "<select name='user[]' multiple size='20' style='width:40%; font-size:15px'>";
    foreach($userOptions as $userOption){
        $userID = $userOption['userID'];
        echo "<option value='$userID'>" . $userOption[userName] . ": " . $userOption[typeName] . "</option>";
    }
    echo "</select>";
?> <hr>

<!-- Checkbox to select multiple houses -->
<p> Which house would you like to use for your event? </p>
<b> House: </b><br>
<?php
    # Using the getOptions method in the AddBooking class to select all the houses from the house table
    $houseOptions = $addBookingForm->getOptions(house);
    foreach($houseOptions as $houseOption){
        $houseID = $houseOption['houseID'];
        $houseName = $houseOption['houseName'];
        echo "<input type='checkbox' name='house[]' value='$houseID'> " . $houseName . "<br>";
    }
?> <hr>

<!-- Checkbox to select multiple year groups -->
<p> Which year group would you like to use for your event? </p>
<b> Year Group: </b><br>
<?php
    # Using the getOptions method in the AddBooking class to select all the year groups from the yearGroup table
    $yearGroupOptions = $addBookingForm->getOptions(yearGroup);
    foreach($yearGroupOptions as $yearGroupOption){
        $groupID = $yearGroupOption['groupID'];
        $groupName = $yearGroupOption['groupName'];
        echo "<input type='checkbox' name='yearGroup[]' value='$groupID'> " . $groupName . "<br>";
    }
?> <hr>

<!-- Submit and reset button to move onto the confirmation page -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Next">
</form>
</body>
</html>
