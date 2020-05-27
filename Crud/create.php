<?php
include 'config.php';
include 'header.php';
//$conn = new PDO($dsn, $user, $psw, $options);
$msg = '';
// Check if user has uploaded new image
if (isset($_POST['title'], $_FILES['image'], $_POST['description'], $_POST['published'], $_POST['publishedEst'])) {
    // The folder where the images will be stored
    $conn = new PDO($dsn, $user, $psw, $options);
	$folder = 'images/';
	// The path of the new uploaded image
	$image_path = $folder . basename($_FILES['image']['name']);
	// Check to make sure the image is valid
	if (!empty($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name'])) {
		if (file_exists($image_path)) {
			$msg = 'See pilt on juba olmeas, vali teine või nimeta ümber!!11!';
		} else if ($_FILES['image']['size'] > 500000) {
			$msg = 'Pilt on liiga suur, vali väiksem kui 500kb.';
		} else {
			// Everything checks out now we can move the uploaded image
			move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
			// Connect to MySQL
			$conn = new PDO($dsn, $user, $psw, $options);
			// Insert image info into the database (title,image path,  description, and date added)
			$stmt = $conn->prepare('INSERT INTO api.my_favorite VALUES (?, ?, ?, ?, ?)');
	        $stmt->execute([$_POST['title'], $image_path, $_POST['description'], $_POST['published'], $_POST['publishedEst'],]);
			$msg = 'Salvestatud andmebaasi!';
		}
	} else {
		$msg = 'Please upload an image!';
	}
}
?>
<div class="content upload">
	<h2>Upload Image</h2>
	<form action="create.php" method="post" enctype="multipart/form-data">
		<label for="image">Choose Image</label>
		<input type="file" name="image" accept="image/*" id="image">
		<label for="title">Title</label>
		<input type="text" name="title" id="title">
		<label for="description">Description</label>
		<textarea name="description" id="description"></textarea>
	    <input type="submit" value="Upload Image" name="submit">
	</form>
	<p><?=$msg?></p>
</div>

<?php include 'footer.php' ?>