<?php

Class ClasseForum 
{
    public $id;
    public $titre;
    public $description;
    public $date;
    public $id_droit;

    private function connectdb($db)
    {
        /*
        *  Récupérer la classe créée par Manu qui doit s'exécuter en automatique et faire tous les contrôles
        */
    }

    /*public function __construct($tab)
    {
        $tab['id']=$this->id;
        $tab['titre']=$this->titre;
        $tab['description']=$this->description;
        $tab['date']=$this->date;
        $tab['id_droit']=$this->id_droit;
  
    }

    /* Si l'id_droit est mis en privé, utiliser ces 2 fonctions

    * public function getIdDroit() 
    {
        return $this->_id_droit;
    }

    public function setIdDroit($id_droit) 
    {
        $this->_id_utilisateur=$id_droit;
    }
    */
   
    public function register($tab)
    {
    if (!isset($_SESSION["user"])) 
        {
        header('Location: connexion.php');
        }
        if(isset($_SESSION["id_droit"])==200)
        {
            $bdd=$this->connectdb('forum');
            // insert into ('titre', 'description') VALUE ('PHP', 'php c'est de la merde')
            $sqltopic = "INSERT INTO topic ('id', 'titre', 'description', 'date', 'id_droit') VALUES ($id, $titre, $description, $date, $id_droit)";
            $exec=$bdd->prepare($sqltopic);
            $id=$tab['id'];
            $titre=$tab['titre'];
            $description=$tab['description'];
            $date=$tab['date'];
            $id_droit=$tab['id_droit'];
            $result=$exec->execute(['id'=>$id, 'titre'=>$titre, 'description'=>$description, 'date'=>$date, 'id_droit'=>$id_droit,]); 
            $this->msg = "La création du topic a été enregistrée";
        }    

    }    

    public function update() 
    {
        $db = 'SELECT * FROM utilisateur';
    }

    public function delete()
    {

    }

    public function archive()
    {

    }

}

/*__________________________________________________________________________________________________________________*/

Class Conversation
{
    public $idtopic;
    public $id;
    public $titre;
    public $description;
    public $date;
    public $message;
    public $iduser;
    public $id_droit;


    public function register()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function archive()
    {

    }

}

/*__________________________________________________________________________________________________________________*/

class Message
{
    public $idconversation;
    public $id;
    public $titre;
    public $description;
    public $date;
    public $like;
    public $dislike;
    public $reponse;
    public $iduser;
    public $id_droit;

    public function register()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function archive()
    {

    }

}

/*__________________________________________________________________________________________________________________*/

 Class Divers
 {

    public function filtre()
    {

    }

 }

?>