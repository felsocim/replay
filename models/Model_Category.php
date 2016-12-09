<?php

require 'Kernel.php';

class Model_Category extends Kernel
{
    private $_id;
    private $_titre;
    private $_description;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function setId($id)
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

    public function getId()
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

    public function getAllCategories()
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM categorie");
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $category = new Model_Category($row);
            array_push($result, $category);
        }

        return $result;
    }
}