<?php
    # ViewFacility class extends from the EditFacility class to access its methods in order to display the facilities on the webpage
    class ViewFacility extends EditFacility{
        # viewAll or viewSelected
        private $viewType;
        # The values must be in a array
        private $specificFacilities;
        
        # Constructor takes the viewType and specificFacilities if needed, then assigns them to the object properties
        public function __construct($viewType, $specificFacilities = null){
            $this->viewType = $viewType;
            if (isset($specificFacilities)){
                $this->specificFacilities = $specificFacilities;
            }
        }
        
        # Main method that is accessed from the webpage
        # withDelete and withClear parameters can be set to add the additional form to allow the user to delete facilities where necessary
        public function showFacilities($withDelete = null, $withClear = null){
            if ($this->viewType == "viewAll"){
                $facilities = $this->getAllFacilities();
            }elseif($this->viewType == "viewSelected"){
                $facilities = $this->getSpecificFacilities($this->specificFacilities);
            }
            # If there are facilities existing in the facility table, display the values
            if (!(empty($facilities))){
                # If the withDelete and withClear parameters are set, display the Clear/Delete button plus the checkboxes for the user to select
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_facilities.view.php' method='post' onclick="return confirm('Are you sure you want to delete all facilities?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_facilities.view.php' onsubmit="return confirm('Are you sure you want to delete these facilities?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Owner </th>";
                echo "</tr>";
                
                # Foreach loop through all the facilities in the facility table
                foreach ($facilities as $facility){
                    $facilityID = $facility['facilityID'];
                    $facilityName = $facility['facilityName'];
                    $ownerName = $this->getFacilityOwner($facilityID);
                    echo "<tr>";
                    
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$facilityID'> </td>";
                    }
                    
                    echo "<td>" . $facilityID . "</td>";
                    echo "<td>" . $facilityName . "</td>";
                    echo "<td>" . $ownerName . "</td>";
                    echo "</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the facility table is empty, display a blank table to inform the user
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Facilities </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Owner </th>";
                echo "</tr>";
                echo "</table>";
            }
        }
    }
?>
