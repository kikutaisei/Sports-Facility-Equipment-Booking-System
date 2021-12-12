<?php
    # Including the Db and Calendar classes to display the bookings in the calendar format
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/calendar_view.view.php');
    # Creating new instance of the Calendar class
    $calendarView = new Calendar;

    # Getting all the necessary information about the dates for the navigation bar
    $yearMonth = $calendarView->getYearMonth();
    $timeFormat = $calendarView->checkTimeFormat($yearMonth);
    $navHeader = $calendarView->getNavHeader($timeFormat);
    $prevLink = $calendarView->getPrevLink($timeFormat);
    $nextLink = $calendarView->getNextLink($timeFormat);
    # Returns all the information needed to display one week/row
    $weeks = $calendarView->showCalendar();
?>
<!DOCTYPE>
<html>
<head>
<title> Calendar View </title>
<link rel="stylesheet" type="text/css" href="/style/calendar_style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Calendar View </h1> <hr>
<h2><a href="?ym=<?php echo $prevLink; ?>"> Prev </a> <?php echo $navHeader; ?> <a href="?ym=<?php echo $nextLink; ?>"> Next </a></h2>

<?php
    # Headers for the calendar
    echo "<table align='center'>";
    echo "<tr>";
    echo "<th> Sunday </th>";
    echo "<th> Monday </th>";
    echo "<th> Tuesday </th>";
    echo "<th> Wednesday </th>";
    echo "<th> Thursday </th>";
    echo "<th> Friday </th>";
    echo "<th> Saturday </th>";
    echo "</tr>";
    # Foreach loop through all the weeks
    foreach ($weeks as $week) {
        echo $week;
    }
    echo "</table>";
?>
</body>
</html>
