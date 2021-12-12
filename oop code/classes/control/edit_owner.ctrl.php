<?php
    # EditOwner class selects all the data from the owner table, so must extend from the Db class for database access
    # This class contains all methods needed to add a new owner and change an existing owner's name
    class EditOwner extends Db{
        # This method selects all fields for all owners and returns it as an associative array
        public function getAllOwners(){
            $sql = "SELECT * FROM owner";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $owners[] = $row;
            }
            return $owners;
        }
        
        # This method selects all fields for only select owners and returns it as an associative array
        protected function getSpecificOwners($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM owner WHERE ownerID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $owners[] = $row;
                }
            }
            return $owners;
        }
        
        # Used after deleting/clearing owners to reset the ownerID (primary key) counter to 1 or the lowest value
        private function resetID(){
            $sql = "ALTER TABLE owner AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteOwners method deletes a given owner by its ownerID as the parameter
        public function deleteOwners($deleteID){
            $sql = "DELETE FROM owner WHERE ownerID = $deleteID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Successfully deleted owner: " . $deleteID . "</b><br>";
                $this->resetID();
            }else{
                echo "<b> Failed to delete owner: " . $deleteID . " because there are still facility being owned by this owner, so delete those first </b><br>";
            }
        }
        
        # clearOwners deletes all owners by selecting all the owners using the getAllOwners method above, then looping through each owner to delete them by calling the deleteOwners method above
        public function clearOwners(){
            $owners = $this->getAllOwners();
            foreach($owners as $owner){
                $this->deleteOwners($owner['ownerID']);
            }
        }
        
        # changeOwnerName method used to edit the owner's name by inputting the user form input as a parameter
        public function changeOwnerName($ownerID, $newName){
            $sql = "UPDATE owner
                    SET ownerName = '$newName'
                    WHERE ownerID = $ownerID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Owner: " . $ownerID . " name has successfully been changed to: " . $newName . "</b><br>";
            }else{
                echo "<b> Failed to change owner name </b><br>";
            }
        }
        
        # addOwner used to add a new owner to the owner table, by taking the user form input as a parameter
        public function addOwner($ownerName){
            $sql = "INSERT INTO owner(ownerName)
                    VALUES('$ownerName')";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> New Owner: " . $ownerName . " has been successfully added </b>";
            }else{
                echo "<b> Owner: " . $ownerName . " couldn't be added </b>";
            }
        }
    }
?>
