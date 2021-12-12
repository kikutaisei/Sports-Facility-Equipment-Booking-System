<!DOCTYPE>
<html>
<head>
<title> Add a New User Type </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.history.back()"> Go Back </button>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Add a New User Type </h1> <hr>

<!-- Form that takes user text input to add a new user type -->
<form method='post' action='/classes/view/add_userType.view.php' onsubmit="return confirm('Are you sure you want to add this user type?')">

<!-- Text input for user type name -->
<b> User Type Name: </b><br>
<input style="width:30%; font-size:20px" type="text" name="name" required> <br><hr>

<!-- Submit/Add button to proceed and a reset button to restart if needed -->
<input class ="navButton" type="reset">
<input class="navButton" type="submit" name="submit" value="Add"><hr>
</form>
</body>
</html>
