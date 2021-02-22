<?php


namespace app\controller;

use app\model\CategoryModel as CategoryModel;
class CategoryController
{
    private $model;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->model = new CategoryModel();
    }


}