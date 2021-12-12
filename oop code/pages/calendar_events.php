<?php
    # Including the GetBooking and ViewBooking class to be able to display all the bookings
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/view_bookings.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/view_bookings.view.php');
    # Include Calendar class to find the specific booking IDs for a given date
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/calendar_view.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Calendar View </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Calendar View </h1> <hr>
<?php # Once the user clicks on the view button, the date is assigned to this variable
    $bookingDate = $_POST['eventDate'];
    
    # New instance of calendar class
    $bookingCalendar = new Calendar;
    # Calling the getBooking method to return the list of bookingIDs for the given date
    $bookingIDs = $bookingCalendar->getBooking($bookingDate);
    
    # Creating new instance of ViewBooking class and showBookings method to display the bookings in a given date
    $showCalendarEvents = new ViewBooking(viewSelected, $bookingIDs);
    $showCalendarEvents->showBookings(ASC);
?>
</body>
</html>
