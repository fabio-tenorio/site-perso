<?php
//     TODO afficher et créer des topics sur la page topics.php
//      créer une page topics.php
//      les topics peuvent être publics, privés ou accessibles qu'à l'admin
//          sur la bdd 'forum', créer une table 'topic' qui contient: id, titre, description, datetime, id_droit, id_utilisateur;
//          accéder à la bdd et SELECT * sur table 'topic'
//      pour l'accès public (sans connexion):
//      if $id_droit == 0 (ou !isset($_SESSION['user']) - voir conditions créee par Manu
//      pour afficher les topics selon le droit d'accès:
//           afficher les topics où id_droit <= id_utilisateur;
//      les topics peuvent être créees que par l'admin et le modérateur
//           IF $id_droit >= 100: un formulaire s'affiche pour INSERT INTO topics nouveau topic
//           ELSE (soit la personne n'est pas connecté, soit connecté comme utilisateur) le formulaire ne s'affiche pas
//           afficher et créer des conversations qui sont liées aux topics
//           les conversations peuvent Être créees par tout le monde

require 'Autoloader.php';

use App\Autoloader;
use App\classes\Models\TopicModel as TopicModel;
use App\classes\Models\Vues as Vues;

Autoloader::register();

session_start();
  
if (isset($_SESSION['user']))
{
    $topic = new TopicModel();
    $topic->selectTopics($_SESSION['user']['id']);
    
    //si le formulaire est validé, appel à la méthode pour l'insertion du topic dans la bdd
    if (isset($_POST['button_newtopic']))
    {
        $_POST['id_createur'] = $_SESSION['user']['id'];
        $newtopic = new App\classes\Models\TopicModel();
        $newtopic->insertNewTopic($_POST);
    }
}

//fonction pour afficher la description de chaque topic
function topicDesc (object $topic)
{
    echo("<td class=\"td_topic col-7\" scope='col'>");
    //afficher le titre du topic
    echo("<h3>");
    echo $topic->titre;
    // si le topic est accessible qu'au membres inscrits
    if ($topic->id_droits==1)
    {
       echo("<span class=\"spanlisttopic\"> (privé *) </span>");
    } else if ($topic->id_droits==200)
    {
        echo("<span class=\"spanlisttopic\"> (admin *) </span>");
    }
    echo("</h3>");
    //lien vers les conversations liées au topic et description du topic
    echo('<a href="conversation.php?id='.$topic->id.'">');
    echo $topic->description;
    echo('</a>');
    echo('</td>');
}

//fonction pour afficher les statistiques associées à chaque topic
function topicStat(object $topicModel, object $topic, object $vues)
{
    echo("<td class=\"td_topic col-4\" scope='col'>");
    // afficher le nombre de vues liées à chaque topic
    $vues = $vues->vuesTopic($topic->id);
    echo '<p>'.$vues;
    if ($vues <= 1)
    {
        echo (" vue </p>");
    } else
    {
        echo(" vues </p>");
    }
    // afficher le nombre de conversations liées à chaque topic
    $conv = $topicModel->selectConversations($topic->id);
    echo '<p>'.$conv;
    if ($conv<=1) {
        echo(" conversation</p>");
    } else
    {
        echo(" conversations</p>");
    }
    //afficher la date et l'heure de création de chaque topic
    echo("<p>Crée le : ");
    echo $topic->date."</p>";
    //afficher le login du créateur de chaque topic
    echo("<p>par : ");
    $createur = $topicModel->selectCreateur($topic->id_createur);
    echo($createur[0]->login."</p>");
    echo("</td>");
}

include 'head.html';
?>
<html>
    <?php include 'header.php';?>
    <body>
    <main id="maintopic">
        <table class="table" id="tabletopic">
            <tr class="tr_topic">
                <th class="th_topic col-6" scope="col">Topic</th>
                <th class="th_topic col-3" scope="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                    <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
                </svg>
                Statistiques</th>
                </tr>
                <?php
                // si la personne est connectée
                if (isset($_SESSION['user']))
                {
                    // en tant qu'utilisateur ordinaire ou modérateur
                    if ($_SESSION['user']['id_droits']>=1 and $_SESSION['user']['id_droits']<200)
                    {
                        $topic = new \App\classes\Models\TopicModel();
                        $topicPublic = $topic->selectTopics(100);
                        // var_dump($topicPublic);
                        for ($item=0;isset($topicPublic[$item]);$item++)
                        {
                            //afficher la ligne du tableau
                            echo("<tr>");
                            topicDesc($topicPublic[$item]);
                            $vue = new Vues;
                            topicStat($topic, $topicPublic[$item], $vue);
                            echo("</tr>");
                        }
                        // si la personne connectée est l'admin
                    } elseif ($_SESSION['user']['id_droits']>100)
                      {
                        $topic = new \App\classes\Models\TopicModel();
                        $topicPublic = $topic->selectTopics(200);
                        for ($item=0;isset($topicPublic[$item]);$item++)
                        {
                            echo("<tr class=\"tr_topic\">");
                            topicDesc($topicPublic[$item]);
                            $vue = new Vues;
                            topicStat($topic, $topicPublic[$item], $vue);
                            echo("</tr>");
                        }
                    }
                } else
                  {
                      // si la personne n'est pas connectée
                      $topic = new \App\classes\Models\TopicModel();
                        $topicPublic = $topic->selectTopics(100);
                        for ($item=0;isset($topicPublic[$item]);$item++)
                        {
                            echo("<tr class=\"tr_topic\">");
                            // si le topic est accessible qu'au membres inscrits
                            if ($topicPublic[$item]->id_droits==1)
                            {
                                echo("<td class=\"td_topic col-7\" scope='col'>");
                                //afficher le titre du topic
                                echo("<h3>");
                                echo $topicPublic[$item]->titre;
                                echo("<span class=\"spanlisttopic\"> (privé) </span>");
                                echo("</h3>");
                                //annuler le lien vers les conversations liées au topic
                                echo('<a href="#'.$topicPublic[$item]->id.'">');
                                echo $topicPublic[$item]->description;
                                echo('</a>');
                                echo('</td>');
                            } else
                            {
                                topicDesc($topicPublic[$item]);
                            }
                            // afficher le nombre de vues liées à chaque topic
                            $vue = new Vues;
                            topicStat($topic, $topicPublic[$item], $vue);
                            echo("</tr>");
                        }
                    }
                ?>
            <tr class="tr_topic">
                <td class="td_topic" scope='col' colspan="3">
                    <ul>
                        <li class="td_footeritem">
                            privé -topic accessible aux membres inscrits
                        </li>
                        <li class="td_footeritem">
                            admin - topic accessible aux administrateurs du forum
                        </li>
                    </ul> 
                </td>
            </tr>
        </table>
            <?php
            // seules l'admin et le modérateur peuvent créer un nouveau topic
            if (isset($_SESSION['user']) && $_SESSION['user']['id_droits']>=100)
            { ?>
            <section id="newtopic">
                <h3>Démarrer un nouveau topic sur le forum</h3>
                    <form action="topic.php" method="post">
                        <div class="form-group formtopic">
                        <label for="titretopic">Le titre du topic</label>
                        <input class="form-control" type="text" id="titretopic" name="titletopic">
                        <label for="desctopic">La description topic</label>
                        <input class="form-control" type="text" id="desctopic" name="desctopic">
                        <label for="id_droits">Le niveau d'accéssibilité</label>
                        <div class="formtopicradio">
                            <div class="form-check form-check-inline topic_check">
                                <input type="radio" name="id_droits" value="0">
                                <label>public</label>
                            </div>
                            <div class="form-check form-check-inline topic_check">
                                <input type="radio" name="id_droits" value="1">
                                <label>privé</label>
                            </div>
                            <div class="form-check form-check-inline topic_check">
                                <input type="radio" name="id_droits" value="200">
                                <label>admin</label>
                            </div>
                        </div>
                        <button class='btn btn-primary' type='submit' id='button_newtopic' name='button_newtopic'>envoyer</button>
                    <?php }
                    ?>
                </div>
            </form>
        </section>
    </main>
    <?php include 'footer.php';?>
    </body>
</html>

