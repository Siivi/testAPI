<?php
header("Content-type: application/json; charset=utf-8"); 


if(isset($_GET['link'])){
    $link=$_GET['link'];
}else{
    echo"linki ei ole";
    return;

try {
    require "config.php";
    $conn = new PDO($dsn, $user, $psw, $options);
    $sql = "SELECT * FROM cache WHERE link='" . $link ."'";

    if (ctype_digit($limit)) {
        $sql .= ' limit ' . $limit;
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($result)===0){
        $response = file_get_contents($link);
    echo $response;
        $insert = "INSERT INTO cache(link, data) VALUES (:link, :data)";
        $insertStmt=$conn->prepare($insert);
        $insertStmt->execute(["link"=>$link, "data"=>$response]);
    }else{
        echo json_decode(json_encode($result[0]))->data;
    }
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
}
?>
