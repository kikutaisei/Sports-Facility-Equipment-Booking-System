<!DOCTYPE>
<html>
<head>
<title> Add a New Owner </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New Owner </h1> <hr>

<!-- Form with just one text box to enter the owner name -->
<form method='post' action='/classes/view/add_owner.view.php' onsubmit="return confirm('Are you sure you want to add this owner?')">
<b> Owner Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Submit/Add button to move forwards and a reset button to allow the user to restart -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>

</body>
</html>


