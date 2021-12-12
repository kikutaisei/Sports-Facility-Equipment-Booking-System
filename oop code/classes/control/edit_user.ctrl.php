<?php # EditUser class selects and retrieves all data from the user table and makes changes to it by extending from the Db class
    class EditUser extends Db{
        # getAllUsers method takes all fields for all the users in the user table and returns an associative array
        public function getAllUsers(){
            $sql = "SELECT * FROM user";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $users[] = $row;
            }
            return $users;
        }
        # getSpecificUsers method takes all fields for only a select number of users specified by the specificIDs parameter
        protected function getSpecificUsers($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM user WHERE userID = '$specificID'";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $users[] = $row;
                }
            }
            return $users;
        }
        # getUserHouse method takes the users houseID field and displays the houseName to the webpage by running the SQL query
        public function getUserHouse($userID){
            $sql = "SELECT house.houseID, house.houseName
                    FROM house, user
                    WHERE user.houseID = house.houseID AND user.userID = '$userID'";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row;
        }
        # getUserType method takes the users userTypeID field and displays the typeName to the webpage by running the SQL query
        public function getUserType($userID){
            $sql = "SELECT userType.typeName
                    FROM user, userType
                    WHERE userType.userTypeID = user.userTypeID AND user.userID = '$userID'";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row['typeName'];
        }
        # getHouseNumUser method retrieves the number of users there are in a given house and returns that number
        private function getHouseNumUser($houseID){
            $sql = "SELECT COUNT(*)
                    FROM user
                    WHERE houseID = $houseID";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row['COUNT(*)'];
        }
        # updateHouseNumUser method is used after a user is deleted or after a user's house has been changed by passing through the houseID and the new number of users
        private function updateHouseNumUser($houseID, $numUser){
            $sql = "UPDATE house
                    SET numUser = $numUser
                    WHERE houseID = $houseID";
            $result = $this->connect()->query($sql);
        }
        # deleteUsers method deletes a given user specified by the deleteID parameter
        public function deleteUsers($deleteID){
            $userHouse = $this->getUserHouse($deleteID); # Retrieves the user's current house
            $houseID = $userHouse['houseID']; # Retrieves the user's current houseID
            $numUsers = $this->getHouseNumUser($houseID); # Retrieves the current house's number of users
            $numUser = ($numUsers - 1); # This variable is the updated number of users in the current house after the changes are made (reduced by 1)
            
            $sql = "DELETE FROM user WHERE userID = '$deleteID'";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted user: " . $deleteID . "</b><br>";
                $this->updateHouseNumUser($houseID, $numUser); # If the change/delete is made, the number of users in the current house will be reduced by 1
            }else{
                echo "<b> Failed to delete user: " . $deleteID . " because there are still bookings who are being supervised by this user, so delete those first </b><br>";
            }
        }
        # clearUsers method takes all the users IDs using the getAllUsers method above, then foreach looping through all of them and deleting them one by one using the deleteUsers method above
        public function clearUsers(){
            $users = $this->getAllUsers();
            foreach($users as $user){
                $this->deleteUsers($user['userID']);
            }
        }
        # changeUserEmail method updates the user table by changing the given user's email/ID
        public function changeUserEmail($userID, $newEmail){
            $sql = "UPDATE user
                    SET userID = '$newEmail'
                    WHERE userID = '$userID'";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> User: " . $userID . " email/ID has successfully been changed to: " . $newEmail . "</b><br>";
            }else{
                echo "<b> Failed to change user email/ID because it already exists </b><br>";
            }
        }
        # changeUserName method updates the user table by changing the given user's name
        public function changeUserName($userID, $newName){
            $sql = "UPDATE user
                    SET userName = '$newName'
                    WHERE userID = '$userID'";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> User: " . $userID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change user name </b><br>";
            }
        }
        # changeUserHouse method updates the user table by changing the given user's house
        # Also changes the house table to update the number of users
        public function changeUserHouse($userID, $newHouseID){
            $userOldHouse = $this->getUserHouse($userID); # Retrieves the user's current house
            $userOldHouseID = $userOldHouse['houseID']; # Retrieves the user's current house's ID number
            $userOldHouseNumUser = $this->getHouseNumUser($userOldHouseID); # Retrieves the current house's number of users by passing through the ID number
            $newNumUser = ($userOldHouseNumUser - 1); # This variable is the updated number of users in the old house after changes are made (reduced bt 1)
            $sql = "UPDATE user
                    SET houseID = $newHouseID
                    WHERE userID = '$userID'";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> User: " . $userID . " house has successfully been changed to: " . $newHouseID . "</b><br>";
                $this->updateHouseNumUser($userOldHouseID, $newNumUser); # Updates the old house's number of users by reducing by 1
                $userNewHouseNumUser = $this->getHouseNumUser($newHouseID); # Retrieves the number of users in the new house
                $this->updateHouseNumUser($newHouseID, $userNewHouseNumUser); # Updates the number of users in the new house
            }else{
                echo "<b> Failed to change user house </b><br>";
            }
        }
        # changeUserType method updates the user type for a given user
        public function changeUserType($userID, $userTypeID){
            $sql = "UPDATE user
                    SET userTypeID = $userTypeID
                    WHERE userID = '$userID'";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> User: " . $userID . " user type has successfully been changed to: " . $userTypeID . "</b><br>";
            }else{
                echo "<b> Failed to change user type </b><br>";
            }
        }
        # addUser method adds a new record in the user table by passing through all the required fields from the form
        public function addUser($userID, $userName, $houseID, $userTypeID){
            $sql = "INSERT INTO user(userID, userName, houseID, userTypeID)
                    VALUES('$userID', '$userName', $houseID, $userTypeID)";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New User: " . $userName . " has been successfully added </b>";
                $numUsers = $this->getHouseNumUser($houseID); # Retrieves the number of users in the new user's house
                $this->updateHouseNumUser($houseID, $numUsers); # Updates the number of users in the house
            }else{
                echo "<b> User: " . $userName . " couldn't be added because the email/ID already exists </b>";
            }
        }
    }
?>
