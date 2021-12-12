<?php # EditHouse class connects to the database via the Db class and retrieves and dsiplays all the information from the house table
    class EditHouse extends Db{
        # getAllHouses method selects all fields for all houses from the house table and returns an associative array
        public function getAllHouses(){
            $sql = "SELECT * FROM house";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $houses[] = $row;
            }
            return $houses;
        }
        
        # getSpecificHouses method selects all fields for only a select number houses (specified by the parameter) from the house table and returns an associative array
        protected function getSpecificHouses($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM house WHERE houseID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $houses[] = $row;
                }
            }
            return $houses;
        }
        
        # resetID method resets the houseID counter back to 1 or the lowest value after a house(s) has been deleted/cleared
        private function resetID(){
            $sql = "ALTER TABLE house AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteHouses method deletes a house one by one specified by the parameter
        public function deleteHouses($deleteID){
            $sql = "DELETE FROM house WHERE houseID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted house: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete house: " . $deleteID . " because there are still users within this house, so delete them first </b><br>";
            }
        }
        
        # clearHouses method takes all the houses IDs from the getAllHouses method above, then loops through all of them to delete each house with the deleteHouses method above
        public function clearHouses(){
            $houses = $this->getAllHouses();
            foreach($houses as $house){
                $this->deleteHouses($house['houseID']);
            }
        }
        
        # changeHouseName method changes the house's name by passing through a value/string from the form
        public function changeHouseName($houseID, $newName){
            $sql = "UPDATE house
                    SET houseName = '$newName'
                    WHERE houseID = $houseID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> House: " . $houseID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change house name </b><br>";
            }
        }
        
        # changeHouseNumStudent method changes the house's number of students by passing through a integer from the form
        public function changeHouseNumStudent($houseID, $numStudent){
            $sql = "UPDATE house
                    SET numStudent = $numStudent
                    WHERE houseID = $houseID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> House: " . $houseID . " student number has successfully been changed to: " . $numStudent . "</b><br>";
            }else{
                echo "<b> Failed to change number of students </b><br>";
            }
        }
        
        # addHouse method adds a new record to the house table
        # The number of users is set to 0, and can be increased in the EditUser class when a new user is added to this house, or if an existing user changes house
        public function addHouse($houseName, $numStudent){
            $sql = "INSERT INTO house(houseName, numStudent, numUser)
                    VALUES('$houseName', $numStudent, 0)";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New House: " . $houseName . " has been successfully added </b>";
            }else{
                echo "<b> House: " . $houseName . " couldn't be added </b>";
            }
        }
    }
?>
