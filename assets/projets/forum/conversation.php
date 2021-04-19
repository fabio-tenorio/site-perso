<?php
session_start();


// requière le fichier Autoloader
require 'Autoloader.php';

require_once 'function/dates.php';

// Permet de ne pas nommer les namespaces devant les classes
use App\Autoloader;
use App\classes\Models\ConversationModel;
use App\classes\Models\Dislike;
use App\classes\Models\Likes;
use App\classes\Models\MessagesModel;
use App\classes\Models\TopicModel;
use App\classes\Models\Vues;

// Fonction register de la classe Autoloader 
Autoloader::register();

//Instancie la classe ConversationModel et TopicModel
$conversation = new ConversationModel();
$topics = new TopicModel();

// Suppression du topic si bouton enclenché
if (isset($_POST['supprimer_topic'])) {
    $topics->deleteTopic($_GET['id']);
}

                /* Si $_POST['titre'] existe on crée une nouvelle conversation et un message associé */
if (isset($_POST['titre'])) {
    $conversations = new ConversationModel();
    // On hydrate l'objet $conv
    $conversations->setTitre($_POST['titre'])
        ->setId_utilisateur($_SESSION['user']['id'])
        ->setId_message(0)
        ->setId_topic($_GET['id']);
       
    // On créé la conversation grace à l'objet que l'on vient d'hydrater
    $conversations->create();

    // On recherche en BDD la conversation par rapport à son titre
    $trouve_id = $conversations->findByTitre($_POST['titre']);
    
    // On insert le message en base de donnée
    $messages = new MessagesModel();
    $messages->setId_conversation($trouve_id->id)
        ->setMessage($_POST['message'])
        ->setId_utilisateurs($_SESSION['user']['id'])
        ->setId_topic($_GET['id']);

    $messages->create();

    $dernier_message = new MessagesModel();
    $dernier_message = $dernier_message->findMessageText($trouve_id->id);

    /* Update de id_message dans la table conversation */
    $incremente_id_message = new ConversationModel();
    $incremente_id_message->setId($trouve_id->id)
        ->setId_message($dernier_message->id)
        ->setTitre($_POST['titre'])
        ->setId_topic($_GET['id'])
        ->setId_utilisateur($_SESSION['user']['id'])
        ;

    $incremente_id_message->update();
}

include 'head.html';
?>
<header>
    <?php include 'header.php'; ?>
</header>
<main class="main_conversation">
    <?php
    // Recupère la table topics pour insérer le titre <h1>
    $topics = new TopicModel();
    $recup_titre = $topics->findTopicId($_GET['id']);
    ?>
    <section class="conversation_forum"></section>
        <!-- Titre -->
        <h1 class="h1_titre_topic"><?=$recup_titre->titre?></h1>
        <section class="container">
            <?php  
            // Methode qui permet retourner un tableau des conversations
            $conversations = $conversation->getConversation($_GET['id']); 
            ?>         
              <section class="container_entete_conversations row mr-2 ml-auto">            
                <section class="description_conversations col-6 ml-2 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>    
                Conversations
                </section>    
                <section class="statistiques_conversations col-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line mb-2" viewBox="0 0 16 16"><path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/></svg>
                Statistiques
                </section>
                <section class="ecritpar_conversations col-3 mr-auto ml-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots mb-1" viewBox="0 0 16 16"><path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/></svg>
                Derniers messages
                </section>
            </section>  
            <?php
                      /* Boucle pour afficher les conversations */      
            foreach ($conversations as  $conversationn){                     
                ?><a href="messages.php?id=<?=$_GET['id']?>&id_conversation=<?php echo $conversationn->id_conversation?>">
                <section class="container_conversations row  mr-2 ml-auto">
                    <section class=" conversation_conversations col-6 ml-2 ">
                        <p><?= $conversationn->titre . '</p>
                        <i>Crée par </i><span class="span_login_conversations">'.$conversationn->login. '</span>
                        <br><span class="span_depuis_conversation"> Il y a ' .depuis($conversationn->date_conversations). '</span>';                      
                        ?>
                    </section>
                    <section class="statistique_conversations col-2">   
                        <?php 
                        // Nombre de messages
                        $messages_count = new MessagesModel();
                        echo $messages_count->messagesCount($conversationn->id_conversation).' message';if ($messages_count->messagesCount($conversationn->id_conversation)>= 2):echo 's';endif;echo '<br>';
                        // Nombre de vues
                        $vues = new Vues();
                        echo $vues->vuesConversation($conversationn->id_conversation).' vue';if ($vues->vuesConversation($conversationn->id_conversation ) >= 2): echo 's'; endif; echo '<br>';
                        // Nombre de likes
                        $likes = new Likes();
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill text-primary mb-1 " viewBox="0 0 16 16"><path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.964.22.817.533 2.512.062 4.51a9.84 9.84 0 0 1 .443-.05c.713-.065 1.669-.072 2.516.21.518.173.994.68 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.162 3.162 0 0 1-.488.9c.054.153.076.313.076.465 0 .306-.089.626-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.826 4.826 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.616.849-.231 1.574-.786 2.132-1.41.56-.626.914-1.279 1.039-1.638.199-.575.356-1.54.428-2.59z"/></svg>
                        <?=$likes->likeConversation($conversationn->id_conversation);
                        // Nombre de dislikes
                        $dislikes = new Dislike();
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill text-danger ml-4" viewBox="0 0 16 16"><path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/></svg> 
                        <?=$dislikes->dislikeConversation($conversationn->id_conversation);?>

                        

                    </section>
                    <section class="dernier_message_conversations col-3 ml-auto mr-auto ">
                        <?php                    
                        $messages = $conversation->getMessages($conversationn->id_conversation);                 
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-text mb-1" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/><path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/></svg>
                        Par <span class="span_login_conversations">'.$messages->login.'</span> <br>
                        <span class="span_depuis_conversation">Il y a '.depuis($messages->date). '</span>';
                        ?>
                    </section>
                </section></a>   
                <?php
            }        
            ?>
        </section> 
    </section>
    <section class="liste_topic_conversation">
        <a href="topic.php?">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short mb-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/></svg>
        Topics</a>
    </section> 
    <section class="supprimer_topic">
        <?php
        if(isset($_SESSION['user']['id_droits']) AND $_SESSION['user']['id_droits'] >= 100){
            ?>
            <form action="" method="post">
                <button name="supprimer_topic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle mb-1 text-white" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    Topic
                </button>
            </form><?php
            
        }
        ?>
    </section>
    <section class="ajouter_conversation">
            <?php
                        /* Formulaire d'ajout d'une conversation et  d'un message  */
        if (isset($_SESSION['user'])) {
            ?><h2>Ajouter une conversation</h2>
            <form class=" formulaire_conversation form-group" action="" method=post>
                <div>
                    <label for="titre">Titre de la conversation</label>
                </div>
                <div>
                    <input type="text" name="titre" id="titre" required>
                </div>
                <div>
                    <textarea name="message"  cols="30" rows="10"  placeholder="Ecrivez un message" required></textarea>
                </div>
                <div>
                    <input class="" type="submit" value="Créer une conversation" name="Creer">
                </div>
            </form>
            <?php
        }
        ?>          
    </section>        
</main>
<?php
require 'footer.php';
?>