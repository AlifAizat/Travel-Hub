<?php


namespace app\controller;

use app\model\DestinationModel as DestinationModel;
use app\model\CategoryModel as CategoryModel;

class DestinationController
{
    private $model;

    /**
     * DestinationController constructor.
     */
    public function __construct()
    {
        $this->model = new DestinationModel();
    }

    public function index()
    {
        $destinations = $this->model->findRand(4);
        include('app/view/index.php');
    }

    public function findByCategory($idCategorie)
    {
        $catModel = new CategoryModel();
        $destinations = null;
        $categorie = "";

        if($idCategorie == 'all')
        {
            $categorie = "Toutes destinations";
            $destinations = $this->model->findAll();
        }else{
            $categorie = $catModel->findOne($idCategorie);
            $destinations = $this->model->findByCategory($idCategorie);
        }

        include('app/view/categorie.php');
    }

    public function vueDestination($idDestination)
    {
        $cm = new CategoryModel();
        $destination = $this->model->findOne($idDestination);
        $categorie = $cm->findOne($destination->getCategorie());

        include('app/view/vue_destination.php');
    }

}