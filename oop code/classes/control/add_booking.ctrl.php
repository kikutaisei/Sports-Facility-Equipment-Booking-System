
<?php
    # Class used to select and display the available options for adding a booking
    # Extends from the Db, model class so it can connect to the database and send queries
    class AddBooking extends Db {
        
        # Method used to choose an appropriate SQL query based on the type of data requested
        private function getSql($type){
            switch($type){
                case "facility":
                    $sql = "SELECT facilityID, facilityName
                            FROM facility";
                    return $sql;
                    break;
                    
                case "equipment":
                    $sql = "SELECT equipment.equipmentID, equipment.equipmentName, equipment.numAvailable, storage.storageName
                            FROM equipment, storage
                            WHERE storage.storageID = equipment.storageID";
                    return $sql;
                    break;
                    
                case "user":
                    $sql = "SELECT user.userID, user.userName, userType.typeName
                            FROM user, userType
                            WHERE user.userTypeID = userType.userTypeID";
                    return $sql;
                    break;
                    
                case "house":
                    $sql = "SELECT houseID, houseName
                            FROM house WHERE houseID != 1";
                    return $sql;
                    break;
                    
                case "yearGroup":
                    $sql = "SELECT groupID, groupName
                            FROM yearGroup";
                    return $sql;
                    break;
            }
        }
        
        # This method is used to display all the available options from the database by calling the getSql method above
        public function getOptions($type){
            $sql = $this->getSql($type);
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $options[] = $row;
            }
            return $options;
        }
    }
    
?>

