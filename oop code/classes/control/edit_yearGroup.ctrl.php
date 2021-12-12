<?php # EditYearGroup class connects to the database via the Db class to retrieve all year group information and make changes
    class EditYearGroup extends Db{
        # getAllYearGroups method gets all the fields of all the records in the yearGroup table and returns an associative array
        public function getAllYearGroups(){
            $sql = "SELECT * FROM yearGroup";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $yearGroups[] = $row;
            }
            return $yearGroups;
        }
        # getSpecificYearGroups method gets all the fields of only select number of records in the yearGroup table and returns an associative array
        protected function getSpecificYearGroups($specificIDs){
            foreach ($specificIDs as $specificID){
                $sql = "SELECT * FROM yearGroup WHERE groupID = $specificID";
                $result = $this->connect()->query($sql);
                while ($row = $result->fetch_assoc()){
                    $yearGroups[] = $row;
                }
            }
            return $yearGroups;
        }
        # changeNumStudent method updates the yearGroup table specified by the parameter
        public function changeNumStudent($groupID, $numStudent){
            $sql = "UPDATE yearGroup
                    SET numStudent = $numStudent
                    WHERE groupID = $groupID";
            $result = $this->connect()->query($sql);
            if ($result){
                echo "<b> Year Group: " . $groupID . " number of students has successfully been changed </b><br>";
            }else{
                echo "<b> Failed to change number of students </b><br>";
            }
        }
    }
?>
