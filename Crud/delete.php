<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../Connect/config.php';
include_once '../Favorite/table.php';

  
// get database connection
$connect = new Connect();
$db = $connect->config();
  
// prepare product object
$favorite = new Favorite($db);
  
// get product id
$data = json_decode(file_get_contents("php://input"));
  
// set product id to be deleted
$favoritet->id = $data->id;
  
// delete the product
if($favorite->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Kustutatud!!!111!!!"));
}
  
// if unable to delete the product
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Ei kustutanud!!!111!!!"));
}
?>