
<?php
    # This class is used to delete either all or chosen bookings from the booking table and all other connected tables
    class DeleteBooking extends Db {
        private $specificIDs;
        
        # If the user has chosen specific bookings to delete, it will be included as a parameter in the constructor where it is assigned to the specificIDs property above
        public function __construct($specificDeleteIDs = null){
            if (isset($specificDeleteIDs)){
                $this->specificIDs = $specificDeleteIDs;
            }
        }
        
        # Used in the clearAll method below where all bookings IDs are selected from the booking table and added to an associative array
        private function getAllDeleteIDs(){
            $sql = "SELECT bookingID FROM booking";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $allDeleteIDs[] = $row['bookingID'];
            }
            return $allDeleteIDs;
        }
        
        # getSql method used to return the appropriate SQL query based on the type of data wanted to be deleted
        private function getSql($type, $bookingID){
            switch ($type){
                case "facility":
                    $sql = "DELETE FROM booking_facility WHERE bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "equipment":
                    $sql = "DELETE FROM booking_equipment WHERE bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "user":
                    $sql = "DELETE FROM booking_user WHERE bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "house":
                    $sql = "DELETE FROM booking_house WHERE bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "yearGroup":
                    $sql = "DELETE FROM booking_yearGroup WHERE bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "booking":
                    $sql = "DELETE FROM booking WHERE bookingID = $bookingID";
                    return $sql;
                    break;
            }
        }
        
        # Used as part if the deleteSelected and clearAll methods below and is for deleting one record at a time by calling the getSql method above
        private function deleteRow($type, $bookingID){
            $sql = $this->getSql($type, $bookingID);
            $result = $this->connect()->query($sql);
            if (!($result)){
                echo "Failed to deleted " . $type . " details";
            }
        }
        
        # Used after all booking data has been deleted to reset the primary key/ID counter back to 1, or the most recent value
        private function resetID(){
            $sql = "ALTER TABLE booking AUTO_INCREMENT = 1";
            $result = $this->connect()->query($sql);
        }
        
        # deleteSelected method is accessed directly from the webpage, only used when the user has selected bookings to delete
        public function deleteSelected(){
            foreach ($this->specificIDs as $deleteID){
                $this->deleteRow(facility, $deleteID);
                $this->deleteRow(equipment, $deleteID);
                $this->deleteRow(user, $deleteID);
                $this->deleteRow(house, $deleteID);
                $this->deleteRow(yearGroup, $deleteID);
                $this->deleteRow(booking, $deleteID);
            }
            $this->resetID();
        }
        
        # clearAll method accessed from the webpage used when the user chosses to delete all bookings
        public function clearAll(){
            $allDeleteIDs = $this->getAllDeleteIDs();
            foreach($allDeleteIDs as $deleteID){
                $this->deleteRow(facility, $deleteID);
                $this->deleteRow(equipment, $deleteID);
                $this->deleteRow(user, $deleteID);
                $this->deleteRow(house, $deleteID);
                $this->deleteRow(yearGroup, $deleteID);
                $this->deleteRow(booking, $deleteID);
            }
            $this->resetID();
        }
    }
?>

