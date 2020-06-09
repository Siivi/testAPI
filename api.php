<?php
require 'config.php';

$result = [];
foreach($_GET as $key => $value) {
    $result[$key] = $value;
}

if (empty($result)) {
    die('Query failed, attributes missing');
}

$limit = $result['limit'];

$sql = "SELECT * FROM api.my_favorite limit $limit";
$books = [];

$result = $conn->query($sql);
while($r = mysqli_fetch_assoc($result)) {
    $img_link = 'https://ta18pahapill.itmajakas.ee/testApi/images/'.$r['image'];
    $r['image'] = $img_link;
    $books[] = $r;
}

$content = json_encode($books, JSON_UNESCAPED_UNICODE);

print $content;