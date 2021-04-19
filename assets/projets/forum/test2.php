<?php

session_start();

echo'bonjour';

require 'Autoloader.php';
//Appel LE FICHIER AUTOLOADER

use App\Autoloader;
//Appel la classe autoloader les classes des autres autres fichiers sans faire de require
Autoloader::register();
//Appel la fonction autoloader qui permet d'exécuter la fonction register qui pertmet la lecture des classes


// PERMET DE NE PAS APPELLER EN REQUIRE TOUTES LES CLASSES

//require_once 'Classes/Divers/Test.php';
//Appel de la classe, attention /

use App\Classes\Divers\Test;

// le use Recherche les classes dans leur namespace
// C'est une méthode 

$aaa = new Test;

// Instanciation de la classe

$aaa->Casse();

// Instanciation de la méthode

//$aaa = new Olivier\Classes\Divers\Test;

//chemin pour appeller la classe via un name space

//$aaa->Casse();

?>