<?php
  class Config {

    //Database connection & table name
    private $conn;
    private $table = 'Config';

    //Config Properties
    public $setting;
    public $value;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //Get Config
    public function readConfig() {
      // Create query
      $query = (
        'SELECT * FROM Config'
      );

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Execute statement
      $stmt->execute();

      return $stmt;
    }
  }

