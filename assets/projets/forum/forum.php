<?php
session_start();

// Appel de la classe Autoloader
require 'Autoloader.php';

// Permet de ne pas nommer la classe Autoloader
use App\Autoloader;
use App\classes\Models\TopicModel;

// Autoloader 
Autoloader::register();


if (!isset($_SESSION['user'])){
    $droit_utilisateur = 0;
}
else {
    $droit_utilisateur = $_SESSION['user']['id_droits'];
}

$topic = New TopicModel();
$resultat = $topic->getTopic($droit_utilisateur);
var_dump($resultat);



/* $bdd = $bd->query('SELECT * FROM topic WHERE id_droits => 0'); */

?>