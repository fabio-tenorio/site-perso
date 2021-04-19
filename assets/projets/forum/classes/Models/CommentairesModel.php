<?php
namespace App\Classes\Models;

class CommentairesModel extends Model
{
    public $id;
    public $commentaire;
    public $id_utilisateur;
    public $id_message;
    public $date;

    public function __construct()
    {
        $this->table = 'commentaires';
    }

    /**
     * Compte le nombre de commentaires d'un message
     *
     * @param (int) $id id du message
     * @return (int) nombres de commentaires
     */
    public function findCount($id): int
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_message = $id")->rowCount();       

    }

    /**
     * Trouve les commentaires d'un message et les infos utilisateurs
     *
     * @param (int) $id id du message
     * @return objet
     */
    public function findCommentaires($id)
    {
        return $requete = $this->requete("SELECT 
            $this->table.id AS id_commentaire,
            $this->table.commentaire,
            $this->table.id_utilisateur,
            $this->table.id_message,
            $this->table.date,
            utilisateurs.id,
            utilisateurs.login
        FROM $this->table 
        INNER JOIN utilisateurs
        ON $this->table.id_utilisateur = utilisateurs.id   
        WHERE id_message = $id") ->fetchAll();
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
     * Get the value of message
     */ 
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        
        return $this;
    }

    /**
     * Get the value of id_message
     */ 
    public function getId_message()
    {
        return $this->id_message;
    }

    /**
     * Set the value of id_message
     *
     * @return  self
     */ 
    public function setId_message($id_message)
    {
        $this->id_message = $id_message;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}