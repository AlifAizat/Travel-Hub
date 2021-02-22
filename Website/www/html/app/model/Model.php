<?php


namespace app\model;

use app\config\Database as Database;
use PDO as PDO;
class Model
{
    protected $table;
    private $connection;
    protected $database;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->database = new Database();
        $this->connection = $this->database->getConnection();
    }

    /**
     * Find one value
     * @param $id
     * @return mixed
     */
    public function read($id)
    {
        $sql="SELECT * FROM ".$this->table." WHERE id=".$id;
        $query_result =$this->connection->query($sql);

        return $query_result->fetch(PDO::FETCH_ASSOC);

    }

    /**Find multiple values
     * @param array $data
     * @return mixed
     */
    public function find($data=array())
    {

        $conditions="1";
        $fields="*";
        $limit="";
        $order=$this->table.".id DESC";
        $other_table="";
        if(isset($data["conditions"])){$conditions=$data["conditions"];}
        if(isset($data["fields"])){$fields=$data["fields"];}
        if(isset($data["limit"])){$limit=" LIMIT ".$data["limit"];}
        if(isset($data["order"])){$order=$data["order"];}
        if(isset($data["other_table"])){$other_table=','.$data["other_table"];}

        $sql="SELECT $fields FROM ". $this->table." ".$other_table." WHERE $conditions ORDER BY $order $limit";

        $prepared_q=$this->connection->prepare($sql);
        $prepared_q->execute();
        $result=$prepared_q->fetchAll(PDO::FETCH_ASSOC);


        return $result;

    }

    public function findOneConditions($data=array())
    {

        $conditions="1";
        $fields="*";
        $limit="";
        $order=$this->table.".id DESC";
        $other_table="";
        if(isset($data["conditions"])){$conditions=$data["conditions"];}
        if(isset($data["fields"])){$fields=$data["fields"];}
        if(isset($data["limit"])){$limit=" LIMIT ".$data["limit"];}
        if(isset($data["order"])){$order=$data["order"];}
        if(isset($data["other_table"])){$other_table=','.$data["other_table"];}

        $sql="SELECT $fields FROM ". $this->table." ".$other_table." WHERE $conditions ";

        $prepared_q=$this->connection->prepare($sql);
        $prepared_q->execute();
        $result=$prepared_q->fetch(PDO::FETCH_ASSOC);


        return $result;

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function add($data=array())
    {
        $column = "";
        $values = "";

        foreach ($data as $key=>$value)
        {
            $buffCol = '`'.$key.'`';
            $column = $column.$buffCol.',';

            if(is_string($value))
            {
                $buffVal = '"'.$value.'"';
                $values = $values.$buffVal.',';
            }
            else{
                $values = $values.$value.',';
            }
        }

        $column = substr($column,0, -1);
        $values = substr($values,0, -1);

        $sql = "INSERT INTO ".$this->table.'('.$column.')'." 
                VALUES(".$values.");";

        return $this->connection->exec($sql);
    }

    /**
     * Delete a line in table
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $query = "DELETE FROM ".$this->table." WHERE id=".$id.";";

        return ($this->connection->exec($query));
    }

}