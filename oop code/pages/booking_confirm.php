
<?php
    # Including and creating an instance of the ConfirmBooking class from the php files where this is located, plus the Db class to have access to the database
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/booking_confirm.ctrl.php');
    $confirmBooking = new ConfirmBooking;
?>

<!DOCTYPE>
<html>
<head>
<title> Confirm Your Booking </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button><hr>
<h1> Confirm Your Booking </h1><hr>

<?php
    # Assigning the values set by the user in the add_booking form to new variables
    $name = $_POST['name'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $eventName = $_POST['eventName'];
    $facility = $_POST['facility'];
    $equipment = $_POST['equipment'];
    $user = $_POST['user'];
    $house = $_POST['house'];
    $yearGroup = $_POST['yearGroup'];

    # Calls the checkName method to validate the name given
    echo "<b> Name: </b><br>";
    $confirmBooking->checkName($name);
    echo "<hr>";

    # Calls the checkOverlap method and checks to see whether or not the times are overlapping with other bookings
    echo "<b> Start Time: </b><br>";
    echo "Your event will start at: <b>" . $startTime . "</b><br>";
    echo "<b style='Color:blue'> If you entered the time manually, make sure the format is correct (YYYY-MM-DD hh:mm) or it will fail to book </b><br>";
    $confirmBooking->checkOverlap($startTime, $endTime);
    echo "<hr>";

    # Calls the checkTimeOrder method and checks to see whether or not the start time is before the end time
    echo "<b> End Time: </b><br>";
    echo "Your event will end at: <b>" . $endTime . "</b><br>";
    echo "<b style='Color:blue'> If you entered the time manually, make sure the format is correct (YYYY-MM-DD hh:mm) or it will fail to book. </b><br>";
    $confirmBooking->checkTimeOrder($startTime, $endTime);
    echo "<hr>";

    # Calls the checkEventName method to check if the eventName field was filled in or not
    echo "<b> Event Name: </b><br>";
    $confirmBooking->checkEventName($eventName);
    echo "<hr>";
    
    # Displays the facilities chosen and checks whether or not there are any overlapping facilities based on the overlapping bookings
    echo "<b> Facility: </b><br>";
    echo "You have chosen the following facility: <br>";
    if (!(empty($facility))){
        foreach ($facility as $facilityID){
            $confirmBooking->showName(facilityName, $facilityID);
        }
    }else{
        echo "<i> No Facility Chosen </i><br>";
    }
    if ($confirmBooking->overlap == True){
        echo "<b style='Color:red'> Facility with overlapping schedules: </b><br>";
        echo "<Table align='center'>";
        echo "<tr>";
        echo "<th> ID </th>";
        echo "<th> Facility Name </th>";
        echo "</tr>";
        foreach($facility as $facilityID){
            foreach($confirmBooking->overlapID as $overlapID){
                $confirmBooking->checkFacilityOverlap($overlapID, $facilityID);
            }
        }
        echo "</table>";
    }
    echo "<hr>";
    
    # Displays the equipment chosen and checks whether or not there are any overlapping equipment based on the overlapping bookings
    echo "<b> Equipment: </b><br>";
    echo "You have chosen the following equipment: <br>";
    if (!(empty($equipment))){
        foreach ($equipment as $equipmentID){
            $confirmBooking->showName(equipmentName, $equipmentID);
        }
    }else{
        echo "<i> No Equipment Chosen </i><br>";
    }
    if ($confirmBooking->overlap == True){
        echo "<b style='Color:red'> Equipment with overlapping schedules: </b><br>";
        echo "<Table align='center'>";
        echo "<tr>";
        echo "<th> ID </th>";
        echo "<th> Equipment Name </th>";
        echo "</tr>";
        foreach($equipment as $equipmentID){
            foreach($confirmBooking->overlapID as $overlapID){
                $confirmBooking->checkEquipmentOverlap($overlapID, $equipmentID);
            }
        }
        echo "</table>";
    }
    echo "<hr>";

    # Displays the users chosen and checks whether or not there are any overlapping users based on the overlapping bookings
    echo "<b> User: </b><br>";
    echo "You have chosen the following user: <br>";
    if (!(empty($user))){
        foreach ($user as $userID){
            $confirmBooking->showName(userName, $userID);
        }
    }else{
        echo "<i> No User Chosen </i><br>";
    }
    if ($confirmBooking->overlap == True){
        echo "<b style='Color:red'> User with overlapping schedules: </b><br>";
        echo "<Table align='center'>";
        echo "<tr>";
        echo "<th> ID </th>";
        echo "<th> User Name </th>";
        echo "</tr>";
        foreach($user as $userID){
            foreach($confirmBooking->overlapID as $overlapID){
                $confirmBooking->checkUserOverlap($overlapID, $userID);
            }
        }
        echo "</table>";
    }
    echo "<hr>";
    
    # Displays all the houses chosen (if any) and does this by calling the showName method
    echo "<b> House: </b><br>";
    echo "You have chosen the following house: <br>";
    if (!(empty($house))){
        foreach ($house as $houseID){
            $confirmBooking->showName(houseName, $houseID);
        }
    }else{
        echo "<i> No House Chosen </i><br>";
    }
    echo "<hr>";
    
    # Displays all the year groups chosen (if any) and does this by calling the showName method
    echo "<b> Year Group: </b><br>";
    echo "You have chosen the following year group: <br>";
    if (!(empty($yearGroup))){
        foreach ($yearGroup as $groupID){
            $confirmBooking->showName(groupName, $groupID);
        }
    }else{
        echo "<i> No Year Group Chosen </i><br>";
    }
    echo "<hr>";
    
    # Calls the allowAdd method in the class to make sure no facility/equipment/user are overlapping
    # If even one is overlapping, the 'Book' button is blocked
    $proceed = $confirmBooking->allowAdd();
    if ($proceed == True){ ?>
        <form action="booking_added.php" method="post" onsubmit="return confirm('Are you sure you want to make this booking?\n\nIf you have any other events that start at the same time, make sure any facilities, equipment, and users are not double booked.\n\nRemember, if you entered date/time information manually, make sure it is in the correct format (YYYY-MM-DD hh:mm) or it will not book and you will have to re-enter the information.')">
        <input class="navButton" type="submit" name="submit" value="Book">
    <?php
    }else{
        echo "<button class='navButton' disabled> Book </button>";
    }
        
    # Makes sure that the form data is sent/posted to the next page where it will be used to add the booking
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['eventName'] = $eventName;
    $_SESSION['startTime'] = $startTime;
    $_SESSION['endTime'] = $endTime;
    $_SESSION['facility'] = $facility;
    $_SESSION['equipment'] = $equipment;
    $_SESSION['user'] = $user;
    $_SESSION['house'] = $house;
    $_SESSION['yearGroup'] = $yearGroup;
    
?>

</body>
</html>



