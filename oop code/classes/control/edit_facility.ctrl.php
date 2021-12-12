<?php
    # EditFacility class selects all the data from the facility table, so must extend from the Db class for database access
    # This class contains all methods needed to add a new facility and change an existing facility's name and owner
    class EditFacility extends Db{
        # This method selects all fields for all facilities and returns it as an associative array
        public function getAllFacilities(){
            $sql = "SELECT * FROM facility";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $facilities[] = $row;
            }
            return $facilities;
        }
        
        # This method selects all fields for only select facilities and returns it as an associative array
        protected function getSpecificFacilities($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM facility WHERE facilityID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $facilities[] = $row;
                }
            }
            return $facilities;
        }
        
        # This method takes the ownerID from the facility table for a given facility, and returns the ownerName to be displayed
        public function getFacilityOwner($facilityID){
            $sql = "SELECT owner.ownerName
                    FROM owner, facility
                    WHERE facility.ownerID = owner.ownerID AND facility.facilityID = $facilityID";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row['ownerName'];
        }
        
        # Used after deleting/clearing facilities to reset the facilityID (primary key) counter to 1 or the lowest value
        private function resetID(){
            $sql = "ALTER TABLE facility AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteFacilities method deletes a given facility by its facilityID as the parameter
        public function deleteFacilities($deleteID){
            $sql = "DELETE FROM facility WHERE facilityID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted facility: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete facility: " . $deleteID . " because there are still storage/booking(s) with this facility, so delete those first </b><br>";
            }
        }
        
        # clearFacilities deletes all facilities by selecting all the facilities using the getAllFacilities method above, then looping through each facility to delete them by calling the deleteFacilities method above
        public function clearFacilities(){
            $facilities = $this->getAllFacilities();
            foreach($facilities as $facility){
                $this->deleteFacilities($facility['facilityID']);
            }
        }
        
        # This method changes the facility name by taking the user's new name form input as a parameter
        public function changeFacilityName($facilityID, $newName){
            $sql = "UPDATE facility
                    SET facilityName = '$newName'
                    WHERE facilityID = $facilityID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Facility: " . $facilityID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change facility name </b><br>";
            }
        }
        
        # This method changes the facility's owner by taking the user's new owner form input as a parameter
        public function changeFacilityOwner($facilityID, $ownerID){
            $sql = "UPDATE facility
                    SET ownerID = $ownerID
                    WHERE facilityID = $facilityID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Facility: " . $facilityID . " owner has successfully been changed to owner: " . $ownerID . "</b><br>";
            }else{
                echo "<b> Failed to change facility owner </b><br>";
            }
        }
        
        # addFacility used to add a new facility to the facility table, by taking the user form inputs as a parameter including the new facility name and its owner
        public function addFacility($facilityName, $ownerID){
            $sql = "INSERT INTO facility(facilityName, ownerID)
                    VALUES('$facilityName', $ownerID)";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New Facility: " . $facilityName . " has been successfully added </b>";
            }else{
                echo "<b> Facility: " . $facilityName . " couldn't be added </b>";
            }
        }
    }
?>
