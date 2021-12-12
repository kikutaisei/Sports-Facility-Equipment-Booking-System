<?php # ViewYearGroup class connects to the database and the EditYearGroup to display the year groups
    class ViewYearGroup extends EditYearGroup{
        private $viewType; # viewAll or viewSelected;
        private $specificYearGroups; # The values must be in an array;
        
        # Constructor determines whether the object will display all or a select number of year groups
        public function __construct($viewType, $specificYearGroups = null){
            $this->viewType = $viewType;
            if (isset($specificYearGroups)){
                $this->specificYearGroups = $specificYearGroups;
            }
        }
        
        # showYearGroups is the main method accessed from the webpage and is responsible for displaying the data in the yearGroup table
        public function showYearGroups(){
            # If all users are needed, the getAllYearGroups method is run, but otherwise the getSpecificYearGroups method is run to get the records
            if ($this->viewType == "viewAll"){
                $yearGroups = $this->getAllYearGroups();
            }elseif($this->viewType == "viewSelected"){
                $yearGroups = $this->getSpecificYearGroups($this->$specificYearGroups);
            }
            # Display the table if there are records already existing in the table
            if (!(empty($yearGroups))){
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Number of Students </th>";
                echo"</tr>";
                # Foreach loop through all the year group records
                foreach ($yearGroups as $yearGroup){
                    $groupID = $yearGroup['groupID'];
                    $groupName = $yearGroup['groupName'];
                    $numStudent = $yearGroup['numStudent'];
                    echo "<tr>";
                    echo "<td>" . $groupID . "</td>";
                    echo "<td>" . $groupName . "</td>";
                    echo "<td>" . $numStudent . "</td>";
                    echo"</tr>";
                }
                echo "</table>";
            # If the yearGroup table has no records and is empty, display an empty table
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Year Groups </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Number of Students </th>";
                echo"</tr>";
                echo "</table>";
            }
        }
    }
?>
