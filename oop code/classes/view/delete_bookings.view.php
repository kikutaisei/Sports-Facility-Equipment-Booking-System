<?php
    # Including the Db class for access to the database, ViewBooking and GetBooking classes to be able to display the updated bookings list
    # Including the DeleteBooking class to have access to the methods to delete the given bookings
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/view_bookings.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/view_bookings.view.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/delete_bookings.ctrl.php');
?>
<!DOCTYPE>
<html>
<head>
<title> Delete Your Bookings </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Delete Your Bookings </h1> <hr>
<?php
    # If the user has selected bookings with the checkboxes, those IDs will be assigned to this variable as an array
    $specificDeleteIDs = $_POST['deleteID'];
    
    # Creating a new instance of the ViewBooking class
    # If the user has chosen to delete all bookings, the new object will be set to display all the bookings, but otherwise it will display the chosen bookings
    echo "<h2> You have deleted the following bookings: </h2>";
    if (isset($_POST['clear'])){
        $deletedBookings = new ViewBooking(viewAll);
        $deletedBookings->showBookings(ASC);
    }else{
        $deletedBookings = new ViewBooking(viewSelected, $specificDeleteIDs);
        $deletedBookings->showBookings(ASC);
    }
    echo "<hr>";
    
    # Crating an instance of the DeleteBooking class based on whether or not the user has chosen to delete all or chosen bookings
    if (isset($_POST['clear'])){
        $deleteBooking = new DeleteBooking();
        $deleteBooking->clearAll();
    }else{
        $deleteBooking = new DeleteBooking($specificDeleteIDs);
        $deleteBooking->deleteSelected();
    }
    
    # Ceating a separate, new instance of the ViewBooking class to display the remaining bookings
    echo "<h2> Your Updated Booking List </h2>";
    $updatedBookings = new ViewBooking(viewAll);
    $updatedBookings->showBookings(ASC);
?>
</body>
</html>
