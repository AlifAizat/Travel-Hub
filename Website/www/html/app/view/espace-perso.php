<?php

unset($_POST);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Espace personel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "app/global/bootstrap.php"; ?>
    <link rel="stylesheet" type="text/css" href="app/css/global.css">

</head>
<body>

<?php include "app/global/header.php";?>
<br>
<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-2 sidenav" style="background: none">

        </div>

        <div class="col-sm-8 text-left" style="background-color: #f1f1f1;min-height: 600px;">
            <div class="espace_perso">
                <h1>Bienvenue <?= $_SESSION['user']['nom']; ?> </h1>

                <div class="">
                    <h2>Vos resérvations</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Destination</th>
                            <th>Date de départ</th>
                            <th>Date de fin</th>
                            <th>Prix total</th>
                            <th>Annuler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservations as $res): ?>
                        <tr>
                            <?php if ($res->getClient() == $_SESSION['user']['id']): ?>
                                <?php if ($res->getEstPaye()) : ?>
                                    <td><?= ($dm->findOne($res->getDestination()))->getDesignation(); ?></td>
                                <?php else: ?>
                                    <td style="color: maroon"><?= ($dm->findOne($res->getDestination()))->getDesignation(); ?></td>
                                <?php endif; ?>
                                <td><?= $res->getDateDepart(); ?></td>
                                <td><?= $res->getDateFin(); ?></td>
                                <td><?= $res->getPrix_total(); ?></td>
                                <td><a href="./index.php?page=annulation&id=<?= $res->getId(); ?>"><button type="button" class="btn btn-danger">Annuler</button></a></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <p>*Les paiements sont à faire au bureau!</p>
        </div>

        <div class="col-sm-2 sidenav" style="background: none">

        </div>

    </div>
</div>

<br><br><br>

<?php include 'app/global/footer.php';?>

</body>
</html>
