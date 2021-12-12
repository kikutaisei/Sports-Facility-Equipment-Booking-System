<?php
    # EditEquipment class selects all the data from the equipment table, so must extend from the Db class for database access
    # This class contains all methods needed to add new equipment and change an existing equipment's name, storage, and number available
    class EditEquipment extends Db{
        # This method selects all fields for all equipment and returns it as an associative array
        public function getAllEquipment(){
            $sql = "SELECT * FROM equipment";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $equipment[] = $row;
            }
            return $equipment;
        }
        
        # This method selects all fields for only select equipment and returns it as an associative array
        protected function getSpecificEquipment($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM equipment WHERE equipmentID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $equipment[] = $row;
                }
            }
            return $equipment;
        }
        
        # This method takes the storageID from the equipment table for a given equipment, and returns the storageName to be displayed
        public function getEquipmentStorage($equipmentID){
            $sql = "SELECT storage.storageName
                    FROM storage, equipment
                    WHERE equipment.storageID = storage.storageID AND equipment.equipmentID = $equipmentID";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row['storageName'];
        }
        
        # Used after deleting/clearing equipment to reset the equipmentID (primary key) counter to 1 or the lowest value
        private function resetID(){
            $sql = "ALTER TABLE equipment AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteEquipment method deletes a given equipment by its equipmentID as the parameter
        public function deleteEquipment($deleteID){
            $sql = "DELETE FROM equipment WHERE equipmentID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted equipment: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete equipment: " . $deleteID . " because there are still bookings with this equipment, so delete those first </b><br>";
            }
        }
        
        # clearEquipment deletes all equipment by selecting all the equipment using the getAllEquipment method above, then looping through each equipment to delete them by calling the deleteEquipment method above
        public function clearEquipment(){
            $equipment = $this->getAllEquipment();
            foreach($equipment as $equipment){
                $this->deleteEquipment($equipment['equipmentID']);
            }
        }
        
        # This method changes equipment names by taking the user's new name form input as a parameter
        public function changeEquipmentName($equipmentID, $newName){
            $sql = "UPDATE equipment
                    SET equipmentName = '$newName'
                    WHERE equipmentID = $equipmentID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Equipment: " . $equipmentID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change equipment name </b><br>";
            }
        }
        
        # This method changes the equipment storage by taking the user's new storage form input as a parameter
        public function changeEquipmentStorage($equipmentID, $storageID){
            $sql = "UPDATE equipment
                    SET storageID = $storageID
                    WHERE equipmentID = $equipmentID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Equipment: " . $equipmentID . " storage has successfully been changed to storage: " . $storageID . "</b><br>";
            }else{
                echo "<b> Failed to change equipment storage </b><br>";
            }
        }
        
        # This method changes the equipment's total number by taking the user's new number form input as a parameter
        public function changeEquipmentNum($equipmentID, $numAvailable){
            $sql = "UPDATE equipment
                    SET numAvailable = $numAvailable
                    WHERE equipmentID = $equipmentID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Equipment: " . $equipmentID . " number has successfully been changed to: " . $numAvailable . "</b><br>";
            }else{
                echo "<b> Failed to change equipment number </b><br>";
            }
        }
        
        # addEquipment used to add new equipment to the equipment table, by taking the user form inputs as a parameter including the new equipment name, its facility and the number available
        public function addEquipment($equipmentName, $storageID, $numAvailable){
            $sql = "INSERT INTO equipment(equipmentName, storageID, numAvailable)
                    VALUES('$equipmentName', $storageID, $numAvailable)";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New Equipment: " . $equipmentName . " has been successfully added </b>";
            }else{
                echo "<b> Equipment: " . $equipmentName . " couldn't be added </b>";
            }
        }
    }
?>
