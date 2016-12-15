<?php

require_once 'Kernel.php';

class Video extends Kernel
{
    private $_idvideo;
    private $_idemission;
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

    public function getIdemission()
    {
        return $this->_idemission;
    }

    public function setIdemission($idemission)
    {
        $this->_idemission = $idemission;
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

        $query = $oci->prepare("SELECT v.*, e.titre as emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idvideo=:videoid");
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

    public static function getFavoritesByUser($id_user)
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idvideo IN (SELECT idvideo FROM favoris WHERE idutilisateur=:userid)");
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function getRecentProgrammeEpisodesByUser($id_user, $limit)
    {
        $result = array();
        $oci = self::getConnection();

        if($limit > 0)
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idvideo IN (SELECT p.idvideo FROM episode p, abonnement a WHERE p.idemission=a.idemission AND a.idutilisateur=:userid) AND v.idvideo NOT IN (SELECT idvideo FROM historique WHERE idutilisateur=:userid) AND rownum <= :lim ORDER BY v.datepremiere DESC");
            $query->bindParam(':lim', $limit, PDO::PARAM_INT);
        }
        else
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idvideo IN (SELECT p.idvideo FROM episode p, abonnement a WHERE p.idemission=a.idemission AND a.idutilisateur=:userid) AND v.idvideo NOT IN (SELECT idvideo FROM historique WHERE idutilisateur=:userid) ORDER BY v.datepremiere DESC");
        }

        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function getSuggestionsByUser($id_user, $limit)
    {
        $result = array();
        $oci = self::getConnection();

        if($limit > 0)
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idemission IN (SELECT idemission FROM emission WHERE idcategorie IN (SELECT idcategorie FROM preference WHERE idutilisateur=:userid)) AND rownum <= :lim ORDER BY v.nbrvisionnages DESC");
            $query->bindParam(':lim', $limit, PDO::PARAM_INT);
        }
        else
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission WHERE v.idemission IN (SELECT idemission FROM emission WHERE idcategorie IN (SELECT idcategorie FROM preference WHERE idutilisateur=:userid)) ORDER BY v.nbrvisionnages DESC");
        }

        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function getHistoryByUser($id_user, $limit)
    {
        $oci = self::getConnection();
        $result = array();

        if($limit > 0)
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission INNER JOIN historique h ON v.idvideo=h.idvideo WHERE h.idutilisateur=:userid AND rownum <= :lim ORDER BY h.datevisionnage DESC");
            $query->bindParam(':lim', $limit, PDO::PARAM_INT);
        }
        else
        {
            $query = $oci->prepare("SELECT v.*, e.titre AS emission FROM video v LEFT JOIN emission e ON v.idemission=e.idemission INNER JOIN historique h ON v.idvideo=h.idvideo WHERE h.idutilisateur=:userid ORDER BY h.datevisionnage DESC");
        }

        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $video = new Video($row);
            array_push($result, $video);
        }

        return $result;
    }

    public static function setVideoFavorite($id_video, $id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO favoris VALUES (:userid, :videoid)");
        $query->bindParam(':videoid', $id_video, PDO::PARAM_INT);
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->execute();

        return;
    }

    public function isFavorite($id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT COUNT(*) FROM favoris WHERE idutilisateur=:userid AND idvideo=:videoid");
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->bindParam(':videoid', $this->_idvideo, PDO::PARAM_INT);
        $query->execute();

        if($query->fetchColumn() == 1)
        {
            return true;
        }

        return false;
    }

    public function isSubscribed($id_user, $id_emission)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT COUNT(*) FROM abonnement WHERE idutilisateur=:userid AND idemission=:emissionid");
        $query->bindParam(':userid', $id_user, PDO::PARAM_INT);
        $query->bindParam(':emissionid', $id_emission, PDO::PARAM_INT);
        $query->execute();

        if($query->fetchColumn() == 1)
        {
            return true;
        }

        return false;
    }
}