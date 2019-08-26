<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Conternt-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog bookings object
$booking = new Booking($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

// Set ID to update
$post->id = $data->id;

// Delete post
if($post->delete()){
    echo json_encode(
        array('message' => 'Post Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}
