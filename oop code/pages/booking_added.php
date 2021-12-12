<?php
    # Calling and including the Db and BookingAdded classes to be accessed
    # Calling and including the GetBooking and ViewBooking classes so the new booking and updated booking list can be displayed
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/booking_added.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/view_bookings.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/view_bookings.view.php');
    # Creating a new instance of the BookingAdded class
    $addNewBooking = new BookingAdded;
?>

<!DOCTYPE html>
<html>
<head>
<title> Booking Add </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Booking Add </h1> <hr>

<?php
    # Assigning the form data to new variables to be used
    session_start();
    $name = $_SESSION['name'];
    $eventName = $_SESSION['eventName'];
    $startTime = $_SESSION['startTime'];
    $endTime = $_SESSION['endTime'];
    $facility = $_SESSION['facility'];
    $equipment = $_SESSION['equipment'];
    $user = $_SESSION['user'];
    $house = $_SESSION['house'];
    $yearGroup = $_SESSION['yearGroup'];
    
    # Empty array to push the new booking's ID to be used to display the new booking
    $bookingID = [];
    
    # If the user filled in the eventName field, it would run the bookingWithEvent method, but otherwise it would run the bookingWithoutEvent method
    # Once the initial/required fields are added to the main bookiong table, then the remaining data can be added to the connecting tables
    if(!(empty($eventName))){
        if($addNewBooking->bookingWithEvent($name, $eventName, $startTime, $endTime) == True){
            $newBookingID = $addNewBooking->getNewBookingID();
            $addNewBooking->addBooking(facility, $newBookingID, $facility);
            $addNewBooking->addBooking(equipment, $newBookingID, $equipment);
            $addNewBooking->addBooking(user, $newBookingID, $user);
            $addNewBooking->addBooking(house, $newBookingID, $house);
            $addNewBooking->addBooking(yearGroup, $newBookingID, $yearGroup);
            echo "<b> Booking has been added successfully </b><br>";
            array_push($bookingID, $newBookingID);
            echo "<hr>";
        }else{
            echo "<b> Failed to add the booking because your time format was incorrect </b><hr>";
        }
    }else{
        if($addNewBooking->bookingWithoutEvent($name, $startTime, $endTime) == True){
            $newBookingID = $addNewBooking->getNewBookingID();
            $addNewBooking->addBooking(facility, $newBookingID, $facility);
            $addNewBooking->addBooking(equipment, $newBookingID, $equipment);
            $addNewBooking->addBooking(user, $newBookingID, $user);
            $addNewBooking->addBooking(house, $newBookingID, $house);
            $addNewBooking->addBooking(yearGroup, $newBookingID, $yearGroup);
            echo "<b> Booking has been added successfully </b><br>";
            array_push($bookingID, $newBookingID);
            echo "<hr>";
        }else{
            echo "<b> Failed to add the booking because your time format was incorrect </b><hr>";
        }
    }
    
    # Creating a new instance of the ViewBooking class to display both the new booking and the updated list of bookings
    $showNewBooking = new ViewBooking(viewSelected, $bookingID);
    echo "<h2> Your New Booking </h2>";
    $showNewBooking->showBookings(ASC);
    echo "<hr>";
    
    $updatedBookingList = new ViewBooking(viewAll);
    echo "<h2> Updated Booking List </h2>";
    $updatedBookingList->showBookings(ASC);
?>
</body>
</html>
