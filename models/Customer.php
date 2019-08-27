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

    //Create customer

    public function createCustomer() {
      //Create query
      $query = 'INSERT INTO ' .
          $this->table . '
        SET
          name = :name,
          lastname = :lastname,
          email = :email,
          phone = :phone';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      //Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->lastname = htmlspecialchars(strip_tags($this->lastname));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->phone = htmlspecialchars(strip_tags($this->phone));

      // Bind data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':lastname', $this->lastname);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':phone', $this->phone);

      //Execute query
      if($stmt->execute()) {
        $last_id = $this->conn->lastInsertId();
        return $last_id;
      }

      // Print error if something goes wrong
      printf('Error: %s.\n', $stmt->error);
      return false;
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

    //feature/read_single_customer
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

    //Update Customers
    public function updateCustomer(){
      // Create query
      $query =
      'UPDATE 
        Customer 
      SET 
        name = :name, 
        lastname = :lastname, 
        email = :email,
        phone = :phone;
      WHERE
        id = :id';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->lastname = htmlspecialchars(strip_tags($this->lastname));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->phone = htmlspecialchars(strip_tags($this->phone));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':lastname', $this->lastname);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':phone', $this->phone);
      $stmt->bindParam(':id', $this->id);

      //Execute statement
      if($stmt->execute()){
        return true;
      }
      // Print error if something goes wrong
      printf('Error: %s.\n', $stmt->error);

      return false;
    }

    // Delete customer
    public function deleteCustomer(){
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

