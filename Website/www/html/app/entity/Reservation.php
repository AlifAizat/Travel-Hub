<?php


namespace app\entity;


class Reservation
{
    private $id;
    private $client;
    private $destination;
    private $prix_total;
    private $dateDepart;
    private $dateFin;
    private $estPaye;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getPrix_total()
    {
        return $this->prix_total;
    }

    /**
     * @param mixed $prix_total
     */
    public function setPrix_total($prix_total)
    {
        $this->prix_total = $prix_total;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param mixed $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getEstPaye()
    {
        return $this->estPaye;
    }

    /**
     * @param mixed $estPaye
     */
    public function setEstPaye($estPaye)
    {
        if ($estPaye == '0' || $estPaye == false)
        {
            $this->estPaye = false;
        }else{
            $this->estPaye = true;
        }
    }



    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

}