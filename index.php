<?php
include 'config.php';
include 'header.php';


if (isset($_POST['submit'])) {
  try {
    //$conn = pdo_connect_mysql();
    $conn = new PDO($dsn, $user, $psw, $options);

    $new_book = array(
      "title" => $_POST['title'],
      "image" => $_POST['image'],
      "description" => $_POST['description'],
      "published" => $_POST['published'],
      "publishedEst" => $_POST['publishedEst']
    );
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "api.my_favorite",
      implode(", ", array_keys($new_book)),
      ":" . implode(", :", array_keys($new_book))
    );
    $stmt = $conn->prepare($sql);
    $stmt->execute($new_book);
  } catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<div class="container ">
  <div class="row">
    <div class="card-header">
      <h2>Loo marker</h2>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <form method="post">
    
        <div class="form-group">
          <input type="text" name="title" id="title" class="form-control" placeholder="Pealkiri">
        </div>
        <div class="form-group">
          <i class="material-icons">&#xe439;</i>
          <input type="file" name="image" accept="image/*" id="image">
        </div>
        <div class="form-group">
          <input type="text" name="description" id="description" class="form-control" placeholder="Kirjeldus">
        </div>
        <div class="form-group">
          <input type="int" name="published" id="published" class="form-control" placeholder="Ilmumis aasta">
        </div>
        <div class="form-group">
          <input type="int" name="publishedEst" id="publishedEst" class="form-control" placeholder="Ilmumis eestis">
        </div>
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-info">Sisesta koht</button>
        </div>
      </form>


    </div>
    <div class="col-md-2"></div>

  </div>
</div>


<?php include 'footer.php'; ?>