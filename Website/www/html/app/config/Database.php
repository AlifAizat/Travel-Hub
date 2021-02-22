<?php


namespace app\config;
use PDO as PDO;

class Database
{
    private $_server = "mysql";
    private $_user = "teaweb";
    private $_password = "teaweb";
    private $_db = "MyTravelHub";
    private $_port = 3306;
    private $_connection;

    /**
     * @return mixed
     */
    public function getConnection()
    {
        $this->_connection = null;

        try
        {
            $this->_connection= new PDO("mysql:host={$this->_server};dbname={$this->_db};charset=utf8", $this->_user, $this->_password);
            $this->_connection->exec("SET CHARACTER SET utf8");

        }
        catch(Exception $e)
        {
            $this->_connection = null;
        }

        return $this->_connection;
    }

    public function creerCompteAdmin()
    {
        /**
         * Vérifier si admin principal n'existe pas dans BD
         */
        $mail_admin = '"'."admin@travel-hub.fr".'"';
        $query_check = "SELECT * from User WHERE mail=".$mail_admin.";";
        $con = $this->getConnection();

        if(!($con->query($query_check))->fetch())
        {
            $nom    = '"'."Admin".'"';
            $prenom = '"'."TravelHub".'"';
            $mdp    ='"'.hash('sha256', "adminth").'"';
            $role   ='"'."ADMIN".'"';

            $req_creer = "INSERT INTO User (nom, prenom, mail, mdp, role)
                      VALUES(".$nom.','.$prenom.','.$mail_admin.','.$mdp.','.$role.")";

            $con->exec($req_creer);
        }
    }


}