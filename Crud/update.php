<?php
  
/* include database and object files
include_once '../Connect/config.php';
include_once '../Favorite/table.php';
  
// get database connection
$connect = new Connect();
$db = $connect->config();
  
// prepare product object
$favorite = new Favorite($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$favorite->id = $data->id;
  
// set product property values
$favorite->title = $data->title;
$favorite->image = $data->image;
$favorite->description = $data->description;
$favorite->published = $data->published;
$favorite->publishedEst = $data->publishedEst;
  
// update the product
if($favorite->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Juhuu said uuendatud !1!!!!"));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Pöööö, ei saanud uuendamisega hakkama !!11!!!!"));
}*/
?>