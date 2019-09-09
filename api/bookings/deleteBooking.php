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

// Set ID to update
$booking->id = $data->id;

$customer = new Customer($db);
$customer->customer_id = $data->customer_id;
$customerResult = $customer->readCustomer($customer->customer_id);
$result = $customerResult->fetch(PDO::FETCH_OBJ);
$to = $result->email;

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

print_r($result);
print_r($to);

// $to = $result->email;

$msg = "Hey {$result->name} {$result->lastname}, your booking is now deleted";
// $msg = "Dear {$data->name}, thank you for you reservation on {$newDate}.(\n) We are looking forward having you at our restaurant";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($to, "Your booking is" ,$msg);
