<?php
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'booking';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    //DB Connect
    public function connect() {
      $this->conn = null;
      
      try {

        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
        $this->username, $this->password);
        //get exceptions when we make queries
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      } catch(PDOException $error) {
        //if error
        echo 'Connection Error: ' . $error->getMessage();

      }
      return $this->conn;
    }
  }


