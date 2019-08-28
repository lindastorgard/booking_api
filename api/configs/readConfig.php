<?php
//Headers
//CORS (Cross-Origin Resource Sharing) header
//Should be changed to http://localhost:3000/
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; ; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Config.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate config object

$config = new Config($db);

//Config query
$result = $config->readConfig();
//Get row count
$num = $result->rowCount();

//Check if any posts
if($num > 0) {
  //Config array
  $config_arr = array();
  $config_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $config_item = array(
      'setting' => $setting,
      'value' => $value
    );

    //Push to "data"
    array_push($config_arr['data'], $config_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  //Turn to JSON & output
  echo json_encode($config_arr);
  } else {  
  
  // set response code - 404 not found
  http_response_code(404);

  echo json_encode(
    
    array('message' => 'No Configurations Found')
  );
}

?>