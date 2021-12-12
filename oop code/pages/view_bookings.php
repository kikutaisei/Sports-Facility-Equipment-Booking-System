<?php
    # Including the GetBooking and ViewBooking class to be able to display all the bookings
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/view_bookings.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/view_bookings.view.php');
?>
<!DOCTYPE>
<html>
<head>
<title> View Your Bookings </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View Your Bookings </h1> <hr>

<!-- Button to view the bookings in a calendar format -->
<button class="navButton" onclick="window.location.href='/pages/calendar_view.php'"> Calendar View </button><hr>

<!-- Checkbox form to choose which order the bookings should be displayed in -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <input type="radio" name="view" value="ASC" <?php if (isset($_POST['view']) && $_POST['view']=="ASC") echo "checked";?> checked > Oldest First <br>
  <input type="radio" name="view" value="DESC" <?php if (isset($_POST['view']) && $_POST['view']=="DESC") echo "checked";?>> Newest First <br>
  <input type="submit" value="Filter">
</form><hr>

<?php # Displaying the bookings in the order based on the form result above
    $showBookings = new ViewBooking(viewAll);
    if (isset($_POST['view'])) {
        $viewOrder = ($_POST["view"]);
    }
    $showBookings->showBookings($viewOrder);
?>
</body>
</html>
