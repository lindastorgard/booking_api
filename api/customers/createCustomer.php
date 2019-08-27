<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate customers object

$customer = new customer($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$customer->name = $data->name;
$customer->lastname = $data->lastname;
$customer->email = $data->email;
$customer->phone = $data->phone;

//Create customer
if($customer->createCustomer() > 0) {
    echo json_encode(
        array('message' => 'Customer Created')
    );
} else {
    echo json_encode(
        array('message' => 'Customer Not Created')
    );
} 