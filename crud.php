<?php 

include 'config.php'; 
// get database connection
//$connect = new Connect();
//$db = $connect->config();
if(isset($_POST['add']))
    {
        $title = 
    /*$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $published = filter_input(INPUT_POST, 'published', FILTER_SANITIZE_NUMBER_INT);
    $publishedEst = filter_input(INPUT_POST, 'publishedEst', FILTER_SANITIZE_NUMBER_INT);
*/
    $image = $_FILES['image']['title'];
    $upload="images/".$image;

    $sql = "INSERT INTO api.my_favorite(title,description,published,publishedEst) values(?,?,?,?)";
    //die($sql);
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssss",$title, $description, $published, $publishedEst, $upload);
    $stmt=mysqli_query($conn, $sql);
    //$stmt->execute();
    move_uploaded_file($_FILES['image']['tmp_name'], $upload);

    header('location:index.php');
    $_SESSION['response']="Edukalt salvestatud andmebaasi!";
    $_session['res_type']="edukas";
}  
?>