<?php

require_once 'Kernel.php';

class History extends Kernel
{
    private $_idvideo;
    private $_idutilisateur;
    private $_datevisionnage;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function getIdvideo()
    {
        return $this->_idvideo;
    }

    public function setIdvideo($idvideo)
    {
        $this->_idvideo = $idvideo;
    }

    public function getIdutilisateur()
    {
        return $this->_idutilisateur;
    }

    public function setIdutilisateur($idutilisateur)
    {
        $this->_idutilisateur = $idutilisateur;
    }

    public function getDatevisionnage()
    {
        return $this->_datevisionnage;
    }

    public function setDatevisionnage($datevisionnage)
    {
        $this->_datevisionnage = $datevisionnage;
    }

    public static function getHistoryEntry($id_video, $id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM historique WHERE idvideo=:videoid AND idutilisateur=:userid");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch();

        $result = new History($row);

        return $result;
    }

    public static function addHistoryEntry($id_video, $id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO historique VALUES (:userid, :videoid, DEFAULT)");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        return;
    }

    public function removeHistoryEntry()
    {
        $oci = self::getConnection();

        $query = $oci->prepare("DELETE FROM historique WHERE idvideo=:videoid AND idutilisateur=:userid");
        $query->bindParam(':videoid', $this->_idvideo, PDO::PARAM_INT);
        $query->bindParam(':userid', $this->_idutilisateur, PDO::PARAM_INT);
        $query->execute();

        return;
    }
}