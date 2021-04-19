<?php

require 'Autoloader.php';

use App\Autoloader;
use App\classes\Models\TopicModel as TopicModel;

Autoloader::register();
session_start();

include 'head.html';
?>
<html>
<body>
<?php include 'header.php'; ?>
<main id="main_result">
    <h1>Voici le résultat de la recherche</h1>
    <ul id="ul_result">
<?php
if (isset($_POST['recherche']))
{
    $search = new TopicModel;
    $result = $search->selectContent($_POST['search']);
    if ($result!=Null)
    {
        foreach($result as $key => $value)
        {
            echo("<li class=\"li_result\">");
            echo ("<p>\"".$result[$key]->message."\"</p>");
            echo("<p>publié le : ".$result[$key]->date."</p>");
            echo("</li>");
        }
    } else
    {
        echo "<li class=\"li_result\">Désolé. Il n'y a aucun message associé à cette recherche</li>";
    }
}
?>
    </ul>
</main>
<?php include 'footer.php'; ?>
</body>
</html>