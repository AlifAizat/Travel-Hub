<?php


namespace app\controller;

use app\model\UserModel as UserModel;
use app\model\ReservationModel as ReservationModel;
use app\model\DestinationModel as DestinationModel;

class UserController
{
    private $model;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function creerCompteAdmin()
    {
        $this->model->creerCompteAdmin();
    }

    public function signUp()
    {
        include('app/view/signup.php');
    }

    public function signUp_process($nom, $prenom, $email, $mdp)
    {
        $u_nom_post   = $nom;
        $u_prenom_post   = $prenom;
        $u_email_post = $email;
        $u_mdp_post   = $mdp;

        if (empty($u_email_post) || empty($u_mdp_post) || empty($u_nom_post) || empty($u_prenom_post))
        {
            $this->signUp();
        }else{
            $uArray = array(
                "nom" => $u_nom_post,
                "prenom" => $u_prenom_post,
                "mail" => $u_email_post,
                "mdp" => hash('sha256', $u_mdp_post)
            );

            if($this->model->add($uArray))
            {
                echo "<script type=\"text/javascript\">";
                echo "alert('Inscription réussit !');";
                echo "</script>";

                $this->logout();
                $this->login();
            }else{
                echo "<script type=\"text/javascript\">";
                echo "alert('Inscription échoué !');";
                echo "window.history.back();";
                echo "</script>";

                $this->signUp();
            }
        }
    }

    public function login()
    {
        include('app/view/login.php');
    }

    public function login_process($email, $mdp)
    {
        $u_email_post = $email;
        $u_mdp_post   = $mdp;

        if (empty($u_email_post) || empty($u_mdp_post))
        {
            $this->login();
        }else{
            $u_email = '"'.$u_email_post.'"';
            $u_mdp   = '"'.hash('sha256', $u_mdp_post).'"';
            $user = null;
            $user = $this->model->findUserLogin($u_email,$u_mdp);

            if($user != null)
            {
                $_SESSION['user']['connected'] = true;
                $_SESSION['user']['nom'] = $user->getNom();
                $_SESSION['user']['prenom'] = $user->getPrenom();
                $_SESSION['user']['id'] = $user->getId();
                $_SESSION['user']['role'] = $user->getRole();

                return true;

            }else{
                echo '<script language="javascript">';
                echo 'alert("Le mail ou le mot de passe incorrect !")';
                echo '</script>';

                $this->login();
            }
        }
    }

    public function logout()
    {
        session_destroy();
    }

    public function accesEspacePerso()
    {
        $rm = new ReservationModel();
        $dm = new DestinationModel();
        $reservations = $rm->findReservationByClientId($_SESSION['user']['id']);

        include('app/view/espace-perso.php');
    }

}