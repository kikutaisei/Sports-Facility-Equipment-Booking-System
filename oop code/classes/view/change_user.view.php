<?php # Include Db, EditUser and ViewUser classes to connect to the database and make the changes, then display them
    include($_SERVER['DOCUMENT_ROOT'].'/classes/model/db.model.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/control/edit_user.ctrl.php');
    include($_SERVER['DOCUMENT_ROOT'].'/classes/view/edit_user.view.php');
    $changeUserDetails = new EditUser;
?>
<!DOCTYPE>
<html>
<head>
<title> Change User Details </title>
<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
<button class="navButton" onclick="window.location.href='/pages/homepage.php'"> Go Home </button> <hr>
<h1> Change User Details </h1> <hr>
<?php # Assign form results to the following variables
    $userID = $_POST['user'];
    $newUserID = $_POST['newEmail'];
    $newName = $_POST['newName'];
    $houseID = $_POST['house'];
    $userTypeID = $_POST['userType'];
    
    # Tests for each combination of results and runs a different set of methods for each combination
    if ((empty($newUserID)) AND (empty($newName)) AND (empty($houseID)) AND (empty($userTypeID))){
        echo "<b> You made no changes to the user </b>";
    }elseif ((empty($newUserID)) AND (empty($newName)) AND (empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserType($userID, $userTypeID);
    }elseif ((empty($newUserID)) AND (empty($newName)) AND !(empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserHouse($userID, $houseID);
    }elseif ((empty($newUserID)) AND (empty($newName)) AND !(empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserType($userID, $userTypeID);
    }elseif ((empty($newUserID)) AND !(empty($newName)) AND (empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
    }elseif ((empty($newUserID)) AND !(empty($newName)) AND (empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserType($userID, $userTypeID);
    }elseif ((empty($newUserID)) AND !(empty($newName)) AND !(empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserHouse($userID, $houseID);
    }elseif ((empty($newUserID)) AND !(empty($newName)) AND !(empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserType($userID, $userTypeID);
    }elseif (!(empty($newUserID)) AND (empty($newName)) AND (empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND (empty($newName)) AND (empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserType($userID, $userTypeID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND (empty($newName)) AND !(empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND (empty($newName)) AND !(empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserType($userID, $userTypeID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND !(empty($newName)) AND (empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND !(empty($newName)) AND (empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserType($userID, $userTypeID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND !(empty($newName)) AND !(empty($houseID)) AND (empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }elseif (!(empty($newUserID)) AND !(empty($newName)) AND !(empty($houseID)) AND !(empty($userTypeID))){
        $changeUserDetails->changeUserName($userID, $newName);
        $changeUserDetails->changeUserType($userID, $userTypeID);
        $changeUserDetails->changeUserHouse($userID, $houseID);
        $changeUserDetails->changeUserEmail($userID, $newUserID);
    }
    
    # New instance of ViewUser class and showUsers method to display the updated user table after the new user was added
    echo "<hr>";
    echo "<h2> Updated User List: </h2>";
    $updatedUsers = new ViewUser(viewAll);
    $updatedUsers->showUsers();
?>
</body>
</html>
