<?php
include 'config.php';
include 'header.php';

$conn = pdo_connect_mysql();


/* required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
*/
try {
    $sql = "SELECT * FROM markers.markers";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//check if more than  record found
if ($num > 0) {
    $table_arr = array();
    $table_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $table_item = array(
            "id" => $id,
            "title" => $title,
            "image" => $image,
            "description" => html_entity_decode($description),
            "published" => $published,
            "publishedEst" => $publishedEst
        );
        array_push($table_arr["records"], $table_item);
    }
    //set response code
    http_response_code(200);
    echo json_encode($table_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Tühjus!!11!!!!1!")
    );
}
include 'footer.php';
