<?php


namespace app\model;

use app\entity\Reservation as Reservation;

class ReservationModel extends Model
{

    /**
     * ReservationController constructor.
     */
    public function __construct()
    {
        $this->table = "Reservation";
        parent::__construct();
    }


    public function findOne($id)
    {
        $array = parent::read($id);
        return new Reservation($array);
    }

    public function findAll()
    {
        $arrayReservations = parent::find(array(
            "fields"=>"*"
        ));
        $tableReservation = array();

        foreach ($arrayReservations as $aReservation)
        {
            array_push($tableReservation,new Reservation($aReservation));
        }

        return $tableReservation;
    }

    public function findReservationByClientId($idClient)
    {
        $arrayReservations = parent::find(array(
            "fields"=>"*",
            "conditions" => "client=".$idClient
        ));
        $tableReservation = array();

        foreach ($arrayReservations as $aReservation)
        {
            array_push($tableReservation,new Reservation($aReservation));
        }

        return $tableReservation;
    }

    public function add($data = array())
    {
        return parent::add($data);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
}