<?php # ViewHouse class connects to the database and EditHouse class to retrieve and display all the data from the house table
    class ViewHouse extends EditHouse{
        private $viewType; # viewAll or viewSelected;
        private $specificHouse; # The wanted values must be in a list/array;
        
        # Constructor determines whether or not the new object will have to display all or a select number of houses
        public function __construct($viewType, $specificHouse = null){
            $this->viewType = $viewType;
            if (isset($specificHouse)){
                $this->specificHouse = $specificHouse;
            }
        }
        
        # Main method accessed from the webpgae and this displays the house data in a tble form
        public function showHouses($withDelete = null, $withClear = null){
            # If all houses are selected, the getAllHouses method is run to retrieve all the houses IDs, but otherwise the getSpecificHouses method is run
            if ($this->viewType == "viewAll"){
                $houses = $this->getAllHouses();
            }elseif($this->viewType == "viewSelected"){
                $houses = $this->getSpecificHouses($this->specificHouse);
            }
            # Display table if house table has records
            if (!(empty($houses))){
                # If the withClear and withDelete parameters are set, an additional form and button with checkboxes are added to the page to allow the user to delete houses
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_houses.view.php' method='post' onclick="return confirm('Are you sure you want to delete all houses?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_houses.view.php' onsubmit="return confirm('Are you sure you want to delete these equipment?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Number of Students </th>";
                echo "<th> Number of Users </th>";
                echo "</tr>";
                foreach ($houses as $house){
                    $houseID = $house['houseID'];
                    $houseName = $house['houseName'];
                    $numStudents = $house['numStudent'];
                    $numUsers = $house['numUser'];
                    echo "<tr>";
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$houseID'> </td>";
                    }
                    echo "<td>" . $houseID . "</td>";
                    echo "<td>" . $houseName . "</td>";
                    echo "<td>" . $numStudents . "</td>";
                    echo "<td>" . $numUsers . "</td>";
                    echo "</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the house tabel is empty, then an empty table is displayed
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Houses </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Name </th>";
                echo "<th> Number of Students </th>";
                echo "<th> Number of Users </th>";
                echo"</tr>";
                echo "</table>";
            }
        }
    }
?>
