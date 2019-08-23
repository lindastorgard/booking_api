<?php
  class Database {
    // DB Params
    private $host = 'localhost:8889';
    private $db_name = 'booking';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    //DB Connect
    public function connect() {
      $this->conn = null;
      
      try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->db_name,
        $this->username, $this->password);
        //get exceptions when we make queries
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRORMODE_EXCEPTION);
        
      } catch(PDOException $e) {
        //if error
        echo 'Connection Error: ' .$e->getMessage();

      }
      return $this->conn;
    }
  }