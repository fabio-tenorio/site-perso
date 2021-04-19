<?php
namespace App\Classes\Models;

class Likes extends Model
{
    protected $id;
    protected $id_utilisateur;
    protected $id_message;
    protected $id_conversation;
    protected $id_topic;

    public function __construct()
    {
        $this->table = 'likes';
    }

    /**
     * Compte le nombre de likes d'un message
     *
     * @param (int) $id_message
     * @return int nombre de likes
     */
    public function likeMessage($id_message): int
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_message = $id_message")->rowcount();
    }

    /**
     * Compte le nombre de likes d'une conversation
     *
     * @param (int) $id_conversation
     * @return int nombre de likes
     */
    public function likeConversation($id_conversation): int
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_conversation = $id_conversation")->rowcount();
    }

    /**
     * Compte le nombre de likes d'un utisateur dans un message
     *
     * @param (int) $id_utilisateur
     * @param (int) $id_message
     * @return (int) Nombre de dislikes d'un utilisateur dans un message
     */
    public function like($id_utilisateur, $id_message): int
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_utilisateur = $id_utilisateur AND id_message = $id_message")->rowcount();
    }

     /**
     * Supprime le like d'un utilisateur dans un message
     *
     * @param (int) $id_utilisateur
     * @param (int) $id_message
     * @return void
     */
    public function deleteLike($id_utilisateur, $id_message): void
    {
        $requete = $this->requete("DELETE FROM $this->table WHERE id_utilisateur = $id_utilisateur AND id_message = $id_message");
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
     * Get the value of id_conversation
     */ 
    public function getId_conversation()
    {
        return $this->id_conversation;
    }

    /**
     * Set the value of id_conversation
     *
     * @return  self
     */ 
    public function setId_conversation($id_conversation)
    {
        $this->id_conversation = $id_conversation;

        return $this;
    }

    /**
     * Get the value of id_topic
     */ 
    public function getId_topic()
    {
        return $this->id_topic;
    }

    /**
     * Set the value of id_topic
     *
     * @return  self
     */ 
    public function setId_topic($id_topic)
    {
        $this->id_topic = $id_topic;

        return $this;
    }
}

