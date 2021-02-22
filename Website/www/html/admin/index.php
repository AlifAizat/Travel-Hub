<?php
include('../app/config/Database.php');
use app\config\Database as Database;

session_start();

if ($_SESSION['user']['connected'] == true){
    if ($_SESSION['user']['role'] == 'CLIENT'){
        header('Location: http://0.0.0.0/index');
    }
} else {
    header('Location: http://0.0.0.0/index');
}

/**
 * Creation de connexion au serveur BD
 */
$db = new Database();
$con = $db->getConnection();


/**
 *
 */
$queryMain = "SELECT * FROM Category;";

$resultat = $con->query($queryMain);
$categories = $resultat->fetchAll();


/**
 * Traitement
 */

if (isset($_POST['designation']) && isset($_POST['categorie']) && isset($_POST['description']) && isset($_POST['prix_journee']) && isset($_POST['prix_billet']) && isset($_FILES['img_dest'])){

    /**
     * Affectation des valeurs envoyées aux variables
     */
    $designation    = '"'.$_POST['designation'].'"';
    $description    = '"'.$_POST['description'].'"';
    $cat_treat      = $_POST['categorie'];
    $prix_journee   = $_POST['prix_journee'];
    $prix_billet    = $_POST['prix_billet'];
    $image       = $_FILES['img_dest']['name'];
    $image_tmp   = $_FILES['img_dest']['tmp_name'];


    /**
     * Vérification s'il existe un champ vide
     */
    $isEmpty = (empty($designation) || empty($description) || empty($cat_treat) || empty($prix_journee) || empty($prix_billet) || empty($image));

    /**
     * S'il est pas vide, on affecte l'insertion
     */
    if(!$isEmpty){

        $repertoire = "app/img/dest";
        $img_addr = '"'.$repertoire.'/'.$image.'"';

        /**
         * Création de requête d'insertion
         */
        $req_insert = "INSERT INTO Destination (categorie, designation, description, img_dest, prix_journee, prix_billet)
                       VALUES (".$cat_treat.','.$designation.','.$description.','.$img_addr.','.$prix_journee.','.$prix_billet.");";

        /**
         * Vérification si l'image engregistré exist déjà dans la BD
         */
        $req_check = "SELECT * FROM Destination WHERE img_dest=".$img_addr.';';
        $is_exists_in_directory = (($con->query($req_check))->fetch());


        /**
         * Ajout dans la base de données
         */
        if ($con->exec($req_insert)){
            echo '<script language="javascript">';
            echo 'alert("Le produit est bien enregistré !")';
            echo '</script>';

            /**
             * Enregistrement dans le repertoire local
             */

            if(!$is_exists_in_directory){
                //$add_repertoire = "../".$repertoire.'/';
                $add_repertoire = "../app/img/dest/";

                move_uploaded_file($image_tmp, $add_repertoire.$image);
                //var_dump($add_repertoire);
                //var_dump($add_repertoire.$image);
            }


        }else {
            echo '<script language="javascript">';
            echo 'alert("L\'enregistrement echoué !")';
            echo '</script>';
        }

    }

}else{

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Espace Administration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include '../app/global/bootstrap.php'; ?>


</head>
<body>

<div class="jumbotron text-center">
    <h1>Espace Administration</h1>
    <p>Ajout d'une nouvelle destination</p>
</div>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left">

            <form class="form-signin" action="./index.php" method="post" enctype="multipart/form-data">

                <h1 class="h4 mb- font-weight-normal">Designation : </h1>
                <input type="text" id="inputDesignation" name="designation" class="form-control" placeholder="Designation ..." required="">

                <br>

                <h1 class="h4 mb- font-weight-normal">Catégorie : </h1>
                <select id="categorie" name="categorie">
                    <?php foreach ($categories as $cat) : ?>
                        <option value="<?= $cat['id']; ?>"><?= $cat['nom']; ?></option>
                    <?php endforeach; ?>
                </select>

                <br><br>

                <h1 class="h4 mb- font-weight-normal">Description : </h1>
                <input type="text" id="inputDescription" name="description" class="form-control" placeholder="Description ..." required="">

                <br>

                <h1 class="h4 mb- font-weight-normal">Prix par journée : </h1>
                <input type="number" step="0.01" id="inputPrix_journee" name="prix_journee" class="form-control" placeholder="0" required="">

                <br>

                <h1 class="h4 mb- font-weight-normal">Prix de billet : </h1>
                <input type="number" step="0.01" id="inputPrix_billet" name="prix_billet" class="form-control" placeholder="0" required="">

                <br>

                <h1 class="h4 mb- font-weight-normal">Image : </h1>
                <input type="file" id="inputPrix_billet" name="img_dest" class="form-control" accept="image/png, image/jpg, image/jpeg">

                <br>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
                <br>
            </form>

            <hr>

        </div>
        <div class="col-sm-2 sidenav">
            <a href="../index.php"><button class="btn btn-lg btn-primary btn-block"> Revenir à l'accueil</button></a>
            <br>
            <div class="well">
                
            </div>
        </div>
    </div>
</div>

</body>
</html>