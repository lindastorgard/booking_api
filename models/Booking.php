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
      // $query = ('SELECT * from ' . $this->table);
      $query = ('SELECT * FROM Booking LEFT JOIN Customer ON Booking.customer_id = Customer.id');
      
        // $query = 
        // 'SELECT 
        //   b.id,
        //   b.customer_id,
        //   b.guest_nr,
        //   b.date
        //   FROM
        //   ' .$this->table.' b
        //   LEFT JOIN
        //   Customers c ON b.customer_id = c.id
        //   ';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Execute statement
      $stmt->execute();

      return $stmt;
    }
  }