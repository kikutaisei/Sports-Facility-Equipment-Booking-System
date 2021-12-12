<?php
    class Calendar extends Db{
        
        # Get the previous and next months
        public function getYearMonth(){
            if (isset($_GET['ym'])) {
                $yearMonth = $_GET['ym'];
            } else {
                $yearMonth = date('Y-m'); # The current month
            }
            return $yearMonth;
        }
        
        # Check the time format
        public function checkTimeFormat($yearMonth){
            $timeFormat = strtotime($yearMonth . '-01');
            if ($timeFormat === false){
                $yearMonth = date('Y-m');
                $timeFormat = strtotime($yearMonth . '-01');
            }
            return $timeFormat;
        }
        
        # Return the values used to display the navigation bar and cuurent month
        public function getNavHeader($timeFormat){
            $navHeader = date('Y/M', $timeFormat);
            return $navHeader;
        }
        
        # Creates a link to access the previous month
        public function getPrevLink($timeFormat){
            $prevLink = date('Y-m', strtotime('-1 month', $timeFormat));
            return $prevLink;
        }
        
        # Creates a link to access the next month
        public function getNextLink($timeFormat){
            $nextLink = date('Y-m', strtotime('+1 month', $timeFormat));
            return $nextLink;
        }
        
        # Returns the number of days in a month
        private function getMonthNumDays($timeFormat){
            $monthNumDays = date('t', $timeFormat);
            return $monthNumDays;
        }
        
        # Assigns number from 0 to 6 for each day of the week, so Sunday = 0, Monday = 1, Tuesday = 2...
        private function getDayNum($timeFormat){
            $dayNum = date('w', $timeFormat);
            return $dayNum;
        }
        
        public function getBooking($date){
            $sql = "SELECT bookingID
                    FROM booking
                    WHERE startTime between '$date 00:00:00' AND '$date 23:59:59'";
            $result = $this->connect()->query($sql);
            while ($row = $result->fetch_assoc()){
                $bookingIDs[] = $row['bookingID'];
            }
            return $bookingIDs;
        }
        
        # Displays the calendar on the webpage
        public function showCalendar(){
            $yearMonth = $this->getYearMonth();
            $timeFormat = $this->checkTimeFormat($yearMonth);
            $monthNumDays = $this->getMonthNumDays($timeFormat);
            $dayNum = $this->getDayNum($timeFormat);
            
            $weeks = [];
            $week = '';
            
            $week .= str_repeat('<td></td>', $dayNum); # Creating a cell for days which are not in the current month (Blank cell)
            for ($day = 1; $day <= $monthNumDays; $day++, $dayNum++) {
                $date = $yearMonth . '-' . $day;
                
                # Calling the getBooking method above to check if there are any bookings for each day
                $bookingIDs = $this->getBooking($date);
                # numEvents is the number of records in the given day
                $numEvents = count($bookingIDs);
                
                # Creating a cell for a day only if that day/cell is part of the month
                # If there are records for this day, then that number will be displayed
                if ($numEvents > 0){
                    $week .= "<td><h3>" . $day . "</h3><br><b>" . $numEvents . " Events </b><br> <form method='post' action='calendar_events.php'><button name='eventDate' type='submit' value='$date'> View </button>";
                # If there are no records for this day, then it will display no events
                }else{
                    $week .= "<td><h3>" . $day . "</h3><br><b> No Events </b>";
                }
                
                $week .= "</td>";
                
                # Creating a cell for days which are not in the current month (Blank cell)
                if ($dayNum % 7 == 6 || $day == $monthNumDays) {
                    if ($day == $monthNumDays) {
                        # Empty cell
                        $week .= str_repeat('<td></td>', 6 - ($dayNum % 7));
                    }
                    $weeks[] = '<tr>' . $week . '</tr>';
                    $week = '';
                }
            }
            return $weeks;
        }
    }
?>
