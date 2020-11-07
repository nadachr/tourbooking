<?php
    class Database {
        private $db_host        = "localhost";
        private $db_username    = "root";
        private $db_password    = "";
        private $db_name        = "tourbooking";
      
        public function getConnection() {
            $this->connect = null;

            try {
                $this->connect = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
                echo "<script>console.log(\"Connected Successfully\")</script>";
            }
            catch (Exception $error_message) {
                echo "Connection failed: " .$error_message;
            }
            return $this->connect;
        }
    }
?>