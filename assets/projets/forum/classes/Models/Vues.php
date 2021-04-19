<?php

namespace App\classes\Models;

class Vues extends Model
{
    protected $id;
    protected $id_topic;
    protected $id_conversation;

    public function __construct()
    {
        $this->table = 'vues';
    }

    /**
     * Nombre de vues dans un topic
     *
     * @param (int) $id_topic
     * @return int
     */
    public function vuesTopic(int $id_topic)
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id_topic = $id_topic")->rowcount();
    }

    /**
     * Nombre de vue dans une conversation
     *
     * @param (int) $id_conversation
     * @return int
     */
    public function vuesConversation(int $id_conversation)
    {
        return $requete = $this->requete("SELECT *FROM $this->table WHERE id_conversation = $id_conversation")->rowcount();
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
    public function setId(int $id)
    {
        $this->id = $id;

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
    public function setId_topic(int $id_topic)
    {
        $this->id_topic = $id_topic;

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
    public function setId_conversation(int $id_conversation)
    {
        $this->id_conversation = $id_conversation;

        return $this;
    }
}

