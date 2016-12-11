<?php

require_once 'Kernel.php';

class Video extends Kernel
{
    private $_idvideo;
    private $_emission;
    private $_titre;
    private $_description;
    private $_duree;
    private $_datepremiere;
    private $_origine;
    private $_datevalidite;
    private $_nbrvisionnages;
    private $_embed;

    public function getIdvideo()
    {
        return $this->_idvideo;
    }

    public function setIdvideo($idvideo)
    {
        $this->_idvideo = $idvideo;
    }

    public function getEmission()
    {
        return $this->_emission;
    }

    public function setEmission($emission)
    {
        $this->_emission = $emission;
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

    public function getDuree()
    {
        return $this->_duree;
    }

    public function setDuree($duree)
    {
        $this->_duree = $duree;
    }

    public function getDatepremiere()
    {
        return $this->_datepremiere;
    }

    public function setDatepremiere($datepremiere)
    {
        $this->_datepremiere = $datepremiere;
    }

    public function getOrigine()
    {
        return $this->_origine;
    }

    public function setOrigine($origine)
    {
        $this->_origine = $origine;
    }

    public function getDatevalidite()
    {
        return $this->_datevalidite;
    }

    public function setDatevalidite($datevalidite)
    {
        $this->_datevalidite = $datevalidite;
    }

    public function getNbrvisionnages()
    {
        return $this->_nbrvisionnages;
    }

    public function setNbrvisionnages($nbrvisionnages)
    {
        $this->_nbrvisionnages = $nbrvisionnages;
    }

    public function getEmbed()
    {
        return $this->_embed;
    }

    public function setEmbed($embed)
    {
        $this->_embed = $embed;
    }

    public static function getAllVideos()
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT v.*, e.titre as emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission");
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function getVideosByCategory($id_cat)
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT v.*, e.titre as emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE e.idcategorie=:catid");
        $query->bindParam(':catid', $id_cat, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function getVideoById($id_video)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM video WHERE idvideo=:videoid");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();

        $result = new Video($row);

        return $result;
    }

    public static function getAllEpisodesByVideo($id_video)
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM video WHERE idvideo IN (SELECT idvideo FROM episode WHERE idemission IN (SELECT idemission FROM video WHERE idvideo=:videoid)) AND idvideo!=:videoid");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }
}