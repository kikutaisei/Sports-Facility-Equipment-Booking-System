<!DOCTYPE>
<html>
<head>
<title> Add a New House </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New House </h1> <hr>

<!-- Form to add new record to the house table -->
<form method='post' action='/classes/view/add_house.view.php' onsubmit="return confirm('Are you sure you want to add this house?')">

<!-- Text box to enter house's name -->
<b> House Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Number input to enter the house's number of students -->
<b> Number of Students: </b><br>
<input type="number" name="numStudent" min="0" required><br><hr>

<!-- Submit/Add button to proceed onwards and t¥a reset button to restart if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>

</body>
</html>
