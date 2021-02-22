<?php


/*
$bd = new Database();
$um = new UserManager($bd);

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp']))
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $mdp  = $_POST['mdp'];

    $isEmpty = empty($nom) || empty($prenom) || empty($mail) || empty($mdp);

    if(!$isEmpty)
    {
        $user = new User(
                array(
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "mail" => $mail,
                    "mdp" => $mdp,
                    "role" => "CLIENT"
                )
        );

        if($um->add($user))
        {
            header('Location: http://0.0.0.0/src/view/login.php');
        }else{
            echo '<script language="javascript">';
            echo 'alert("Utilisateur existe déjà !")';
            echo '</script>';
        }

    } else{
        echo '<script language="javascript">';
        echo 'alert("Veuillez remplir tous les champs !")';
        echo '</script>';
    }
}
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
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
    <form class="form-signin" action="./index.php?page=sign_up_set" method="post">
        <img class="mb-4" src="app/img/compass.png" alt="" width="72" height="72">
        <!--
        <div>Icons made by <a href="https://www.flaticon.com/authors/alfredo-hernandez" title="Alfredo Hernandez">Alfredo Hernandez</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        -->
        <h1 class="h3 mb-3 font-weight-normal">Rejoignez-nous !</h1>

        <label for="inputNom" class="sr-only">Prénom</label>
        <input type="text" id="inputNom" class="form-control" placeholder="Nom ..." required="" name="nom">
        <br>
        <label for="inputPrenom" class="sr-only">Nom</label>
        <input type="text" id="inputPrenom" class="form-control" placeholder="Prénom ..." required="" name="prenom">
        <br>
        <label for="inputMail" class="sr-only">Mail </label>
        <input type="email" id="inputMail" class="form-control" placeholder="Mail ..." required="" autofocus="" name="mail">
        <br>
        <label for="inputMDP" class="sr-only">Mot de passe</label>
        <input type="password" id="inputMDP" class="form-control" placeholder="Mot de passe ..." required="" name="mdp">
        <br><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
        <p class="mt-5 mb-3 text-muted">© 2019-2020</p>
    </form>

</div>

</body>

<?php include 'app/global/footer.php';?>

</html>
