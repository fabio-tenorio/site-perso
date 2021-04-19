<?php
namespace App\classes\Models;

class ConversationModel extends Model
{
    protected $id;
    protected $titre;
    protected $id_topic;
    protected $id_message;
    protected $id_utilisateur;
    protected $date; 

    public function __construct()
    {
        $this->table = 'conversations';
    }

    /**
     * Trouve les conversations d'un topic avec infos utilisateurs, messages. Classer par date du dernier message
     *
     * @param (int) $id_topic
     * @return objet
     */
    public function getConversation($id_topic)
    {       
        return $requete = $this->requete("
        SELECT $this->table.date AS date_conversations,
               $this->table.titre, 
               $this->table.id_topic, 
               $this->table.id_utilisateur,
               $this->table.id AS id_conversation,
               $this->table.id_message,
               utilisateurs.id, 
               utilisateurs.login, 
               messages.id,
               messages.date  
        FROM $this->table
        INNER JOIN utilisateurs 
        ON $this->table.id_utilisateur = utilisateurs.id
        INNER JOIN messages
        ON $this->table.id_message = messages.id
        
        WHERE $this->table.id_topic = $id_topic
        ORDER BY date DESC ")->fetchAll();
    }

    /**
     * Trouve le dernier message d'un conversation classé par date du message
     *
     * @param [type] $id_conversation
     * @return objet
     */
    public function getMessages($id_conversation)
    {
        return $requete = $this->requete("
        SELECT  messages.date,
                messages.id_utilisateurs,
                messages.id_conversation,
                utilisateurs.id,
                utilisateurs.login
        FROM utilisateurs
        INNER JOIN messages
        ON utilisateurs.id = messages.id_utilisateurs 
        WHERE messages.id_conversation = $id_conversation
        ORDER BY messages.date DESC")->fetch();
    }

    /**
     * Trouve une conversation par rapport à son titre
     *
     * @param (string) $titre
     * @return objet
     */
    public function findByTitre($titre)
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE titre = ? ", [$titre])->fetch();
    }

    /**
     * Supprime une conversation, ses messages, ses vues, ses likes et dislikes
     *
     * @param (int) $id_conversation
     * @return void
     */
    public function deleteConversation($id_conversation): void
    {
        $requete = $this->requete("DELETE FROM $this->table WHERE id = $id_conversation");
        $requete = $this->requete("DELETE FROM messages WHERE id_conversation = $id_conversation");
        $requete = $this->requete("DELETE FROM vues WHERE id_conversation = $id_conversation");
        $requete = $this-> requete("DELETE FROM likes WHERE id_conversation = $id_conversation");
        $requete = $this->requete("DELETE FROM dislike WHERE id_conversation = $id_conversation");
    }

    /**
     * Enregistre dans la conversation un nouveau dernier message
     *
     * @param (int) $id_message id du message a enregistrer dans conversation
     * @param (int) $id_conversation id de la conversation a modifier
     * @return void
     */
    public function updateMessage($id_message, $id_conversation)
    {
        return $this->requete("UPDATE $this->table SET id_message = $id_message WHERE id = $id_conversation");
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
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

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
}