<?php
    # EditUserType extends from Db to connect to the database and select/make changes to the userType table
    class EditUserType extends Db{
        # This method selects all the userType fields for each record and returns an associative array
        public function getAllUserTypes(){
            $sql = "SELECT * FROM userType";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $userTypes[] = $row;
            }
            return $userTypes;
        }
        
        # This method selects all the userType fields for select records and returns an associative array
        protected function getSpecificUserTypes($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM userType WHERE userTypeID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $userTypes[] = $row;
                }
            }
            return $userTypes;
        }
        
        # This method is used after user types have been deleted or cleared to reset the primary key counter back to 1 or the lowest value
        private function resetID(){
            $sql = "ALTER TABLE userType AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # This method deletes the user type one at a time based on the ID passed through the parameter
        public function deleteUserTypes($deleteID){
            $sql = "DELETE FROM userType WHERE userTypeID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted user type: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete user type: " . $deleteID . " because there are still users within this type, so delete them first </b><br>";
            }
        }
        
        # Deletes all user types by retrieveing all the IDs from the getAllUserTypess method above, then deleting each using the deleteUserTypes method above through a foreach loop
        public function clearUserTypes(){
            $userTypes = $this->getAllUserTypess();
            foreach($userTypes as $userType){
                $this->deleteUserTypes($userType['userTypeID']);
            }
        }
        
        # Updates the userType table by changing the name based on the user's input through the form which is passed in as a parameter
        public function changeUserTypeName($userTypeID, $newName){
            $sql = "UPDATE userType
                    SET typeName = '$newName'
                    WHERE userTypeID = $userTypeID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> User type: " . $userTypeID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change user type name </b><br>";
            }
        }
        
        # Adds a new record into the userType table by passing through the typeName given by the user's form completion
        public function addUserType($typeName){
            $sql = "INSERT INTO userType(typeName)
                    VALUES('$typeName')";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New User type: " . $typeName . " has been successfully added </b>";
            }else{
                echo "<b> User type: " . $typeName . " couldn't be added </b>";
            }
        }
    }
?>
