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

    public function readCustomer($id) {
        // Create query
        $query = (
        'SELECT * FROM Customer
        WHERE Customer.id = :id'
        );

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':id', $id);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }
  }
