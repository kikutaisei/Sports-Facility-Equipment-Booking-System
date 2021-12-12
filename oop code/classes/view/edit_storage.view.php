<?php
    # ViewStorage class extends from the EditStorage class to access its methods in order to display the storages on the webpage
    class ViewStorage extends EditStorage{
        private $viewType; # viewAll or viewSelected
        private $specificStorages; # The wanted values must be in a array;
        
        # Constructor takes the viewType and specificStorages if needed, then assigns them to the object properties
        public function __construct($viewType, $specificStorages = null){
            $this->viewType = $viewType;
            if (isset($specificStorages)){
                $this->specificStorages = $specificStorages;
            }
        }
        
        # Main method that is accessed from the webpage
        # withDelete and withClear parameters can be set to add the additional form to allow the user to delete storages where necessary
        public function showStorages($withDelete = null, $withClear = null){
            if ($this->viewType == "viewAll"){
                $storages = $this->getAllStorages();
            }elseif($this->viewType == "viewSelected"){
                $storages = $this->getSpecificStorages($this->specificStorages);
            }
            # If there are storages existing in the storage table, display the values
            if (!(empty($storages))){
                # If the withDelete and withClear parameters are set, display the Clear/Delete button plus the checkboxes for the user to select
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_storages.view.php' method='post' onclick="return confirm('Are you sure you want to delete all storages?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_storages.view.php' onsubmit="return confirm('Are you sure you want to delete these storages?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Facility </th>";
                echo"</tr>";
                # Foreach loop through all the facilities in the facility table
                foreach ($storages as $storage){
                    $storageID = $storage['storageID'];
                    $storageName = $storage['storageName'];
                    $facilityName = $this->getStorageFacility($storageID);
                    echo "<tr>";
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$storageID'> </td>";
                    }
                    
                    echo "<td>" . $storageID . "</td>";
                    echo "<td>" . $storageName . "</td>";
                    echo "<td>" . $facilityName . "</td>";
                    echo "</tr>";
                }
                    
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the storage table is empty, display a blank table to inform the user
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Storages </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Facility </th>";
                echo"</tr>";
                echo "</table>";
            }
        }
    }
?>
