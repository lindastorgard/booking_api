<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate bookings object
$booking = new Booking($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$booking->customer_id = $data->customer_id;
$booking->guest_nr = $data->guest_nr;
$booking->date = $data->date;

//Create booking
if($booking->create() > 0) {
    echo json_encode(
        array('message' => 'Booking Created')
    );
} else {
    echo json_encode(
        array('message' => 'Booking Not Created')
    );
} 

$to = "linda.storgard@gmail.com";

$msg = "Dear  thank you for your reservation on {$data->date} for {$data->guest_nr}";
// $msg = "Dear {$data->name}, thank you for you reservation on {$newDate}.(\n) We are looking forward having you at our restaurant";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);


// send email
mail($to, "Thank you for your reservation" ,$msg);