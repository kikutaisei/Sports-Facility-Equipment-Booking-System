<?php
    # ViewOwner class extends from the EditOwner class to access its methods in order to display the owners on the webpage
    class ViewOwner extends EditOwner{
        # viewAll or viewSelected
        private $viewType;
        # The values must be in a array
        private $specificOwners;
        
        # Constructor takes the viewType and specificOwners if needed, then assigns them to the object properties
        public function __construct($viewType, $specificOwners = null){
            $this->viewType = $viewType;
            if (isset($specificOwners)){
                $this->specificOwners = $specificOwners;
            }
        }
        
        # Main method that is accessed from the webpage
        # withDelete and withClear parameters can be set to add the additional form to allow the user to delete owners where necessary
        public function showOwners($withDelete = null, $withClear = null){
            if ($this->viewType == "viewAll"){
                $owners = $this->getAllOwners();
            }elseif($this->viewType == "viewSelected"){
                $owners = $this->getSpecificOwners($this->specificOwners);
            }
            # If there are owners existing in the owner table, display the values
            if (!(empty($owners))){
                # If the withDelete and withClear parameters are set, display the Clear/Delete button plus the checkboxes for the user to select
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_owners.view.php' method='post' onclick="return confirm('Are you sure you want to delete all owners?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_owners.view.php' onsubmit="return confirm('Are you sure you want to delete these owners?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "</tr>";
                
                # Foreach loop through all the owners in the owner table
                foreach ($owners as $owner){
                    $ownerID = $owner['ownerID'];
                    $ownerName = $owner['ownerName'];
                    echo "<tr>";
                    
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$ownerID'> </td>";
                    }
                    
                    echo "<td>" . $ownerID . "</td>";
                    echo "<td>" . $ownerName . "</td>";
                    echo "</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the owner table is empty, display a blank table to inform the user
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Owners </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "</tr>";
                echo "</table>";
            }
        }
    }
?>
