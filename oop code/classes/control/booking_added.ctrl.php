
<?php
    class BookingAdded extends Db {
        # The following methods are used on the final page of the booking process:
        # This method is used to add the initial/required details about the booking to add into the main booking table
        # This is used specifically for when the user has filled in the eventName field
        public function bookingWithEvent($name, $eventName, $startTime, $endTime){
            $sql = "INSERT INTO booking(bookingMadeBy, eventName, startTime, endTime)
                    VALUES('$name', '$eventName', '$startTime', '$endTime')";
            $result = $this->connect()->query($sql);
            if ($result){
                return True;
            }else{
                return False;
            }
        }
        
        # This method is used to add the initial/required details about the booking to add into the main booking table
        # This is used specifically for when the user has not filled in the eventName field
        public function bookingWithoutEvent($name, $startTime, $endTime){
            $sql = "INSERT INTO booking(bookingMadeBy, startTime, endTime)
                    VALUES('$name', '$startTime', '$endTime')";
            $result = $this->connect()->query($sql);
            if ($result){
                return True;
            }else{
                return False;
            }
        }
        
        # This method is used once the initial details have been successfully added
        # Retrieves the newly added booking's ID so it can be used to add the additional information such as facility, equipment, users, etc. into the other tables
        public function getNewBookingID(){
            $sql = "SELECT bookingID FROM booking ORDER BY bookingID DESC";
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            $newBookingID = $row['bookingID'];
            return $newBookingID;
        }
        
        # The getAddSql Method selects the correct SQL command based on what data needs to be added to the tables
        private function getSql($type, $bookingID, $typeID){
            switch ($type){
                case "facility":
                    $sql = "INSERT INTO booking_facility(bookingID, facilityID)
                            VALUES($bookingID, $typeID)";
                    return $sql;
                    break;
                    
                case "equipment":
                    $sql = "INSERT INTO booking_equipment(bookingID, equipmentID)
                            VALUES($bookingID, $typeID)";
                    return $sql;
                    break;
                    
                case "user":
                    $sql = "INSERT INTO booking_user(bookingID, userID)
                            VALUES($bookingID, '$typeID')";
                    return $sql;
                    break;
                    
                case "house":
                    $sql = "INSERT INTO booking_house(bookingID, houseID)
                            VALUES($bookingID, $typeID)";
                    return $sql;
                    break;
                    
                case "yearGroup":
                    $sql = "INSERT INTO booking_yearGroup(bookingID, groupID)
                            VALUES($bookingID, $typeID)";
                    return $sql;
                    break;
            }
        }
        
        # addBooking method is used to add all the remaining parts to the other tables
        public function addBooking($type, $bookingID, $typeID){
            foreach ($typeID as $typeID){
                $sql = $this->getSql($type, $bookingID, $typeID);
                $result = $this->connect()->query($sql);
            }
        }
    }
?>
