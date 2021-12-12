<?php
    # ViewUserType class extends from the EditUserType class and this displays all the user types in the table
    class ViewUserType extends EditUserType{
        private $viewType; # viewAll or viewSelected;
        private $specificUserTypes; # The values must be in an array;
        
        # Constructor takes the view type and assigns it to the object property above
        # Constructor takes the specific user type's IDs if a select number are wanted to be displayed - These IDs are assigned to the object property above
        public function __construct($viewType, $specificUserTypes = null){
            $this->viewType = $viewType;
            
            if (isset($specificUserTypes)){
                $this->specificUserTypes = $specificUserTypes;
            }
        }
        
        # Main method accessed from the webpage, and displays all the user type details in a table format
        public function showUserTypes($withDelete = null, $withClear = null){
            # If all types are selected, all the IDs are retrieved via the getAllUserTypess method
            # If specific types are selected, those selected IDs are retrieved via the getSpecificUserTypess method
            if ($this->viewType == "viewAll"){
                $userTypes = $this->getAllUserTypes();
            }elseif($this->viewType == "viewSelected"){
                $userTypes = $this->getSpecificUserTypes($this->specificUserTypes);
            }
            
            # Only show the table and details if there are already existing user types
            if (!(empty($userTypes))){
                # If withClear and withDelete parameters are set, add an additional column to the table and a delete/clear form
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_userTypes.view.php' method='post' onclick="return confirm('Are you sure you want to delete all user types?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_userTypes.view.php' onsubmit="return confirm('Are you sure you want to delete these user types?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo"</tr>";
                # Foreach loop through all the user types
                foreach ($userTypes as $userType){
                    $userTypeID = $userType['userTypeID'];
                    $typeName = $userType['typeName'];
                    echo "<tr>";
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$userTypeID'> </td>";
                    }
                    echo "<td>" . $userTypeID . "</td>";
                    echo "<td>" . $typeName . "</td>";
                    echo"</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the user type table is empty, display an empty table
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No User Types </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo"</tr>";
                echo "</table>";
            }
        }
    }
?>
