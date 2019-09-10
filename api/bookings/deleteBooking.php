<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';
include_once '../../models/Customer.php';

//show errors 
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate bookings object
$booking = new Booking($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));
// print_r($data);

// Set ID to update
$booking->id = $data->id;

$bookingResult = $booking->readSingle($booking->id);
$result = $bookingResult->fetch(PDO::FETCH_OBJ);

$customer = new Customer($db);

$customerResult = $customer->readCustomer($result->customer_id);
$selectedCustomer = $customerResult->fetch(PDO::FETCH_OBJ);
print_r($selectedCustomer);
print_r($selectedCustomer->email);
$to = $selectedCustomer->email;

// Delete post
if($booking->delete()){
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}


// $to = $result->email;

$msg = "Hey {$result->name} {$result->lastname}, your booking is now deleted";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($to, "Your booking is deleted" ,$msg);
