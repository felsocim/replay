<?php

require_once 'Kernel.php';

class Programme extends Kernel
{
    private $_id;
    private $_idcategorie;
    private $_categorie;
    private $_titre;
    private $_description;
    private $_chaine;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function getIdemission()
    {
        return $this->_id;
    }

    public function setIdemission($id)
    {
        $this->_id = $id;
    }

    public function getIdcategorie()
    {
        return $this->_idcategorie;
    }

    public function setIdcategorie($idcategorie)
    {
        $this->_idcategorie = $idcategorie;
    }

    public function getCategorie()
    {
        return $this->_categorie;
    }

    public function setCategorie($categorie)
    {
        $this->_categorie = $categorie;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function getChaine()
    {
        return $this->_chaine;
    }

    public function setChaine($chaine)
    {
        $this->_chaine = $chaine;
    }

    public static function getAllProgrammes()
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT e.*, c.titre AS categorie FROM emission e LEFT JOIN categorie c ON e.idcategorie=c.idcategorie");
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $programme = new Programme($row);
            array_push($result, $programme);
        }

        return $result;
    }

    public static function getProgrammeById($id_emission)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT e.*, c.titre AS categorie FROM emission e LEFT JOIN categorie c ON e.idcategorie=c.idcategorie WHERE e.idemission=:emid");
        $query->bindParam(':emid', $id_emission, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $result = null;

        if($row != null)
        {
            $result = new Programme($row);
        }

        return $result;
    }

    public static function getProgrammeByTitle($title_emission)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT e.*, c.titre AS categorie FROM emission e LEFT JOIN categorie c ON e.idcategorie=c.idcategorie WHERE e.titre=:emitit");
        $query->bindParam(':emitit', $title_emission, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();
        $result = null;

        if($row != null)
        {
            $result = new Programme($row);
        }

        return $result;
    }

    public static function createProgramme($array)
    {
        $programme = new Programme($array);

        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO emission VALUES (emi.nextval, :catid, :titre, :description, :chaine)");
        $query->bindParam(':catid', $programme->getIdcategorie(), PDO::PARAM_INT);
        $query->bindParam(':titre', $programme->getTitre(), PDO::PARAM_STR);
        $query->bindParam(':description', $programme->getDescription(), PDO::PARAM_STR);
        $query->bindParam(':chaine', $programme->getChaine(), PDO::PARAM_STR);
        $query->execute();

        return $programme;
    }

    public function updateProgramme()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("UPDATE emission SET idcategorie=:catid, titre=:etitre, description=:edesc, chaine=:echaine WHERE idemission=:emid");
            $query->bindParam(':catid', $this->_idcategorie, PDO::PARAM_INT);
            $query->bindParam(':etitre', $this->_titre, PDO::PARAM_STR);
            $query->bindParam(':edesc', $this->_description, PDO::PARAM_STR);
            $query->bindParam(':echaine', $this->_chaine, PDO::PARAM_STR);
            $query->bindParam(':emid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public function deleteProgramme()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("DELETE FROM emission WHERE idemission=:emid");
            $query->bindParam(':emid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public static function setProgrammeSubscribed($id_user, $id_emission)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO abonnement VALUES (:userid, :emissionid)");
        $query->bindParam(':userid', $id_user);
        $query->bindParam(':emissionid', $id_emission);
        $query->execute();

        return;
    }

    public static function getSubscriptionsByUserId($id_user)
    {
        $oci = self::getConnection();
        $result = array();

        $query = $oci->prepare("SELECT * FROM emission WHERE idemission IN (SELECT idemission FROM abonnement WHERE idutilisateur=:userid)");
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $programme = new Programme($row);
            array_push($result, $programme);
        }

        return $result;
    }
}