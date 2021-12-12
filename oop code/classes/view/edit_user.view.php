<?php # ViewUser class extends from EditUser class and displays all the user information from the database on the webpage
    class ViewUser extends EditUser{
        private $viewType; # viewAll or viewSelected;
        private $specificUser; # The wanted values must be in a list/array;
        # Constructor determines whether the object will have to display all or only select number of users
        public function __construct($viewType, $specificUser = null){
            $this->viewType = $viewType;
            if (isset($specificUser)){
                $this->specificUser = $specificUser;
            }
        }
        # Main method accessed from the webpage and is responsible for displaying all the information in a table form
        public function showUsers($withDelete = null, $withClear = null){
            if ($this->viewType == "viewAll"){
                $users = $this->getAllUsers();
            }elseif($this->viewType == "viewSelected"){
                $users = $this->getSpecificUsers($this->specificUser);
            }
            # Display the table if the users table has existing records
            if (!(empty($users))){
                # If the withClear and withDelete paramters are set, an additional column and button is added for an additional form to select and delete users
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_users.view.php' method='post' onclick="return confirm('Are you sure you want to delete all users?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form> <br>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_users.view.php' onsubmit="return confirm('Are you sure you want to delete these users?')">
                <?php
                }
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID/Email </th>";
                echo "<th> Name </th>";
                echo "<th> House </th>";
                echo "<th> Type </th>";
                echo "</tr>";
                # Foreach loop through all the users to display a separate row in the table
                foreach ($users as $user){
                    $userID = $user['userID'];
                    $userName = $user['userName'];
                    $userHouse = $this->getUserHouse($userID);
                    $userType = $this->getUserType($userID);
                    echo "<tr>";
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$userID'> </td>";
                    }
                    echo "<td>" . $userID . "</td>";
                    echo "<td>" . $userName . "</td>";
                    echo "<td>" . $userHouse['houseName'] . "</td>";
                    echo "<td>" . $userType . "</td>";
                    echo "</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                echo "</table>";
            # If the user table is empty, then display an empty table
            }else{
                echo "<h1 style='font-size:100px; text-align:center'> No Users </h1>";
                echo "<Table align='center' style='width:75%'>";
                echo "<tr>";
                echo "<th> ID/Email </th>";
                echo "<th> Name </th>";
                echo "<th> House </th>";
                echo "<th> Type </th>";
                echo "</tr>";
                echo "</table>";
            }
        }
    }
?>
