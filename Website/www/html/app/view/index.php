<?php

//session_start();
require('app/config/util.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Travel Hub</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "app/global/bootstrap.php"; ?>
  <link rel="stylesheet" type="text/css" href="app/css/global.css">
  
</head>
<body>
  <?php include 'app/global/carousel.php'; ?>
  <?php include "app/global/header.php";?>

  <div class="bg">

    <div class="jumbotron text-center">
      <h1>Travel Hub</h1>
      <p>The best travel website!</p>
    </div>

  <div class="container text-center">
      <div class="row">


          <?php foreach ($destinations as $val) : ?>

              <div class="col-sm-6">
                  <div class="panel panel-primary">
                      <div class="panel-heading"><h1><?= $val->getDesignation();?></h1></div>
                      <div class="panel-body"><img src=<?= $val->getImg_dest();?> class="img-responsive" style="width:100%" alt="Image"></div>
                      <div class="panel-footer"><?= tronquer_texte($val->getDescription());?> </div>
                      <br>

                      <a href="./index.php?page=vue_destination&dest=<?= $val->getId();?>" class="btn btn-primary" role="button">Plus d'information</a>
                      <br><br><br>
                  </div>
              </div>
            

          <?php endforeach; ?>

      </div>

      <br>
  </div><br><br>


</body>

<?php include 'app/global/footer.php';?>

</html>