<?php
    # The GetBooking class is used alongside the ViewBooking class to select the relevant information from the database to be displayed through the page
    class GetBooking extends Db{
        
        # This method selects all the values from the booking table and returns all values as an associative array
        # The order parameter is either ASC or DESC and is used within the SQL query
        protected function getBookingsOrdered($order){
            $sql = "SELECT * FROM booking
                    ORDER BY bookingID $order";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $bookingDetails[] = $row;
            }
            return $bookingDetails;
        }
        
        # This method selects all the values from the booking table for only given bookings and returns all values as an associative array
        # The specificIDs parameter must be in an array to allow the foreach loop to function properly
        # The order parameter is either ASC or DESC and is used within the SQL query
        protected function getSpecificBookingsOrdered($order, $specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM booking
                        WHERE bookingID = $specificID
                        ORDER BY bookingID $order";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $bookingDetails[] = $row;
                }
            }
            return $bookingDetails;
        }
        
        # getSql method selects the appropriate SQL query based on the type of data wanted to be displayed
        private function getSql($type, $bookingID){
            switch ($type){
                case "facility":
                    $sql = "SELECT facility.facilityName
                            FROM booking, booking_facility, facility
                            WHERE booking.bookingID = booking_facility.bookingID AND facility.facilityID = booking_facility.facilityID AND booking.bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "equipment":
                    $sql = "SELECT equipment.equipmentName, equipment.numAvailable, storage.storageName
                            FROM booking, booking_equipment, equipment, storage
                            WHERE booking.bookingID = booking_equipment.bookingID AND equipment.equipmentID = booking_equipment.equipmentID AND equipment.storageID=storage.storageID AND booking.bookingID = $bookingID";
                    return $sql;
                    break;
                    
                case "user":
                    $sql = "SELECT user.userName
                            FROM booking, booking_user, user
                            WHERE booking.bookingID = booking_user.bookingID AND user.userID = booking_user.userID AND booking.bookingID = $bookingID";
                    return $sql;
                    break;
                
                case "house":
                    $sql = "SELECT house.houseName
                            FROM booking, booking_house, house
                            WHERE booking.bookingID = booking_house.bookingID AND house.houseID = booking_house.houseID AND booking.bookingID = $bookingID";
                    return $sql;
                    break;
                
                case "yearGroup":
                    $sql = "SELECT yearGroup.groupName
                        FROM booking, booking_yearGroup, yearGroup
                        WHERE booking.bookingID = booking_yearGroup.bookingID AND yearGroup.groupID = booking_yearGroup.groupID AND booking.bookingID = $bookingID";
                    return $sql;
                    break;
            }
        }
        
        # getAllDetails method selects the SQL query via the getSql method above and returns all the values as an associative array if there are any
        protected function getAllDetails($type, $bookingID){
            $sql = $this->getSql($type, $bookingID);
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                while($row = $result->fetch_assoc()){
                    $details[] = $row;
                }
                return $details;
            }else{
                echo "None Chosen";
            }
        }
        
        # showAllDetails method uses all the above methods to display the values from the database onto the webpage
        public function showAllDetails($type, $bookingID){
            $details = $this->getAllDetails($type, $bookingID);
            switch ($type){
                case "facility":
                    foreach ($details as $detail){
                        echo $detail['facilityName'] . "<br>";
                    }
                    break;
                    
                case "equipment":
                    foreach ($details as $detail){
                        echo $detail['equipmentName'] . " (" . $detail['numAvailable'] . " Available): " . $detail['storageName'] . "<br>";
                    }
                    break;
                    
                case "user":
                    foreach ($details as $detail){
                        echo $detail['userName'] . "<br>";
                    }
                    break;
                    
                case "house":
                    foreach ($details as $detail){
                        echo $detail['houseName'] . "<br>";
                    }
                    break;
                    
                case "yearGroup":
                    foreach ($details as $detail){
                        echo $detail['groupName'] . "<br>";
                    }
                    break;
            }
        }
    }
?>
