<?php

namespace App\classes\Models;

class UtilisateursModel extends Model
{
    protected $id;
    protected $login;
    protected $nom;
    protected $prenom;
    protected $mail;
    protected $password;
    protected $id_droits;
    protected $date;

    public function __construct()
    {
        $this->table = 'utilisateurs';
    }
    
    /**
     * Récupérer un user à partir de son login
     * @param string $login 
     * @return mixed 
     */
    public function login($login)
    {  
        $login = htmlspecialchars($login, ENT_QUOTES);
        return $this->requete("SELECT * FROM $this->table WHERE login = ?", [$login])->fetch();       
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getMail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of id_droits
     */ 
    public function getId_droits()
    {
        return $this->id_droits;
    }

    /**
     * Set the value of id_droits
     *
     * @return  self
     */ 
    public function setId_droits($id_droits)
    {
        $this->id_droits = $id_droits;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    static function deconnexion()
    {
    session_destroy();
    /* Redirige vers la page d'accueil */
    header("Location:index.php");
    }
}
