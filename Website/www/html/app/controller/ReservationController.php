<?php


namespace app\controller;

use app\model\ReservationModel as ReservationModel;
use app\model\DestinationModel as DestinationModel;
use app\controller\UserController as UserController;

class ReservationController
{
    private $model;

    /**
     * ReservationController constructor.
     */
    public function __construct()
    {
        $this->model = new ReservationModel();
    }

    public function treatReservation($destination, $dateDepart, $dateFin)
    {
        $date_depart = strtotime($dateDepart);
        $date_fin    = strtotime($dateFin);
        $date_diff = $date_fin - $date_depart;
        $nb_jour  = round($date_diff/(60*60*24));

        if($nb_jour > 0)
        {
            $client =  $_SESSION['user']['id'];
            $resaDest = $destination;
            $resaDateDepart = $dateDepart;
            $resaDateFin = $dateFin;

            $dm = new DestinationModel();
            $dest = $dm->findOne($resaDest);

            $resaPrix = $dest->getPrix_billet() + ($dest->getPrix_journee() * $nb_jour);

            $isEmpty = empty($resaDest) || empty($resaDateDepart) || empty($resaDateFin) || empty($resaPrix) || empty($client);
            if(!$isEmpty)
            {
                $arrayR = array(
                    "client" => $client,
                    "destination" => $resaDest,
                    "dateDepart" => $resaDateDepart,
                    "dateFin" => $resaDateFin,
                    "prix_total" => $resaPrix
                );

                if ($this->model->add($arrayR))
                {
                    echo '<script language="javascript">';
                    echo 'alert("La réservation est faite !")';
                    echo '</script>';
                    unset($_POST);
                    $userC = new UserController();
                    $userC->accesEspacePerso();

                }else{
                    echo '<script language="javascript">';
                    echo 'alert("La réservation echouée !")';
                    echo '</script>';

                    echo '<script>window.location.href = "./index.php?page=index";</script>';
                }
            }
        }
    }

    public function annulerUneReservation($id)
    {
        $this->model->delete($id);
    }


}