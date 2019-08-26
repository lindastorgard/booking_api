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

    //Update Bookings
    public function update(){
      // Create query
      $query = 
      'UPDATE 
        Booking 
      SET 
        customer_id = :customer_id, 
        guest_nr = :guest_nr, 
        date = :date
      WHERE
        id = :id';
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
      $this->guest_nr = htmlspecialchars(strip_tags($this->guest_nr));
      $this->date = htmlspecialchars(strip_tags($this->date));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':customer_id', $this->customer_id);
      $stmt->bindParam(':guest_nr', $this->guest_nr);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':id', $this->id);

      //Execute statement
      if($stmt->execute()){
        return true;
      }
      
      // Print error if something goes wrong
      printf('Error: %s.\n', $stmt->error);

      return false;
    }

    // Delete booking
    public function delete(){
      // Create query
      $query = 
      'DELETE FROM 
        Booking 
      WHERE 
        id = :id';
    
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      //Execute statement
      if($stmt->execute()){
        return true;
      }
      
      // Print error if something goes wrong
      printf('Error: %s.\n', $stmt->error);

      return false;
    }
    
  }