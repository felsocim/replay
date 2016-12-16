<?php

require_once 'Kernel.php';

class User extends Kernel
{
    private $_id;
    private $_identifiant;
    private $_motdepasse;
    private $_nom;
    private $_prenom;
    private $_datedenaissance;
    private $_courriel;
    private $_dateinscription;
    private $_datederniereconnexion;
    private $_groupe;
    private $_abonnementnewsletter;
    private $_nationalite;

    public function __construct($array)
    {
        parent::__construct($array);
    }

    public function getIdutilisateur()
    {
        return $this->_id;
    }

    public function setIdutilisateur($id)
    {
        $this->_id = $id;
    }

    public function getIdentifiant()
    {
        return $this->_identifiant;
    }

    public function setIdentifiant($identifiant)
    {
        $this->_identifiant = $identifiant;
    }

    public function getMotdepasse()
    {
        return $this->_motdepasse;
    }

    public function setMotdepasse($motdepasse)
    {
        $this->_motdepasse = $motdepasse;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }

    public function getDatenaissance()
    {
        return $this->_datedenaissance;
    }

    public function setDatenaissance($datedenaissance)
    {
        $this->_datedenaissance = $datedenaissance;
    }

    public function getCourriel()
    {
        return $this->_courriel;
    }

    public function setCourriel($courriel)
    {
        $this->_courriel = $courriel;
    }

    public function getDateinscription()
    {
        return $this->_dateinscription;
    }

    public function setDateinscription($dateinscription)
    {
        $this->_dateinscription = $dateinscription;
    }

    public function getDatederniereconnexion()
    {
        return $this->_datederniereconnexion;
    }

    public function setDatederniereconnexion($datederniereconnexion)
    {
        $this->_datederniereconnexion = $datederniereconnexion;
    }

    public function getGroupe()
    {
        return $this->_groupe;
    }

    public function setGroupe($groupe)
    {
        $this->_groupe = $groupe;
    }

    public function getAbonnementnewsletter()
    {
        return $this->_abonnementnewsletter;
    }

    public function setAbonnementnewsletter($abonnementnewsletter)
    {
        $this->_abonnementnewsletter = $abonnementnewsletter;
    }

    public function getNationalite()
    {
        return $this->_nationalite;
    }

    public function setNationalite($nationalite)
    {
        $this->_nationalite = $nationalite;
    }

    public static function getUserByNickName($nickname)
    {
        $oci = self::getConnection();
        $verify = $oci->prepare("SELECT COUNT(*) FROM utilisateur WHERE identifiant=:nick");
        $verify->bindParam(":nick", $nickname, PDO::PARAM_STR);
        $verify->execute();

        if($verify->fetchColumn() == 1)
        {
            $query = $oci->prepare("SELECT * FROM utilisateur WHERE identifiant=:nick");
            $query->bindParam(":nick", $nickname, PDO::PARAM_STR);
            $query->execute();

            $user = $query->fetch();
            $result = new User($user);

            return $result;
        }
        //Error log entry
        return null;
    }

    public static function getUserById($id_user)
    {
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM utilisateur WHERE idutilisateur=:userid");
        $query->bindParam(":userid", $id_user, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch();
        $result = null;

        if($row != null)
        {
            $result = new User($row);
        }

        return $result;
    }

    public static function createUser($array)
    {
        $user = new User($array);
        $oci = self::getConnection();

        $query = $oci->prepare("INSERT INTO utilisateur VALUES (uti.nextval, :identifiant, :nom, :prenom, :motdepasse, TO_DATE(:datenaissance, 'DD/MM/YYYY'), :courriel, DEFAULT, sysdate, :grp, DEFAULT, :nationalite)");
        $query->bindParam(":identifiant", $user->_identifiant, PDO::PARAM_STR);
        $query->bindParam(":nom", $user->_nom, PDO::PARAM_STR);
        $query->bindParam(":prenom", $user->_prenom, PDO::PARAM_STR);
        $query->bindParam(":motdepasse", $user->_motdepasse, PDO::PARAM_STR);
        $query->bindParam(":datenaissance", $user->_datedenaissance, PDO::PARAM_STR);
        $query->bindParam(":courriel", $user->_courriel, PDO::PARAM_STR);
        $query->bindParam(":nationalite", $user->_nationalite, PDO::PARAM_STR);
        $query->bindParam(":grp", $user->_groupe, PDO::PARAM_STR);

        $query->execute();

        return $user;
    }

    public function updateUser()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("UPDATE utilisateur SET identifiant=:uident, nom=:unom, prenom=:uprenom, motdepasse=:umdp, datenaissance=:dns, courriel=:umail, groupe=:grp, nationalite=:unat WHERE idutilisateur=:userid");
            $query->bindParam(':uident', $this->_identifiant, PDO::PARAM_STR);
            $query->bindParam(':unom', $this->_nom, PDO::PARAM_STR);
            $query->bindParam(':uprenom', $this->_prenom, PDO::PARAM_STR);
            $query->bindParam(':umdp', $this->_motdepasse, PDO::PARAM_STR);
            $query->bindParam(':dns', $this->_datedenaissance, PDO::PARAM_STR);
            $query->bindParam(':umail', $this->_courriel, PDO::PARAM_STR);
            $query->bindParam(':unat', $this->_nationalite, PDO::PARAM_STR);
            $query->bindParam(':grp', $this->_groupe, PDO::PARAM_STR);
            $query->bindParam(':userid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public function updateNewsletter()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("UPDATE utilisateur SET abonnementnewsletter=:abo WHERE idutilisateur=:userid");
            $query->bindParam(':abo', $this->_abonnementnewsletter, PDO::PARAM_STR);
            $query->bindParam(':userid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public function updateLastConnectionDate()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("UPDATE utilisateur SET datederniereconnexion=sysdate WHERE idutilisateur=:userid");
            $query->bindParam(':userid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public function deleteUser()
    {
        if(!is_null($this->_id))
        {
            $oci = self::getConnection();

            $query = $oci->prepare("DELETE FROM utilisateur WHERE idutilisateur=:userid");
            $query->bindParam(':userid', $this->_id, PDO::PARAM_INT);
            $query->execute();
        }

        return;
    }

    public static function getAllUsers()
    {
        $result = array();
        $oci = self::getConnection();

        $query = $oci->prepare("SELECT * FROM utilisateur");
        $query->execute();

        $rows = $query->fetchAll();

        foreach ($rows as $row)
        {
            $user = new User($row);
            array_push($result, $user);
        }

        return $result;
    }
}