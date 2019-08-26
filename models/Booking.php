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
      $query = (
        'SELECT * FROM Booking LEFT JOIN Customer ON Booking.customer_id = Customer.id');
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Execute statement
      $stmt->execute();

      return $stmt;
    }

    //GET Single Booking
    public function read_single_booking(){
      $query = (
        'SELECT * FROM Booking JOIN Customers ON Booking.customer_id = Customer.id WHERE Booking.id = ?'
      );

    //Prepare statement
      $stmt = $this->conn->prepare($query);

    //BIND ID
      $stmt->bindParam(1, $this->id);

    //Execute statement
      $stmt->execute();

    //fetch an associative array
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //Set properties
      $this->customer_id = $row['customer_id'];
      $this->guest_nr = $row['guest_nr'];
      $this->date = $row['date'];    
      }
  }