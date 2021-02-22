<?php

session_start();


use app\entity\Category as Category;
use app\entity\Destination as Destination;
use app\entity\Reservation as Reservation;
use app\entity\User as User;
use app\controller\CategoryController as CategoryController;
use app\controller\DestinationController as DestinationController;
use app\controller\ReservationController as ReservationContoller;
use app\controller\UserController as UserController;

function chargerClasse($classe)
{
    $classe=str_replace('\\','/',$classe);
    require $classe . '.php';
}
spl_autoload_register('chargerClasse');

$categoryC = new CategoryController();
$destinationC = new DestinationController();
$reservationC = new ReservationContoller();
$userC = new UserController();

$userC->creerCompteAdmin();

?>

<!-- La page Index -->
<?php if(!isset($_GET['page']) || $_GET['page'] == "index") : ?>
    <?php $destinationC->index(); ?>


<?php else: ?>

    <!-- La liste des destinations selon la catégorie -->
    <?php if ($_GET['page'] == "categorie" && isset($_GET['cat'])) : ?>
        <?php $destinationC->findByCategory($_GET['cat']); ?>

    <!-- l'inscription -->
    <?php elseif ($_GET['page'] == 'sign_up' || $_GET['page'] == 'sign_up_set') : ?>
        <?php if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mdp'])) : ?>
            <?php $userC->signUp_process($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['mdp']); ?>
            <?php unset($_POST); ?>
        <?php else : ?>
            <?php $userC->signUp(); ?>
        <?php endif; ?>

    <!-- La connexion -->
    <?php elseif ($_GET['page'] == 'login' || $_GET['page'] == 'login_set') : ?>
        <?php if (isset($_POST['email']) && isset($_POST['mdp'])) : ?>
            <?php if($userC->login_process($_POST['email'], $_POST['mdp'])) : ?>
                <?php unset($_POST); ?>
                <?php $destinationC->index(); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php $userC->login(); ?>
        <?php endif; ?>

    <!-- La deconnexion -->
    <?php elseif ($_GET['page'] == 'logout') : ?>
        <?php $userC->logout(); ?>
        <?php $userC->login(); ?>

    <!-- Acces à l'espace personel -->
    <?php elseif ($_GET['page'] == 'espace_perso' && $_SESSION['user']['connected'] == true) : ?>
        <?php $userC->accesEspacePerso(); ?>
        <?php unset($_POST); ?>

    <!-- La vue d'une destination -->
    <?php elseif ($_GET['page'] == 'vue_destination' && isset($_GET['dest'])) : ?>
        <?php $destinationC->vueDestination($_GET['dest']); ?>
        <?php unset($_POST); ?>

    <!-- Gérer la réservation  -->
    <?php elseif ($_GET['page'] == 'reservation' && isset($_POST['resaDest']) && isset($_POST['resaDateDepart']) && isset($_POST['resaDateFin'])) : ?>
        <?php $reservationC->treatReservation($_POST['resaDest'],$_POST['resaDateDepart'],$_POST['resaDateFin']); ?>
        <?php unset($_POST); ?>

    <?php elseif ($_GET['page'] == 'annulation' && isset($_GET['id'])) : ?>
        <?php $reservationC->annulerUneReservation($_GET['id']); ?>
        <?php ob_clean(); ?>
        <?php $userC->accesEspacePerso(); ?>

    <?php endif; ?>

<?php endif; ?>
