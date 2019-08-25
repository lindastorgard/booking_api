<?php
  class Booking {
     
    //Database connection & table name
    private $conn;
    private $table = 'Booking';

    //Booking Properties
    public $id;
    public $customer_id;
    public $guest_nr;
    public $date;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //Get Bookings
    public function read() {
      // Create query 
      $query = ('SELECT * from ' . $this->table);
        // 'SELECT 
        //   id,
        //   customer_id,
        //   guest_nr,
        //   date
        //   FROM
        //   ' . $this->table .' 
          
        //   LEFT JOIN
        //   Customers ON customer_id = id
        //   ';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Execute statement
      $stmt->execute();

      return $stmt;
    }
  }