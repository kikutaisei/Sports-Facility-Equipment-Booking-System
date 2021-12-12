<!DOCTYPE html>
<html>
<head>
<title> View/Edit Data </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> View/Edit Data </h1> <hr>
<b> This system is managed by a database. You can edit the data within the 8 different tables. </b><br>
<b> The data should only be changed when there are significant changes to the school and/or sports facilities and equipment. </b><br><br>
<b style="color:red"> If you are changing large amounts of data, it is important to consider the order in which you do so. </b><br>
<b style="color:red"> For example, if you want to add a new storage space AND the equipment inside it, you must add the storage first so the equipment can be registered to that new storage. </b><br><br>

<!-- Buttons to redirect user to the specific edit data page -->
<button class="navButton" onclick="window.location.href='edit_owner.php'"> Owner </button>
<button class="navButton" onclick="window.location.href='edit_facility.php'"> Facility </button>
<button class="navButton" onclick="window.location.href='edit_storage.php'"> Storage </button>
<button class="navButton" onclick="window.location.href='edit_equipment.php'"> Equipment </button> <br><br>
<button class="navButton" onclick="window.location.href='edit_userType.php'"> User Type </button>
<button class="navButton" onclick="window.location.href='edit_user.php'"> User </button>
<button class="navButton" onclick="window.location.href='edit_house.php'"> House </button>
<button class="navButton" onclick="window.location.href='edit_yearGroup.php'"> Year Group </button>
<hr>
</body>
</html>

