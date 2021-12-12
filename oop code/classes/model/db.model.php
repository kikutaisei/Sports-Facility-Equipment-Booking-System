<?php # Db class extends to all other classes to enable database connection
    class Db {
        private $servername = "localhost";
        private $username = "root";
        private $password = "root";
        private $dbname = "bookFacility";
        
        protected function connect(){
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
                #echo "Successfully Connected!";
                return $conn;
            }
        }
    }
?>
