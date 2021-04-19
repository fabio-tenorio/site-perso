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
    <title>Liste des messages d'un membre</title>
</head>

<body>

<header>
  <?php include 'header.php';?>
</header>

<main class="mainliste"> 
  <table class="listemembre">
      <tr>
      <td class="listemembre1">

<?php

  //var_dump($_GET);

  $getid = $_GET['id'];

  $dataquery = $bdd -> prepare("SELECT login FROM utilisateurs WHERE id='$getid'");
  $dataquery->execute();
  $result = $dataquery->fetchAll(PDO::FETCH_OBJ);
?>

<div align="center">    
    <br><h2>LISTE DES MESSAGES DE <?php echo $result['0']->login; ?></h2><br>  

<?php
$dataquery = $bdd -> prepare("SELECT * FROM messages WHERE id_utilisateurs='$getid'");
$dataquery->execute();
$result = $dataquery->fetchAll(PDO::FETCH_OBJ);

//var_dump($result);

/*
echo'<pre>';
print_r($result[0]->id); 
echo'</pre>';
*/

if(isset($_POST['supmes']) AND !empty($_POST['supmes']))
{
  $idmess = $_POST['supmes'];

  $dataquerymess = $bdd -> prepare("DELETE FROM messages WHERE id=?");
  $dataquerymess->bindParam(1, $idmess, PDO::PARAM_INT);
  /* 
  lie une valeur au point d'interrogation, autant de 'i' que de point d'interrogation, 
  i=entier, d=décimale, s=string
  */
  $dataquerymess->execute();

  $dataquerylike = $bdd -> prepare("DELETE FROM likes WHERE id_message=?");
  $dataquerylike->bindParam(1, $idmess, PDO::PARAM_INT);
  $dataquerylike->execute();

  $dataquerydislike = $bdd -> prepare("DELETE FROM dislike WHERE id_message=?");
  $dataquerydislike->bindParam(1, $idmess, PDO::PARAM_INT);
  $dataquerydislike->execute();

  $erreur = "La suppression du message a été pris en compte !<br>";
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
  
    echo 'ID CONVERSATION du message : '.$value->id_conversation;
    ?>

    <li class="listemembres2">
    <?php
    echo 'ID du message : '.($id);
    ?> 
    </li>
    <li class="listemembres2">
    <?php
    echo $value->message;
    ?>
    </li>
    <li class="listemembres2">
    <?php
    echo $value->date;
    ?>
    </li>
    <form action="#" method="post">
    <input type='hidden' value='<?php echo $id?>' name='supmes'>
    <button class='supprimer-message btn btn-primary' type='submit' id='droit' 
    value='delete'>Supprimer le message</button>
    </form><br>

  <?php
  }
?>


    </td>
    </tr>
  </table>
</main>

<br> 
<footer>
    <?php include 'footer.php';?>
</footer>  
  
</body>
</html>