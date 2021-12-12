<?php
    # ViewEquipment class extends from the EditEquipment class to access its methods in order to display the equipment on the webpage
    class ViewEquipment extends EditEquipment{
        private $viewType; # viewAll or viewSelected;
        private $specificEquipment; # The values must be in a list/array
        
        # Constructor takes the viewType and specificEquipment if needed, then assigns them to the object properties
        public function __construct($viewType, $specificEquipment = null){
            $this->viewType = $viewType;
            if (isset($specificEquipment)){
                $this->specificEquipment = $specificEquipment;
            }
        }
        
        # Main method that is accessed from the webpage
        # withDelete and withClear parameters can be set to add the additional form to allow the user to delete equipment where necessary
        public function showEquipment($withDelete = null, $withClear = null){
            if ($this->viewType == "viewAll"){
                $equipment = $this->getAllEquipment();
            }elseif($this->viewType == "viewSelected"){
                $equipment = $this->getSpecificEquipment($this->specificEquipment);
            }
            # If there are equipment already existing in its table, display the values
            if (!(empty($equipment))){
                # If the withDelete and withClear parameters are set, display the Clear/Delete button plus the checkboxes for the user to select
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_equipment.view.php' method='post' onclick="return confirm('Are you sure you want to delete all equipment?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_equipment.view.php' onsubmit="return confirm('Are you sure you want to delete these equipment?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Storage </th>";
                echo "<th> Number Available </th>";
                echo"</tr>";
                # Foreach loop through all the equipment in the table
                foreach ($equipment as $equipment){
                    $equipmentID = $equipment['equipmentID'];
                    $equipmentName = $equipment['equipmentName'];
                    $storageName = $this->getEquipmentStorage($equipmentID);
                    $numAvailable = $equipment['numAvailable'];
                    echo "<tr>";
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$equipmentID'> </td>";
                    }
                    echo "<td>" . $equipmentID . "</td>";
                    echo "<td>" . $equipmentName . "</td>";
                    echo "<td>" . $storageName . "</td>";
                    echo "<td>" . $numAvailable . "</td>";
                    echo"</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the equipment table is empty, display a blank table to inform the user
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Equipment </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Storage </th>";
                echo "<th> Number Available </th>";
                echo"</tr>";
                echo "</table>";
            }
        }
    }
?>
