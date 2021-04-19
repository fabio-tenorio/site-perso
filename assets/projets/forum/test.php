<?php

//require 'classes/Models/exNamespace.php';
require 'Autoloader.php';

// indiquer le namespace de la classe et le nom de la classe sans extension
use App\Autoloader;
use App\classes\Models\exNamespace;

//var_dump(include ('__DIR__/head.html'));

// cette méthode static
Autoloader::register();

$newex = new exNamespace;

echo ($newex->bonjour('fabio'));

?>

<?php 

/*

if(isset($_SESSION['user']['login']) AND $_SESSION['user']['id_droits'] == 200)
{ 
  //echo 'je suis dedans'; Tansformer le chemin de la base

$dataquery = $bdd -> prepare("SELECT * FROM utilisateurs INNER JOIN messages INNER JOIN conversations");
$dataquery ->execute();
$result = $dataquery -> fetchall();

  for ($i=0; $i<count($result); $i++) 
  {
    //var_dump($result[$i]);

    //echo '<br/><br/>';
    //echo 'Prénom : ', $result[$i]['login'];
    //echo '<br/><br/>';

    echo '<pre>';
    print_r($result);
    echo '</pre>';
  }
}

2 AUTRES MANIÈRES DE FAIRE des tableaux

Ancienne manière :

$array = ['toto', 'test', 'tata', [1, 2, 3]]

echo $array[0];

Via un dictionnaire :

$dic = 
[
  'user1' => 
  [
  'firstname' => 'Clément',
  'lastname' => 'Caillat'
  ],
  'user2' => 
  [
  'firstname' => 'Olivier',
  'lastname' => 'Puche',
  'objets' => ['ordinateur', 'téléphone', 'ipod']
  ]
];   

echo $dic['user2']['lastname'];
echo $dic['user1']['lastname'];

  /*foreach($results as $value) 
  {
    echo $value->login.'<br>';
    echo $value->date.'<br>';
    echo $value->like.'<br>';
    echo $value->dislike.'<br>';
    echo '<br><br>';

    //var_dump($value);
  }
  
//$dataquery = $bdd -> prepare("SELECT u.login, u.date, m.like, m.dislike FROM utilisateurs AS u INNER JOIN messages AS m ON m.id_utilisateurs = u.id");

   /*
  INUTILE ?
  for ($i=0; $i<count($result); $i++)
  {
    echo'test';
    //echo '<br/><br/>';
    //echo 'Prénom : ', $result[$i]['login'];
    //echo '<br/><br/>';
  }
  */

    /*
  while($results)
  {
  ?>
  <tr>
    <td><?php echo $results['login']; ?></td>
    <td><?php echo $results['date']; ?></td>
    <td><?php echo $results['like']; ?></td>    
    <td><a> Edit</a></td>
    <td><a>Delete</a></td>
  </tr>	
  <?php
  }

    echo '<td>'.$r->like.'</td>';
      echo '<td>'.$r->dislike.'</td>';
      echo '<td>'.$r->like.'</td>';
      echo '<td>'.$r->dislike.'</td>';
      */

       /*echo " '<td><form action='profil.php' method='get'>
        <button class=\"btn btn-primary\" type='submit' name='droit' value='id'>Modifier droits</button>
        </form></td>";*/

?>