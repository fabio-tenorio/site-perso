<?php
namespace App\classes\Models;

use App\classes\Db\Db;

class TopicModel extends Model
{
    protected $id;
    protected $titre;
    protected $description;
    protected $id_createur;
    protected $id_droits;
    protected $date;
    public $table;

    public function __construct()
    {
        $this->table = 'topic';
    }

    /**
     * Trouve les topic rapport à l'id_droit
     *
     * @param integer $id_droit
     * @return objet
     */
    public function selectTopics(int $id_droit)
    {
        $droit = htmlspecialchars($id_droit, ENT_QUOTES);
        return $requete = $this->requete("SELECT * FROM topic WHERE id_droits <= $droit")->fetchAll();
    }

    /**
     * Supprime un topic, ses conversations, ses vues, likes et dislikes
     *
     * @param (int) $id_topic
     * @return void
     */
    public function deleteTopic(int $id_topic)
    {
        $id_topic = htmlspecialchars($id_topic, ENT_QUOTES);
        $requete = $this->requete("DELETE FROM $this->table WHERE id = $id_topic");
        $requete = $this->requete("DELETE FROM conversations WHERE id_topic = $id_topic");
        $requete = $this->requete("DELETE FROM vues WHERE id_topic = $id_topic");
        $requete = $this-> requete("DELETE FROM likes WHERE id_topic = $id_topic");
        $requete = $this->requete("DELETE FROM dislike WHERE id_topic = $id_topic");
        header('location: topic.php');
    }

    /**
     * Recherche un utilisateur par rapport à son id
     *
     * @param (int) $id_createur
     * @return objet
     */
    public function selectCreateur($id_createur)
    {
        $createur = htmlspecialchars($id_createur, ENT_QUOTES);
        return $requete = $this->requete("SELECT login FROM utilisateurs WHERE id = $createur")->fetchAll();
    }

    /**
     * Compte le nombre de conversations dans un topic
     *
     * @param (int) $id_topic
     * @return int
     */
    public function selectConversations($id_topic)
    {
        $id_topic = htmlspecialchars($id_topic, ENT_QUOTES);
        return $requete = $this->requete("SELECT COUNT(*) FROM conversations WHERE id_topic = $id_topic")->fetchColumn();
    }

    /**
     * Crée un nouveau topic
     * 
     * @param array $topic
     * @return bool
     */
    public function insertNewTopic($topic)
    {
        // On recupere l'instance de Db
        $this->db = Db::getInstance();
        $query=$this->db->prepare("INSERT INTO topic (titre, description, id_createur, id_droits) VALUES (:titre, :description, :id_createur, :id_droits)");
        $query->bindParam(':titre', $topic['titletopic']);
        $query->bindParam(':description', $topic['desctopic']);
        $query->bindParam(':id_createur', $topic['id_createur']);
        $query->bindParam(':id_droits', $topic['id_droits']);
        return $query->execute();

    }

    /**
     * Trouve un topic par son id
     *
     * @param (int) $id
     * @return objet
     */
    public function findTopicId($id)
    {
        return $requete = $this->requete("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }
    
    /**
     * Va faire une recherche dans les messages par un mot clef $search
     *
     * @param (string) $search
     * @return objet
     */
    public function selectContent($search)
    {
        $search = htmlspecialchars($search, ENT_QUOTES);
        return $requete = $this->requete("SELECT * FROM messages WHERE message LIKE '%". $search ."%'")->fetchAll();
    }
}