<?php
    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "gamelibrary";
        private $conn;

        public function connectDB(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            } else {
                echo "Connected successfully!";
                return $this->conn;
            }
        }

        public function addData($gameTitle, $platform, $genre, $steamid, $descriptie, $image){
            $sql = "INSERT INTO games (title, platform, genre, steamid, descriptie, image) VALUES ('$gameTitle', '$platform', '$genre', '$steamid', '$descriptie', '$image')";

            if ($this->conn->query($sql) === TRUE) {
                // Redirect to the OwnedGameLibrary page
                // header("Location: OwnedGameLibrary.php");
                // exit();
                echo "Data send to database updated succesfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
        
    }

    

?>