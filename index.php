<?php
include 'config.php';
include 'header.php';
require 'upload.php';
?>
<div class="container ">
  <div class="row">
    <div class="card-header">
      <h2>Lisa raamat</h2>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <form action="upload.php" method="post" enctype="multipart/form-data">
    
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
          <button type="submit" name="submit" class="btn btn-info">Sisesta andmed</button>
        </div>
      </form>


    </div>
    <div class="col-md-2"></div>

  </div>
</div>



<?php include 'footer.php'; ?>