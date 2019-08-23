<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Conternt-Type: aplication/json');

include_once '../../config/Database.php';
include_once '../../models/Booking.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog bookings object

$booking = new Booking($db);

//Boking query
$result = $booking->read();
//Get roe count
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
      'date' => $date
    );

    //Push to "data"
    array_push($booking_arr['data'], $booking_item);
  }

  //Turn to JSON & output
  echo json_encode($booking_arr);
  } else {
  echo json_encode(
    array('message' => 'No Bookings Found')
  );
}

?>