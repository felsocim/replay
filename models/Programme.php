<?php

require_once 'Kernel.php';

class Programme extends Kernel
{
    private $_id;
    private $_idcategorie;
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