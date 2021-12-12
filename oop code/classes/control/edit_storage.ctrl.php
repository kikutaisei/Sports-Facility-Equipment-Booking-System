<?php
    # EditStorage class selects all the data from the storage table, so must extend from the Db class for database access
    # This class contains all methods needed to add a new storage and change an existing storage's name and facility
    class EditStorage extends Db{
        # This method selects all fields for all storages and returns it as an associative array
        public function getAllStorages(){
            $sql = "SELECT * FROM storage";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $storages[] = $row;
            }
            return $storages;
        }
        
        # This method selects all fields for only select storages and returns it as an associative array
        protected function getSpecificStorages($specificIDs){
            $ids = array();
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM storage WHERE storageID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $storages[] = $row;
                }
            }
            return $storages;
        }
        
        # This method takes the facilityID from the storage table for a given storage, and returns the facilityName to be displayed
        public function getStorageFacility($storageID){
            $sql = "SELECT facility.facilityName
                    FROM facility, storage
                    WHERE facility.facilityID = storage.facilityID AND storage.storageID = $storageID";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            return $row['facilityName'];
        }
        
        # Used after deleting/clearing storages to reset the storageID (primary key) counter to 1 or the lowest value
        private function resetID(){
            $sql = "ALTER TABLE storage AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteStorages method deletes a given storage by its stoargeID as the parameter
        public function deleteStorages($deleteID){
            $sql = "DELETE FROM storage WHERE storageID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted storage: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete storage: " . $deleteID . " because there are still equipment within this storage, so delete those first </b><br>";
            }
        }
        
        # clearStorages deletes all storages by selecting all the storages using the getAllStorages method above, then looping through each storage to delete them by calling the deleteStorages method above
        public function clearStorages(){
            $storages = $this->getAllStorages();
            foreach($storages as $storage){
                $this->deleteStorages($storage['storageID']);
            }
        }
        
        # This method changes the storage name by taking the user's new name form input as a parameter
        public function changeStorageName($storageID, $newName){
            $sql = "UPDATE storage
                    SET storageName = '$newName'
                    WHERE storageID = $storageID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Storage: " . $storageID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change storage name </b><br>";
            }
        }
        
        # This method changes the storage's facility by taking the user's new facility form input as a parameter
        public function changeStorageFacility($storageID, $facilityID){
            $sql = "UPDATE storage
                    SET facilityID = $facilityID
                    WHERE storageID = $storageID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Storage: " . $storageID . " facility has successfully been changed to facility: " . $facilityID . "</b><br>";
            }else{
                echo "<b> Failed to change storage facility </b><br>";
            }
        }
        
        # addStorage used to add a new storage to the storage table, by taking the user form inputs as a parameter including the new storage name and its facility
        public function addStorage($storageName, $facilityID){
            $sql = "INSERT INTO storage(storageName, facilityID)
                    VALUES('$storageName', $facilityID)";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New Storage: " . $storageName . " has been successfully added </b>";
            }else{
                echo "<b> Storage: " . $storageName . " couldn't be added </b>";
            }
        }
    }
    
?>
