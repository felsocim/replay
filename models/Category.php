<?php

require_once 'Kernel.php';

class Category extends Kernel
{
    private $_id;
    private $_titre;
    private $_description;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function setIdcategorie($id)
    {
        $this->_id = $id;
    }

    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function getIdcategorie()
    {
        return $this->_id;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public static function getAllCategories()
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM categorie");
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $category = new Category($row);
            array_push($result, $category);
        }

        return $result;
    }
}