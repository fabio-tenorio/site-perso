<?php
require 'Autoloader.php';

use App\Autoloader;

Autoloader::register();

session_start();

try
{
  $bdd =new PDO('mysql:host=localhost;dbname=forum', 'root', ''); 
  $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
  catch(PDOException $e) 
  {
    die('Erreur : ' . $e->getMessage());
  }

include 'head.html';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liste des conversations d'un membre</title>
</head>

<body>

<header>
  <?php include 'header.php';?>
</header>

<main class="mainconversation"

<?php

  //var_dump($_GET);

  $getid = $_GET['id'];

  $dataquery = $bdd -> prepare("SELECT login FROM utilisateurs WHERE id='$getid'");
  $dataquery->execute();
  $result = $dataquery->fetchAll(PDO::FETCH_OBJ);
?>

<div align="center">    
    <br><h2>LISTE DES CONVERSATIONS DE <?php echo $result['0']->login; ?></h2><br>

<?php
$dataquery = $bdd -> prepare("SELECT * FROM conversations WHERE id_utilisateur='$getid'");
$dataquery->execute();
$result = $dataquery->fetchAll(PDO::FETCH_OBJ);

//var_dump($result);

/*
echo'<pre>';
print_r($result[0]->id); 
echo'</pre>';
*/

if(isset($_POST['supconv']) AND !empty($_POST['supconv']))
{
  $idconv = $_POST['supconv'];

  $dataqueryconv = $bdd -> prepare("DELETE FROM conversations WHERE id=?");
  $dataqueryconv->bindParam(1, $idconv, PDO::PARAM_INT);
  $dataqueryconv->execute();

  $dataquerymess = $bdd -> prepare("DELETE FROM messages WHERE id_conversation=?");
  $dataquerymess->bindParam(1, $idconv, PDO::PARAM_INT);
  $dataquerymess->execute();

  $dataquerylike = $bdd -> prepare("DELETE FROM likes WHERE id_conversation=?");
  $dataquerylike->bindParam(1, $idconv, PDO::PARAM_INT);
  $dataquerylike->execute();

  $dataquerydislike = $bdd -> prepare("DELETE FROM dislike WHERE id_conversation=?");
  $dataquerydislike->bindParam(1, $idconv, PDO::PARAM_INT);
  $dataquerydislike->execute();

  $erreur = "La suppression de la conversation a été pris en compte !<br>";
}
if(isset($erreur))
{
  echo '<font color="red">'.$erreur."</font>";
  unset($erreur);
  unset($_POST);
}
foreach($result as $value) 
  {
    $id = $value->id;
    
    //var_dump($result);
    //var_dump($value->id);
  
    echo 'ID de la conversation : '.$value->id;
    ?>

    <li>
    <?php
    echo 'Titre : '.$value->titre;
    ?>
    </li>
    <li>
    <?php
    echo $value->date;
    ?>
    </li>
    <form action="#" method="post">
    <input type='hidden' value='<?php echo $id?>' name='supconv'>
    <button class='supprimer-message btn btn-primary' type='submit' id='droit' 
    value='delete'>Supprimer la conversation</button>
    </form><br>

  <?php
  }
?>

</div>    
</main>

<br> 
<footer>
    <?php include 'footer.php';?>
</footer>  
  
</body>
</html>