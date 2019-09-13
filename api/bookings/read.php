<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate bookings object

$booking = new Booking($db);

//Boking query
$result = $booking->read();
//Get row count
$num = $result->rowCount();

//Check if any posts
if($num > 0) {
  //Booking array
  $booking_arr = array();
  $booking_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $booking_item = array(
      'id' => $id,
      'customer_id' => $customer_id,
      'guest_nr' => $guest_nr,
      'date' => $date,
      'name' => $name,
      'lastname' => $lastname,
      'email' => $email,
      'phone' => $phone
    );

    //Push to "data"
    array_push($booking_arr['data'], $booking_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  //Turn to JSON & output
  echo json_encode($booking_arr);
  } else {

  // set response code - 404 not found
  // http_response_code(404);

  echo json_encode(

    array('message' => 'No Bookings Found')
  );
}

?>
