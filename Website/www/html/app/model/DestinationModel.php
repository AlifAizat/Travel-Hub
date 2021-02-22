<?php


namespace app\model;

use app\entity\Destination as Destination;

class DestinationModel extends Model
{

    /**
     * DestinationModel constructor.
     */
    public function __construct()
    {
        $this->table = "Destination";
        parent::__construct();
    }

    public function findOne($id)
    {
        $array = parent::read($id);
        return new Destination($array);
    }

    public function findAll()
    {
        $arrayDestinations = parent::find(array(
            "fields"=>"*"
        ));
        $tableDestinations = array();

        foreach ($arrayDestinations as $aDestination)
        {
            array_push($tableDestinations, new Destination($aDestination));
        }

        return $tableDestinations;
    }

    public function findRand($limit)
    {
        $arrayDestinations = parent::find(array(
            "fields" => "*",
            "limit" => $limit,
            "order" => "RAND()"
        ));
        $tableDestinations = array();

        foreach ($arrayDestinations as $aDestination)
        {
            array_push($tableDestinations, new Destination($aDestination));
        }

        return $tableDestinations;
    }

    public function findByCategory($idCategory)
    {
        $conditionID = 1;
        if ($idCategory == 'all')
        {
            $conditionID = 1;
        }else{
            $conditionID = "categorie=".$idCategory;
        }
        $arrayDestinations = parent::find(array(
            "fields" => "*",
            "conditions" => $conditionID
        ));
        $tableDestinations = array();

        foreach ($arrayDestinations as $aDestination)
        {
            array_push($tableDestinations, new Destination($aDestination));
        }

        return $tableDestinations;
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