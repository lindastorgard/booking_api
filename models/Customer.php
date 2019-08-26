<?php
  class Customer {
     
    //Database connection & table name
    private $conn;
    private $table = 'Customer';

    //Booking Properties
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $phone;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //Get Customers
    public function readCustomers() {
      // Create query
      $query = (
        'SELECT * FROM Customer'
      );
      
      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Execute statement
      $stmt->execute();

      return $stmt;
    }


    // Delete customer
    public function delete(){
      // Create query
      $query = 
      'DELETE FROM 
        Customer 
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