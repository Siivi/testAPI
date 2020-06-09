<?php 
require "./config.php";
include "./header.php";

$fileName = '../cache.json';
$cacheTime = 5;
$sql_get = "SELECT * FROM api.my_favorite";
$content;

if (file_exists($fileName) && (time() - filemtime($fileName) < $cacheTime) ) {
    $content = file_get_contents($fileName);
     die(var_dump($content));  
} else {
	$result = $conn->query($sql_get);
	 
    if (!$result) {
        return;
    }
    while($r = mysqli_fetch_assoc($result)) {
        $books[] = $r;
    }
    $content = json_encode($books);
    
    file_put_contents($fileName, $content);  
}
$conn->close();
?>
<div class="container">
  <div class="row">
    <div class="col-12">
		<table class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">Pealkiri</th>
		      <th scope="col">Pilt</th>
		      <th scope="col">Kirjeldus</th>
		      <th scope="col">Ilmumise aasta</th>
		      <th scope="col">Ilmus Eestis</th>
		    </tr>
		  </thead>
		  <tbody>
			  <div  id="data">
			
			  <?php
			   $data = json_decode($content);
    			foreach ($data as $i):
     			 ?>
		      <th><?php echo $i->title ?></th>
		      <td class="w-25"><img src="images/<?php echo $i->image ?>" style="width: auto; height:300px" class="image"></td>
		      <td><?php echo $i->description ?></td>
		      <td><?php echo $i->published ?></td>
		      <td><?php echo $i->publishedEst ?></td>
		    </tr>
		    <tr>
				<?php  endforeach; ?>
				</div>
		  </tbody>
		</table>  
		
	</div>
  </div>
</div>
