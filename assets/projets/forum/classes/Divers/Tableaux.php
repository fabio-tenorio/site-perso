<?php

/*
 * Convention pour faire des commentaires dans les classes
 */

namespace App\classes\Divers;

Class Tableaux
{
    public $id;
    public $login;
    public $nom;
    public $prenom;
    public $mail;
    public $date;
    public $id_droit;
    public $topic;
    public $conversation;
    public $message;
    public $like;
    public $dislike;

  /*
  public function Tableau($row, $col)
  {
      for ($i=0;$i<$row;$i++)
      {
          $infos=$col+10;
          for ($j=$col;$m<$infos;$m++)
          {
          $tableau[$i][$m]="Test";
          }
      }
      return $tableau;
  }
  */

  public function Admin()
  {

  }

  public function Membres()
  {
      
  }

} 

?>