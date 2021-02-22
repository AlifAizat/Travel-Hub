<?php


namespace app\model;

use app\entity\User as User;

class UserModel extends Model
{

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        $this->table = "User";
        parent::__construct();
    }

    public function findOne($id)
    {
        $array = parent::read($id);
        return new User($array);
    }

    public function findAll()
    {
        $arrayUser = parent::find(array(
            "fields"=>"*"
        ));
        $tableUsers = array();

        foreach ($arrayUser as $aUser)
        {
            array_push($tableUsers, new User($aUser));
        }

        return $tableUsers;
    }

    public function findUserLogin($email, $mdp)
    {
        $user = null;
        try {

            $arrayUser = parent::findOneConditions(array(
                "fields"=>"*",
                "conditions"=> "mail=".$email." AND mdp=".$mdp
            ));
            $user = new User($arrayUser);

        }catch (\Exception $e)
        {
            $user = null;
        }

        return $user;
    }

    public function add($data = array())
    {
        return parent::add($data);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }

    public function creerCompteAdmin()
    {
        $this->database->creerCompteAdmin();
    }
}