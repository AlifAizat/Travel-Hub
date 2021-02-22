<?php

$_SESSION['user']['connected'] = false;

/**if (isset($_POST['email'], $_POST['mdp'])){
    $u_email_post = $_POST['email'];
    $u_mdp_post   = $_POST['mdp'];

    if(empty($u_email_post) || empty($u_mdp_post)){
        header('Location: http://0.0.0.0/login.php');
    } else {

        $u_email = '"'.$u_email_post.'"';
        $u_mdp   = '"'.hash('sha256', $u_mdp_post).'"';
        $query_check = "SELECT * FROM User WHERE mail=".$u_email." AND mdp=".$u_mdp.";";

        $resultat = "";
        $res = "";

        $resultat = $con->query($query_check);
        $res = $resultat->fetch();

        if($res){

            $_SESSION['user']['connected'] = true;
            $_SESSION['user']['nom'] = $res['nom'];
            $_SESSION['user']['prenom'] = $res['prenom'];
            $_SESSION['user']['id'] = $res['id'];
            $_SESSION['user']['role'] = $res['role'];

            header('Location: http://0.0.0.0/index.php');

        } else {
            echo '<script language="javascript">';
            echo 'alert("Le mail ou le mot de passe incorrect !")';
            echo '</script>';
        }
    }
} **/

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "app/global/bootstrap.php"; ?>
    <link rel="stylesheet" type="text/css" href="app/css/global.css">
    <style>
        .container{
            max-width: 600px;
        }
    </style>
</head>


<body class="text-center" data-gr-c-s-loaded="true">
<?php include "app/global/header.php";?>

<div>
    <br><br><br><br><br><br>
</div>

<div class="container">
    <form class="form-signin" action="./index.php?page=login_set" method="post">
        <img class="mb-4" src="app/img/compass.png" alt="" width="72" height="72">
        <!--
        <div>Icons made by <a href="https://www.flaticon.com/authors/alfredo-hernandez" title="Alfredo Hernandez">Alfredo Hernandez</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        -->
        <h1 class="h3 mb-3 font-weight-normal">Connectez-vous!</h1>

        <label for="inputEmail" class="sr-only">Mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Mail" required="" autofocus="" name="email">
        <br>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe ..." required="" name="mdp">

        <div class="checkbox mb-3">

        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
        <p class="mt-5 mb-3 text-muted">© 2019-2020</p>
    </form>

    <a href="./index.php?page=sign_up" class="btn btn-info" role="button">Créer un compte ?</a>

    <br><br>

</div>

</body>

<?php include 'app/global/footer.php';?>

</html>
