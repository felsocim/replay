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

    public static function getCategoryById($id_cat)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM categorie WHERE idcategorie=:catid");
        $query->bindParam(':catid', $id_cat, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $result = null;

        if($row != null)
        {
            $result = new Category($row);
        }

        return $result;
    }

    public static function getCategoryByTitle($title_cat)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM categorie WHERE titre=:ctit");
        $query->bindParam(':ctit', $title_cat, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();
        $result = null;

        if($row != null)
        {
            $result = new Category($row);
        }

        return $result;
    }


    public static function createCategory($array)
    {
        $category = new Category($array);

        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO categorie VALUES (cat.nextval, :titre, :description)");
        $query->bindParam(':titre', $category->getTitre(), PDO::PARAM_STR);
        $query->bindParam(':description', $category->getDescription(), PDO::PARAM_STR);
        $query->execute();

        return $category;
    }

    public function updateCatgeory()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("UPDATE categorie SET titre=:ctitre, description=:cdesc WHERE idcategorie=:catid");
            $query->bindParam(':ctitre', $this->_titre, PDO::PARAM_STR);
            $query->bindParam(':cdesc', $this->_description, PDO::PARAM_STR);
            $query->bindParam(':catid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public function deleteCatgeory()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("DELETE FROM categorie WHERE idcategorie=:catid");
            $query->bindParam(':catid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }
}