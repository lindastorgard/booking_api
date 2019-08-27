<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: application/json; ; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Conternt-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog customer object
$customer = new Customer($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

// Set ID to update
$customer->name = $data->name;
$customer->lastname = $data->lastname;
$customer->email = $data->email;
$customer->phone = $data->phone;
$customer->id = $data->id;

// Update post
if($customer->update()){
    echo json_encode(
        array('message' => 'Post Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}
