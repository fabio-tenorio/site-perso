<?php
namespace App\classes\Models;

use App\classes\Db\Db;

class Model extends Db
{

    // Table de la base de données
    public $table;

    // Instance de Db
    public $db;


    /**
     * Méthode qui exécutera les requêtes
     * @param string $sql Requête SQL à exécuter
     * @param array $attributes Attributs à ajouter à la requête 
     * @return PDOStatement|false 
     */
    public function requete(string $sql, array $attributs = null)
    {
        // On recupere l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si il y a des attributs
        if ($attributs !== null) {
            // Requete préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }
        else {
            // Requête simple
            return $this->db->query($sql);

        }
    }

    /**
     * Sélection d'un enregistrement suivant son id
     * 
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id)
    {
        return $query = $this->requete('SELECT * FROM '.$this->table.' WHERE id = '.$id)->fetch(); 
          
    }

    /**
     * Sélection de tous les enregistrements d'une table
     * 
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' .$this->table);
        return $query->fetchAll();
    }

    /**
     * Sélection de plusieurs enregistrements suivant un tableau de critères
     * 
     * @param array $criteres Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $critères)
    {
        $champs = [];
        $valeurs = [];

        foreach ($critères as $champ => $valeur) 
        {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }   
            // On transfrome le $champs  en chaine de caractère avec AND si il y a d'autre infos 
            $chaine_champs = implode(' AND ', $champs);

            // On execute la requete
            return $this->requete('SELECT * FROM ' .$this->table. ' WHERE ' .$chaine_champs, $valeurs)->fetchall();       
    }
    
    /**
     * Insertion d'un enregistrement suivant un tableau de données
     * 
     * @param Model $model Objet à créer
     * @return bool
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach ($this as $champ => $valeur) 
        {
            if ($champ !== 'id' AND $champ !== 'email' AND $champ !== 'date' AND  $champ !== 'table' AND $champ !== 'db' AND $champ != 'like' AND $champ != 'dislike') {
                $champs[] = $champ ;
                $inter[] = '?';
                $valeurs[] = $valeur;
            }    
                 
        }  
            
        // On transfrome le $champs et $valeurs  en chaine de caractère avec ',' si il y a d'autre infos 
        $chaine_champs = implode(', ', $champs);
        $chaine_inter = implode(', ', $inter);
        
            
        // On execute la requete
        return $this->requete('INSERT INTO ' .$this->table. ' (' .$chaine_champs. ') VALUES ('.$chaine_inter.')', $valeurs);    
    }

    /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     * 
     * @param int $id id de l'enregistrement à modifier
     * @param Model $model Objet à modifier
     * @return bool
     */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        foreach ($this as $champ => $valeur) 
        {
            if ($champ !== 'id' AND $champ !== 'date' AND $champ !== 'table' AND $champ !== 'db' AND $valeur !== null) {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }         
        }  
        $valeurs[] = $this->id;
        // On transfrome le $champs et $valeurs  en chaine de caractère avec ',' si il y a d'autre infos 
        $chaine_champs = implode(', ', $champs);
        
        // On execute la requete
        return $this->requete('UPDATE '.$this->table.' SET '. $chaine_champs.' WHERE id = ?', $valeurs);       
    }

    public function delete($id)
    {
        return $this->requete("DELETE FROM  $this->table  WHERE id = ?", [$id] );
    }

    /**
     * Hydratation des données
     * @param array $donnees Tableau associatif des données
     * @return self Retourne l'objet hydraté
     */
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value){
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            
            // Si le setter correspondant existe.
            if (method_exists($this, $method)){
                // On appelle le setter.
                $this->$method($value);
            }
        }
        return $this;
    } 

    /**
     * Enregistre les variables de $_SESSION['user'] 
     *
     * @return void
     */
    public function setSession()
    {
        $_SESSION['user'] = [
        'login'=> $this->login,
        'nom' => $this->nom,
        'prenom' => $this->prenom,
        'id' =>  $this->id,
        'id_droits' => $this->id_droits,
        'mail' => $this->mail
        ];          
    }  
}

