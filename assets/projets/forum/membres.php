<?php
require 'Autoloader.php';

use App\Autoloader;

Autoloader::register();

session_start();

/*
echo '<pre>';
print_r ($_SESSION);
echo '</pre>';
*/

try
{
  $dsn = 'mysql:host=localhost:3306;dbname=fabio-tenorio-de-carvalho_forum';
  $dbuser = 'fabio-tenorio';
  $dbpassword = 't84ehC0^';
  $bdd =new PDO($dsn, $dbuser, $dbpassword); //Activation des erreurs PDO
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  //Fetch par défaut : FETCH_ASSOC / _OBJ / _BOTH
  $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
  catch(PDOException $e) 
  {
    die('Erreur : ' . $e->getMessage());
  }

//var_dump($bdd)

include 'head.html';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liste des Membres</title>
</head>

<body>

<header>
  <?php include 'header.php';?>
</header>

<main class="testmembre"> 
  <div align="center">    
    <br><h2>LISTE DES MEMBRES</h2><br>
  </div>     

<?php

/*
var_dump($_SESSION['user']);
echo '<br><br>';
var_dump($_SESSION['user']['login']);
*/

if(isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 200 
OR $_SESSION['user']['id_droits'] == 100 OR $_SESSION['user']['id_droits'] == 1)
{

//echo '<br><br>'; 
//echo 'C'EST BON!';
  
$dataqueryuser = $bdd -> prepare("SELECT login, date, id_droits, id FROM utilisateurs");
$dataqueryuser->execute();
$results = $dataqueryuser->fetchAll(PDO::FETCH_OBJ);

/*
echo '<br><br>';
var_dump($dataqueryuser);
echo '<br></br>';
echo '<pre>';
print_r($results[0]->id);
echo '</pre>';
*/

} 
?>

  <table class="membres">
    <tr class="membres1">
      <th>Login</th>
      <th>Inscript depuis</th>
      <th>Conversations</th>
      <th>Messages</th>
      <th>Likes</th>
      <th>Dislike</th>

    <?php 
    if (isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 100 
    OR $_SESSION['user']['id_droits'] == 200)
    {
    ?>
      <th>Liste de Conversations</th>
      <th>Liste des Messages</th>
     <?php
      if (isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 200)
      {
    ?> 
      <th>Modifications des droits du membre</th>

    <?php
      }
    }
    ?>
    </tr>

    <?php
    foreach($results as $value) 
    {
      $id = $value->id;

      $dataqueryconv = $bdd -> prepare("SELECT titre FROM conversations 
      WHERE id_utilisateur='$id'");
      $dataqueryconv->execute();
      $results0 = $dataqueryconv->rowCount();

      $dataquerymess = $bdd -> prepare("SELECT message FROM messages 
      WHERE id_utilisateurs='$id'");
      $dataquerymess->execute();
      $results1 = $dataquerymess->rowCount();

      //echo '<pre>';
      //var_dump($results1);

      $dataquerylike = $bdd -> prepare("SELECT SUM(messages.like) AS 'likes' FROM messages 
      WHERE id_utilisateurs='$id'");
      $dataquerylike->execute();
      $results2 = $dataquerylike->fetchAll(PDO::FETCH_ASSOC);

      $dataquerynblike = $bdd -> query("SELECT * FROM likes WHERE id_utilisateur = $id")->rowCount();
      $likes = $dataquerynblike;

      //echo '<pre>';
      //var_dump($results2);

      $dataquerydislike = $bdd -> prepare("SELECT SUM(messages.dislike) AS 'dislikes' FROM messages 
      WHERE id_utilisateurs='$id'");
      $dataquerydislike->execute();
      $results4 = $dataquerydislike->fetchAll(PDO::FETCH_ASSOC);

      $dataquerynbdislike = $bdd -> query("SELECT * FROM dislike WHERE id_utilisateur = $id")->rowCount();
      $dislikes = $dataquerynbdislike;

      //var_dump($datquerydislike);
      ?>
      
      <td class="membres2">
      
      <?php

      echo '<tr>';
      echo '<td>'.$value->login.'</td>';
      echo '<td>'.$value->date.'</td>';
      echo '<td>'.$results0.'</td>';
      echo '<td>'.$results1.'</td>';
      echo '<td>'.$likes.'</td>';
      echo '<td>'.$dislikes.'</td>';

      if (isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 100 
        OR $_SESSION['user']['id_droits'] == 200)
      {
    ?>
          <td>
            <form action="listeconversation.php? <?php echo $value->id?>" method="get">
            <input type="hidden" name="id" value="<?php echo $value->id;?>">
            <button class="btn btn-primary" type="submit">Conv. du membre</button>
            </form>
          </td>
          <td>
            <form action="listes.php? <?php echo $value->id?>" method="get">
            <input type="hidden" name="id" value="<?php echo $value->id;?>">
            <button class="btn btn-primary" type="submit">Mes. du membre</button>
            </form>
          </td>

          <?php
          
          $id = $value->id;

          //var_dump($value);
          /*echo'<pre>';
          print_r($_POST);
          echo'</pre>';*/

        if(isset($_POST['id_droits'.$value->id]))
        {
          $iddroit = $_POST['id_droits'.$value->id];

          $dataqueryiddroit = $bdd -> prepare("UPDATE utilisateurs SET id_droits= $iddroit WHERE id= $id");
          $dataqueryiddroit-> execute();

          //var_dump($id);
          //var_dump($dataqueryiddroit);

          $erreur = "Le changement de droit a été pris en compte !";
        }
        if(isset($erreur))
        {
          echo '<font color="red">'.$erreur."</font>";
          unset($erreur);
          unset($_POST);
        }
        if(isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 200)
        {
          ?>    
          <td class="formdroits"><form action="#" method="post">
            <div class="form-check form-check-inline">
              <input type="radio" name="id_droits<?php echo $value->id;?>" value="1" 
              <?php if($value->id_droits == 1){ echo 'checked';}?>>
              <label>Memb.</label>
                                  
              <?php
              //var_dump($value->id_droits);
              ?>

            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="id_droits<?php echo $value->id?>" value="100" 
              <?php if($value->id_droits == 100){ echo 'checked';}?>>
              <label>Modér.</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="id_droits<?php echo $value->id?>" value="200" 
              <?php if($value->id_droits == 200){ echo 'checked';}?>>
              <label>Admin.</label>
            </div>
            <button class='btn btn-primary' type='submit' id='droit' name='droit
            <?php echo $value->id?>'>Modifier</button>
          </form></td>
        </td>  
        <?php
        }
          echo '<tr>';
      } 
        echo '<tr>';
    }
    ?>

  </table>
  </main>
  
  <footer>
    <?php include 'footer.php';?>
  </footer>  
  
  </body>
  </html>