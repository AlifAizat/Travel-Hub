<?php


namespace app\model;

use app\entity\Category as Category;

class CategoryModel extends Model
{

    /**
     * CategoryModel constructor.
     */
    public function __construct()
    {
        $this->table = "Category";
        parent::__construct();
    }

    public function findOne($id)
    {
        $array = parent::read($id);
        return new Category($array);
    }

    public function findAll()
    {
        $arrayCategories = parent::find(array(
            "fields"=>"*"
        ));
        $tableCategories = array();

        foreach ($arrayCategories as $aCategory)
        {
            array_push($tableCategories, new Category($aCategory));
        }

        return $tableCategories;
    }

    public function findAllById($id)
    {
        $arrayCategories = parent::find(array(
            "fields"=>"*",
            "conditions" => $id
        ));
        $tableCategories = array();

        foreach ($arrayCategories as $aCategory)
        {
            array_push($tableCategories, new Category($aCategory));
        }

        return $tableCategories;
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