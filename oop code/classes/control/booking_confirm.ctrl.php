
<?php
    # ConfirmBooking class takes the data selected from the 'add_booking' form/page and processes it to ensure there are no overlaps or issues with the booking table
    class ConfirmBooking extends Db{
        public $validName;
        public $overlap;
        public $timeOrder;
        public $overlapID = [];
        public $overlapFacility;
        public $overlapEquipment;
        public $overlapUser;
        
        # Method that takes the name from the form as the parameter and validates it so there are no numbers or inappropritate characters in the name
        public function checkName($name){
            If (preg_match("/^([a-zA-Z' ]+)$/", $name)) {
                echo "The name: <b>" . $name . "</b> is valid and will be recorded <br>";
                $this->validName = True;
            }else{
                echo "<b style='color:red'> The name: " . $name . " is not valid so please go back and re-write your name </b><br>";
                $this->validName = False;
            }
        }
        
        # Method which takes the start and end time from the form as parameters and checks uf there are any overlapping events
        public function checkOverlap($startTime, $endTime){
            $sql = "SELECT * FROM booking
                WHERE(
                (startTime >= '$startTime' AND endTime >= '$endTime' AND NOT startTime >= '$endTime' AND NOT endTime <= '$startTime')
                OR
                (startTime <= '$startTime' AND endTime <= '$endTime' AND NOT startTime >= '$endTime' AND NOT endTime <= '$startTime')
                OR
                (startTime <= '$startTime' AND endTime >= '$endTime' AND NOT startTime >= '$endTime' AND NOT endTime <= '$startTime')
                OR
                (startTime >= '$startTime' AND endTime <= '$endTime' AND NOT startTime >= '$endTime' AND NOT endTime <= '$startTime')
                )";
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                echo "<b style='Color:red'> There is an event(s) that overlap (This is fine as long as no facilities/equipment/users are also overlapping): </b><br>";
                # If there are overlapping events (based on the SQL query), the overlap property is set to true
                $this->overlap = True;

                echo "<Table align='center'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Booked By </th>";
                echo "<th> Booking Made </th>";
                echo "<th> Event Name </th>";
                echo "<th> Start Time </th>";
                echo "<th> End Time </th>";
                echo "</tr>";
                
                while ($row = mysqli_fetch_assoc($result)){
                    # Every overlapping booking is pushed onto the overlapID array property in this class
                    array_push($this->overlapID, $row['bookingID']);
                    echo "<tr>";
                    
                    echo "<td>";
                    echo $row['bookingID'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $row['bookingMadeBy'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $row['bookingMadeDate'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $row['eventName'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $row['startTime'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $row['endTime'];
                    echo "</td>";
                    
                    echo "</tr>";
                }
                echo "</table>";
            }else{
                # If there are no overlapping events, the overlap property is set to false
                $this->overlap = False;
            }
        }
        
        # Method which takes the start and end times from the form as parameters and validates them so the start time starts before the end time
        public function checkTimeOrder($startTime, $endTime){
            if ($startTime > $endTime) {
                echo "<b style = 'color:red'> Your start time, $startTime is later than your end time, $endTime so please go back and re-write your times.</b>";
                $this->timeOrder = False;
            }else{
                $this->timeOrder = True;
            }
        }
        
        # Method which informs the user whether or not the optional event name has been filled in or not
        public function checkEventName($eventName){
            if(empty($eventName)){
                echo "The event name will be recorded as: <b> PE Lesson </b>";
            }else{
                echo "The event name will be recorded as: <b>" . $eventName . "</b>";
            }
        }
        
        # Method which selects the correct SQL command according to the value that is wanted
        private function getNameSql($type, $typeID){
            switch ($type){
                case "facilityName":
                    $sql = "SELECT facilityName FROM facility WHERE facilityID = $typeID";
                    return $sql;
                    break;
                
                case "equipmentName":
                    $sql = "SELECT equipmentName FROM equipment WHERE equipmentID = $typeID";
                    return $sql;
                    break;
                    
                case "userName":
                    $sql = "SELECT userName FROM user WHERE userID = '$typeID'";
                    return $sql;
                    break;
                
                case "houseName":
                    $sql = "SELECT houseName FROM house WHERE houseID = $typeID";
                    return $sql;
                    break;
                    
                case "groupName":
                    $sql = "SELECT groupName FROM yearGroup WHERE groupID = $typeID";
                    return $sql;
                    break;
            }
        }
        
        # This method calls the getNameSql method above and uses the return value to retrieve and output the values from the database table
        public function showName($type, $typeID){
            $sql = $this->getNameSql($type, $typeID);
            $result = $this->connect()->query($sql);
            $row = $result->fetch_assoc();
            $name = $row[$type];
            echo "<i>" . $name . "</i><br>";
        }
        
        # Method which takes the overlapping IDs and each of the chosen facility's IDs as parameters and checks whether or not any other facilities are overlapping
        public function checkFacilityOverlap($overlapID, $facilityID){
            $sql = "SELECT booking_facility.facilityID, facility.facilityName, booking_facility.bookingID
                    FROM facility, booking_facility
                    WHERE booking_facility.bookingID = $overlapID AND booking_facility.facilityID = facility.facilityID AND facility.facilityID = $facilityID";
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                $this->overlapFacility = True;
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $overlapID . "</td>";
                    echo "<td>" . $row['facilityName'] . "</td>";
                    echo "</tr>";
                }
            }
        }
        
        # Method which takes the overlapping IDs and each of the chosen equipment's IDs as parameters and checks whether or not any other equipments are overlapping
        public function checkEquipmentOverlap($overlapID, $equipmentID){
            $sql = "SELECT booking_equipment.equipmentID, equipment.equipmentName, booking_equipment.bookingID
                    FROM equipment, booking_equipment
                    WHERE booking_equipment.bookingID = $overlapID AND booking_equipment.equipmentID = equipment.equipmentID AND equipment.equipmentID = $equipmentID";
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                $this->overlapEquipment = True;
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $overlapID . "</td>";
                    echo "<td>" . $row['equipmentName'] . "</td>";
                    echo "</tr>";
                }
            }
        }
        
        # Method which takes the overlapping IDs and each of the chosen user's IDs as parameters and checks whether or not any other users are overlapping
        public function checkUserOverlap($overlapID, $userID){
            $sql = "SELECT booking_user.userID, user.userName, booking_user.bookingID
                    FROM user, booking_user
                    WHERE booking_user.bookingID = $overlapID AND booking_user.userID = user.userID AND user.userID = '$userID'";
            $result = $this->connect()->query($sql);
            $numRows = $result->num_rows;
            if ($numRows > 0){
                $this->overlapUser = True;
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $overlapID . "</td>";
                    echo "<td>" . $row['userName'] . "</td>";
                    echo "</tr>";
                }
            }
        }
        
        # This method is used for the final 'Book' button on the confirmation page
        # If any facility/equipment/user are overlapping, the method will return false so the button is blocked
        public function allowAdd(){
            if (($this->validName == True) AND ($this->timeOrder == True) AND ($this->overlapFacility == 0) AND ($this->overlapEquipment == 0) AND ($this->overlapUser == 0)){
                return True;
            }else{
                return False;
            }
        }
    }
?>
