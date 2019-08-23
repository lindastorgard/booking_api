<?php
  class Customer {
    
    //Database
    private $conn;
    private $table = 'Booking';

    //Post Properties
    public $id;
    public $customer_id;
    public $guest_qty;
    public $date;
  }