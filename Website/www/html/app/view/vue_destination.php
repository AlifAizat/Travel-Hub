<?php


/**
$con = connexionBd();

if(isset($_GET['dest'])){

    $destination = $_GET['dest'];
    $queryMain = "";
    $queryCat = "";

    if (empty($destination)){
        header('Location: http://0.0.0.0/index');
    } else {
        $queryMain = "SELECT * FROM Destination WHERE id=".$destination.";";
    }

}else{
    header('Location: http://0.0.0.0/index');
}

$res = $con->query($queryMain);
$res = $res->fetch();

$queryCat  = "SELECT * FROM Categorie WHERE id=".$res['categorie'].";";

$cat = $con->query($queryCat);
$cat = $cat->fetch();

**/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vue Destination</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "app/global/bootstrap.php"; ?>
    <link rel="stylesheet" type="text/css" href="app/css/global.css">
    <link rel="stylesheet" type="text/css" href="app/css/vue_destination.css">
</head>
<body>
    <?php include "app/global/header.php";?>
    <br>
    <div class="container-fluid">
        <div class="row content">

            <div class="col-sm-9 main_div">
                <h2><?= $destination->getDesignation(); ?></h2>
                <img class="img-responsive" src="<?= $destination->getImg_dest(); ?>" alt="<?= $destination->getDesignation(); ?>">

                <h3> <span class="label label-primary"><?= $categorie->getNom(); ?></span></h3><br>
                <p>
                    <strong><?= $destination->getDescription(); ?></strong>
                </p>
                <br><br>

                <div class="well">Prix par journée : <br> <?= $destination->getPrix_journee();?> €</div>
                <div class="well">Prix de billet : <br> <?= $destination->getPrix_billet();?> €</div>

            </div>

            <div class="col-sm-3 sidenav">

                <?php if ($_SESSION['user']['connected'] == true) : ?>
                    <fieldset>
                        <legend>Reservation</legend>
                        <form action="./index.php?page=reservation" method="post">
                            <label id="labeldateDerpart" for="dateDepart">Aller : </label>
                            <br>
                            <input type="date" id="dateDepart" name="resaDateDepart">
                            <br>
                            <label id="labeldateFin" for="dateFin">Retour : </label>
                            <br>
                            <input type="date" id="dateFin" name="resaDateFin">
                            <br>
                            <input type="hidden" name="resaDest" value="<?= $_GET['dest']; ?>">
                            <br>
                            <input type="submit" value="Valider">
                        </form>
                    </fieldset>
                <?php endif; ?>


            </div>
        </div>
    </div>

</body>

<?php include 'app/global/footer.php';?>
</html>