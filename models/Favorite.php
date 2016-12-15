<?php

require_once 'Kernel.php';

class Favorite extends Kernel
{
    private $_idvideo;
    private $_idutilisateur;

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

    public static function getFavoriteEntry($id_video, $id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM favoris WHERE idvideo=:videoid AND idutilisateur=:userid");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch();

        $result = new Favorite($row);

        return $result;
    }

    public function removeFavoriteEntry()
    {
        $oci = self::getConnection();

        $query = $oci->prepare("DELETE FROM favoris WHERE idvideo=:videoid AND idutilisateur=:userid");
        $query->bindParam(':videoid', $this->_idvideo, PDO::PARAM_INT);
        $query->bindParam(':userid', $this->_idutilisateur, PDO::PARAM_INT);
        $query->execute();

        return;
    }
}