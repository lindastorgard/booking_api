<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: application/json; ; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate customers object

$customer = new Customer($db);

//Customers query
$result = $customer->readCustomers();
//Get row count
$num = $result->rowCount();

//Check if any posts
if($num > 0) {
  //Booking array
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

    //Push to "data"
    array_push($customer_arr['data'], $customer_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  //Turn to JSON & output
  echo json_encode($customer_arr);
  } else {  
  
  // set response code - 404 not found
  http_response_code(404);

  echo json_encode(
    
    array('message' => 'No Customers Found')
  );
}
?>