<?php

require('app/config/util.php');

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
        <?php if (is_string($categorie)) : ?>
            <h1><?= $categorie; ?></h1>
        <?php else : ?>
            <h1><?= $categorie->getNom(); ?></h1>
        <?php endif; ?>
    </div>


    <div class="container text-center destination_main_page">
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


    <br><br><br><br><br><br><br><br>

</div>


</body>

<?php include 'app/global/footer.php';?>

</html>