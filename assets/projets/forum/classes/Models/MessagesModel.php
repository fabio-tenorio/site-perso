<?php
namespace App\Classes\Models;

class MessagesModel extends Model 
{
    protected $id;
    protected $message;
    protected $id_conversation;
    protected $id_topic;
    protected $id_utilisateurs;
    protected $like;
    protected $dislike;
    protected $date;

    public function __construct()
    {
        $this->table = 'messages';
    }

    /**
     * Trouve les message d'une conversation et va chercher les messages par rapport à la pagination
     *
     * @param (int) $id_conversation 
     * @param (int) $premier Calcul du 1er article de la page
     * @param (int) $parPage Nombre de messages par page
     * @return objet
     */
    public function findByConversation($id_conversation, $premier, $parPage)
    {
        return $requete = $this->requete("SELECT
            $this->table.id, 
            $this->table.message,
            $this->table.id_conversation,
            $this->table.id_utilisateurs,
            $this->table.like,
            $this->table.dislike,
            $this->table.date,
            utilisateurs.id AS id_user,
            utilisateurs.login
        FROM $this->table
        INNER JOIN utilisateurs
        ON $this->table.id_utilisateurs = utilisateurs.id
        
        WHERE id_conversation = $id_conversation  ORDER BY date LIMIT $premier, $parPage")->fetchAll();
    }

    /**
     * Compte le nombre de messages d'une conversation
     *
     * @param (int) $id
     * @return (int) Nombre de messages
     */
    public function messagesCount($id)
    {
        return $query = $this->requete('SELECT * FROM '.$this->table.' WHERE id_conversation = '.$id)->rowcount(); 
          
    }

    /**
     * Donne le dernier message d'une conversation avec les infos utilisateur
     *
     * @param (int) $id_conversation
     * @return objet
     */
    public function getMessages($id_conversation)
    {   
        return $requete = $this->requete("
        SELECT  $this->table.date,
                $this->table.id_utilisateurs,
                $this->table.id_conversation,
                utilisateurs.id,
                utilisateurs.login
        FROM $this->table
        INNER JOIN utilisateurs
        ON utilisateurs.id = $this->table.id_utilisateurs 
        WHERE $this->table.id_conversation = $id_conversation
        ORDER BY $this->table.date DESC")->fetch();
    }

    /**
     * Retourne le dernier message d'une conversation
     *
     * @param (int) $id_conversation
     * @return objet
     */
    public function findMessageText($id_conversation)
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_conversation = $id_conversation ORDER BY date DESC")->fetch();
    }

    /**
     * Compte le nombre de messages d'une conversation
     *
     * @param (int) $id
     * @return (int) $nb_messages
     */
    public function countMessages($id_conversation)
    {
        return $requete = $this->requete("SELECT  COUNT(*) AS nb_messages FROM messages WHERE id_conversation = $id_conversation")->fetch();
    }

    /**
     * Supprime un message, ses likes et dislikes
     *
     * @param (int) $id_message
     * @return void
     */
    public function deleteMessage($id_message)
    {
        $requete = $this->requete("DELETE FROM $this->table WHERE id = $id_message");
        $requete = $this-> requete("DELETE FROM likes WHERE id_message = $id_message");
        $requete = $this->requete("DELETE FROM dislike WHERE id_message = $id_message");
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of id_utilisateurs
     */ 
    public function getId_utilisateurs()
    {
        return $this->id_utilisateurs;
    }

    /**
     * Set the value of id_utilisateurs
     *
     * @return  self
     */ 
    public function setId_utilisateurs($id_utilisateurs)
    {
        $this->id_utilisateurs = $id_utilisateurs;

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
     * Get the value of like
     */ 
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set the value of like
     *
     * @return  self
     */ 
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get the value of dislike
     */ 
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set the value of dislike
     *
     * @return  self
     */ 
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

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
