<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate bookings object
$booking = new Booking($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

// Set ID to update
$booking->customer_id = $data->customer_id;
$booking->guest_nr = $data->guest_nr;
$booking->date = $data->date;
$booking->id = $data->id;

// Update post
if($booking->update()){
    echo json_encode(
        array('message' => 'Post Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}
