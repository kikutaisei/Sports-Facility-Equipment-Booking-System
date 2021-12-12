<!DOCTYPE>
<html>
<head>
<title> BST Sports & Equipment Booking System </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">

<style>
.addButton{background-color:red}
.viewButton{background-color:orange}
.deleteButton{background-color:gold}
.editButton{background-color:grey}
</style>
</head>

<body>

<h1 style = "Font-size:45px; Text-align:center;"> BST Sports Facility & Equipment Booking System </h1>
<h1 style = "Font-size:45px; Text-align:center;"> Select an Option: </h2>

<button class="homePageButton addButton" onclick="window.location.href='/pages/add_booking.php'" > Add Booking </button>
<br>
<button class="homePageButton viewButton" onclick="window.location.href='/pages/view_bookings.php'"> View Bookings </button>
<br>
<button class="homePageButton deleteButton" onclick="window.location.href='/pages/delete_bookings.php'"> Delete Booking(s) </button>
<br>
<button class="homePageButton editButton" onclick="window.location.href='edit_data.php'"> View/Edit Data </button>

</body>
</html>
