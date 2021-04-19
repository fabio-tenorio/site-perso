<?php
//        IF si la personne est connecté en tant qu'admin, afficher:
        //           liens vers les topics publics
        //           lien vers les topics privés
        //           lien vers les topics admin
//          ELSE,
//              liens vers les topics publics
//              les topics privés pas accéssibles (bien que visibles) aux personnes non connectées

session_start();
// Appel de l'Autoloader
require 'Autoloader.php';

// Recherche les classes dans leur namespace
use App\Autoloader;
use App\classes\Models\UtilisateursModel;
use App\classes\Models\TopicModel;
use App\classes\Models\Vues as Vues;

// Autoloader permettant d'appeler les classes automatiquement sans faire de require
Autoloader::register();
include 'head.html';
//var_dump($_SESSION);

//fonction pour afficher les plusieurs données sur les topics
function listTopics(object $topic)
{
    $listTopics = new TopicModel();
    // selectionner les topics selon leur id_droits
    switch($topic['id_droits']) {
        case 0:
            return $listTopics->selectTopics(0);
        break;
        case 1:
            return $listTopics->selectTopics(1);
        break;
        case 100:
            return $listTopics->selectTopics(100);
        break;
        case 200:
            return $listTopics->selectTopics(200);
        break;
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

?>
<body id="indexbody">
    <?php include 'header.php'; ?>
    <main id="indexmain">
        <section id="indexsection1">
        <h1>agora</h1>
        <h2>forum de discussions sur HTML5, CSS3 et PHP</h2>
        <p>Dans la Grèce antique, l’agora (du grec ἀγορά) a d’abord désigné
            la réunion de l’ensemble du peuple ou du Conseil d’une cité pour
            l’exercice de leurs droits politiques, avant de désigner la place
            publique qui porte le même nom. L’agora, espace public de
            rassemblement social, politique et mercantile de la cité, est avant
            tout le marché, en même temps que le rendez-vous où l’on se promène,
            où l’on apprend les nouvelles, où se forment les courants d’opinion.
            C'est une composante essentielle du concept de polis, notion qu'Aristote
            développe dans sa Politique, affirmant : « Celui qui est sans cité est,
            par nature et non par hasard, un être ou dégradé ou supérieur à l'homme. »
            Dans l'Athènes antique, la majorité des institutions politiques
            (Bouleutérion, Héliée...) avaient leur siège sur l'agora.
            On y trouvait également des bâtiments religieux, des monuments en
            l'honneur des héros de la patrie athénienne et nombre de commerces,
            les capéloï. Enfin, de nombreuses écoles philosophiques s'étaient
            implantées sur l'agora, à l'image de l'école du Portique de Zénon
            de Cition. Une résurgence moderne en est le Speakers' Corner de Hyde
            Park à Londres et l'occupation de places par différentes manifestations.
            C'est également un terme utilisé dans l'architecture et l'urbanisme
            dans les villes modernes. Le forum en est plus ou moins l'équivalent
            romain. Ces deux termes ont aussi connu un grand succès en tant que
            métaphore, notamment sur Internet avec les forums de discussion</p>
        </section>
        <section id="indexsection2">
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
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>