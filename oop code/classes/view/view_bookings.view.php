<?php
    
    # ViewBooking class extends from the GetBooking class used to display the booking's details onto the webpage
    # This class will be directly accessed from the webpage
    class ViewBooking extends GetBooking{
        # viewType can either be viewAll or viewSelected and tells the class whether or not all or one/some of the bookings will be displayed
        private $viewType;
        # specificIDs must be in an array to allow the foreach loops to function properly
        private $specificIDs;
        
        # Constructor which determines whether or not the object will have to display all or one/some of the bookings
        # Assigned to the class properties
        public function __construct($viewType, $specificIDs = null){
            $this->viewType = $viewType;
            if (isset($specificIDs)){
                $this->specificIDs = $specificIDs;
            }
        }
        
        # Main method which is accessed from the webpage
        # The withDelete and withClear parameters are set to null as it is only used on the delete pages
        public function showBookings($order, $withDelete = null, $withClear = null){
            # Depending on the view type, the method will access the booking details from the GetBooking class
            if ($this->viewType == "viewAll"){
                $bookings = $this->getBookingsOrdered($order);
            }elseif($this->viewType == "viewSelected"){
                $bookings = $this->getSpecificBookingsOrdered($order, $this->specificIDs);
            }
            
            if (!(empty($bookings))){
                # Have clear and delete options/form only if the withDelete and withClear parameters are set
                if(isset($withClear)){ ?>
                    <form action='/classes/view/delete_bookings.view.php' method='post' onclick="return confirm('Are you sure you want to delete all bookings?')">
                    <input class='navButton' name='clear' type='submit' value='Clear'>
                    </form>
                <?php
                }
                if(isset($withDelete)){ ?>
                    <form method='post' action='/classes/view/delete_bookings.view.php' onsubmit="return confirm('Are you sure you want to delete these bookings?')">
                <?php
                }
                
                # Creating headers for the table
                echo "<Table align='center'>";
                echo "<tr>";
                # If the withDelete parameter is set, the delete/submit button is added in a new column
                if(isset($withDelete)){
                    echo "<th> <input type='submit' value='Delete?'> <input type='reset'> </th>";
                }
                echo "<th> ID </th>";
                echo "<th> Booked By </th>";
                echo "<th> Booking Made </th>";
                echo "<th> Event Name </th>";
                echo "<th> Start Time </th>";
                echo "<th> End Time </th>";
                echo "<th> Facility </th>";
                echo "<th> Equipment </th>";
                echo "<th> User </th>";
                echo "<th> House </th>";
                echo "<th> Year Group </th>";
                echo "</tr>";
                    
                foreach ($bookings as $booking){
                    # Assigning each of the fields' values to a new variable
                    $bookingID = $booking['bookingID'];
                    $name = $booking['bookingMadeBy'];
                    $dateMade = $booking['bookingMadeDate'];
                    $eventName = $booking['eventName'];
                    $startTime = $booking['startTime'];
                    $endTime = $booking['endTime'];
                    echo "<tr>";
                    
                    # If the withDelete parameter is set, a checkbox will be displayed for each row so the user can select bookings to delete
                    if (isset($withDelete)){
                        echo "<td> <input type='checkbox' name = 'deleteID[]' value= '$bookingID'> </td>";
                    }
                    
                    echo "<td>" . $bookingID . "</td>";
                    
                    echo "<td>" . $name . "</td>";
                    
                    echo "<td>" . $dateMade . "</td>";
                    
                    echo "<td>" . $eventName . "</td>";
                    
                    echo "<td>" . $startTime . "</td>";
                    
                    echo "<td>" . $endTime . "</td>";
                    
                    # For remaining columns, the showAllDetails method from the GetBooking class is called
                    echo "<td>";
                    $this->showAllDetails(facility, $bookingID);
                    "</td>";
                    
                    echo "<td>";
                    $this->showAllDetails(equipment, $bookingID);
                    "</td>";
                    
                    echo "<td>";
                    $this->showAllDetails(user, $bookingID);
                    "</td>";
                    
                    echo "<td>";
                    $this->showAllDetails(house, $bookingID);
                    "</td>";
                    
                    echo "<td>";
                    $this->showAllDetails(yearGroup, $bookingID);
                    "</td>";
                    
                    echo "</tr>";
                }
                if (isset($withDelete)){
                    echo "</form>";
                }
                    echo "</table>";
            }else{
                # If there are no bookings in the databse, an empty table is displayed to inform the user
                echo "<h1 style='font-size:100px; text-align:center'> No Bookings </h1>";
                echo "<Table align='center'>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Booked By </th>";
                echo "<th> Booking Made </th>";
                echo "<th> Event Name </th>";
                echo "<th> Main Users </th>";
                echo "<th> Facility </th>";
                echo "<th> Equipment </th>";
                echo "<th> Specific House </th>";
                echo "<th> Specific Year Group </th>";
                echo "<th> Start Time </th>";
                echo "<th> End Time </th>";
                echo "</tr>";
                echo "</table>";
            }
        }
        
    }
    
?>
