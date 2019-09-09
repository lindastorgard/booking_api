<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

$database = new Database();
$db = $database->connect();

$customer = new Customer($db);

$result = $customer->readCustomers();

$num = $result->rowCount();

if($num > 0) {

    $customer_arr = array();
    $customer_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $customer_item = array(
            'id' => $id,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone
        );

        array_push($customer_arr['data'], $customer_item);
    }

    http_response_code(200);

    echo json_encode($customer_arr);
} else {

    http_response_code(404);

    echo json_encode(

        array('message' => 'No customers found')
    );
}
