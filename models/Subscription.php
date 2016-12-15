<?php

require_once 'Kernel.php';

class Subscription extends Kernel
{
    private $_idutilisateur;
    private $_idemission;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function getIdutilisateur()
    {
        return $this->_idutilisateur;
    }

    public function setIdutilisateur($idutilisateur)
    {
        $this->_idutilisateur = $idutilisateur;
    }

    public function getIdemission()
    {
        return $this->_idemission;
    }

    public function setIdemission($idemission)
    {
        $this->_idemission = $idemission;
    }

    public static function getSubscriptionEntry($id_emission, $id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM abonnement WHERE idemission=:emissionid AND idutilisateur=:userid");
        $query->bindParam(':emissionid', $id_emission, PDO::PARAM_INT);
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch();

        $result = new Subscription($row);

        return $result;
    }

    public function removeSubscriptionEntry()
    {
        $oci = self::getConnection();

        $query = $oci->prepare("DELETE FROM abonnement WHERE idemission=:emissionid AND idutilisateur=:userid");
        $query->bindParam(':emissionid', $this->_idemission, PDO::PARAM_INT);
        $query->bindParam(':userid', $this->_idutilisateur, PDO::PARAM_INT);
        $query->execute();

        return;
    }
}