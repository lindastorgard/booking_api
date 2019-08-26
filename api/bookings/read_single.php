<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: application/json; ; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog bookings object

$booking = new Booking($db);

// Get ID

$booking->id = isset($_GET['id'])? $_GET['id'] : die();

//Get Booking
$booking->readSingleBooking();

//Create array
$booking_arr = array(
  'id' => $booking->id,
  'customer_id' => $customer_id,
  'guest_nr' => $booking->guest_nr,
  'date' => $booking->date,
  'name' => $booking->name,
  'lastname' => $booking->lastname,
  'phone' => $booking->phone
);

//Make JSON
print_r(json_encode($booking_arr))

?>