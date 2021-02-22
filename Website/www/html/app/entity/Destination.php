<?php


namespace app\entity;


class Destination
{
    private $id;
    private $categorie;
    private $designation;
    private $description;
    private $img_dest;
    private $prix_journee;
    private $prix_billet;

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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImg_dest()
    {
        return $this->img_dest;
    }

    /**
     * @param mixed $img_dest
     */
    public function setImg_dest($img_dest)
    {
        $this->img_dest = $img_dest;
    }

    /**
     * @return mixed
     */
    public function getPrix_journee()
    {
        return $this->prix_journee;
    }

    /**
     * @param mixed $prix_journee
     */
    public function setPrix_journee($prix_journee)
    {
        $this->prix_journee = $prix_journee;
    }

    /**
     * @return mixed
     */
    public function getPrix_billet()
    {
        return $this->prix_billet;
    }

    /**
     * @param mixed $prix_billet
     */
    public function setPrix_billet($prix_billet)
    {
        $this->prix_billet = $prix_billet;
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