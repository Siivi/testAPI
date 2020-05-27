<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../Connect/config.php';
include_once '../Favorite/table.php';
  
// get database connection
$connect = new Connect();
$db = $connect->config();
  
// prepare product object
$favorite = new Favorite($db);
  
// set ID property of record to read
$favorite->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$favorite->readOne();
  
if($favorite->title!=null){
    // create array
    $favorite_arr = array(
        "id" =>  $favorite->id,
        "title" => $favorite->title,
        "description" => $favoritet->description,
        "price" => $favorite->price,
        "published" => $favorite->published,
        "publishedEst" => $favorite->publishedEst
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($favorite_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Sellist raamatut ei ole !!11!!!1"));
}
?>