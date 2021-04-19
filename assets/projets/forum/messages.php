<?php
session_start();

// Requière le dossier Autoloader
require 'Autoloader.php';

// Permet de ne pas ecrire le namespace devant les classes
use App\Autoloader;
use App\classes\Models\CommentairesModel;
use App\classes\Models\ConversationModel;
use App\classes\Models\MessagesModel;
use App\classes\Models\Dislike;
use App\classes\Models\Likes;
use App\classes\Models\Vues;

// Méthode register de la classe Autoloader qui permet de ne pas appeler les classes
Autoloader::register();



// SUPPRESSION de la CONVERSATION si bouton enclenché
if (isset($_POST['supprimer_conversation'])) {
    $supprime = new ConversationModel();
    $supprime->deleteConversation($_GET['id_conversation']);
    header('location: conversation.php?id='.$_GET['id']);
    exit;
}

// Permet d'incrémenter les VUES
$vues = new Vues();
$vues->setId_topic($_GET['id'])
    ->setId_conversation($_GET['id_conversation']);
$vues->create();


                    /* Si le formulaire de CREATION 'nouveau MESSAGE' est validé */
if (isset($_POST['message'])) {
    // On créer en base de donnée le nouveau message
    $create_messages = new MessagesModel();
    $create_messages->setId_conversation($_GET['id_conversation'])
        ->setMessage($_POST['message'])
        ->setId_utilisateurs($_SESSION['user']['id'])
        ->setLike(0)
        ->setDislike(0)
        ->setId_topic($_GET['id']);
    $create_messages->create();

    // On recherche le dernier message créer pour rechercher l'id
    $message_id = $create_messages->findMessageText($_GET['id_conversation']);

    // On insert dans conversation id_message du dernier message enregistré
    $conversation = new ConversationModel();
    $conversation->setId($_GET['id_conversation'])
        ->setId_message($message_id->id);
    $conversation->update();
}

                            /* On va créer la pagination */
// On détermine sur quelle page on se trouve
if(isset($_GET['start']) AND !empty($_GET['start'])){
    $currentPage = (int) strip_tags($_GET['start']);
}else{
    $currentPage = 1;
}

// On instancie la classe et l'on recherche le nombre de message dans la conversation
$nb_message = new MessagesModel();
$nb_messages = $nb_message->countMessages($_GET['id_conversation']);
$nb_message = (int) $nb_messages->nb_messages;

// On détermine le nombre d'articles par page
$parPage = 5;

// On calcule le nombre de pages total
$pages = ceil($nb_message / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

// On va chercher les messages suivant la conversation en prenent en compte le $_GET['start'] pour la pagination
$message = new MessagesModel();
$messages = $message->findByConversation($_GET['id_conversation'], $premier, $parPage);

include 'head.html';
?>

<html>

<?php include 'header.php'; ?>
<main class="main_messages">
    <?php
    $titres = new ConversationModel();
    $titre = $titres->find($_GET['id_conversation']);
    ?>
    <h1 class="titre_messages"><?= $titre->titre ?></h1>

                        <!-- Début de la GROSSE BOUCLE  -->
    <?php
    foreach ($messages as $message) {
        
        // Si le bouton ajout de commentaire est valider on hydrate l'objet et l'on crée la nouvelle conversation
        if (isset($_POST['envoi' . $message->id])) {
            $conversation = new CommentairesModel();
            $conversation->setCommentaire($_POST['new_commentaire'])
                ->setId_utilisateur($_SESSION['user']['id'])
                ->setId_message($message->id);
            $conversation->create();
        }

        // Supprime le message si bouton enclenché
        if (isset($_POST['supprimer_message'.$message->id ])) {
            $supprime = new MessagesModel();
            $create = new ConversationModel();
            $supprime->deleteMessage($message->id);
            $supprime = $supprime->findMessageText($_GET['id_conversation']);
            $create->updateMessage($supprime->id, $_GET['id_conversation']);
            $message_supprimer= $message->id;
        }
       

        // Si la valeur unset est presente on la supprime
        if (isset($_POST['unset' . $message->id])) {
            unset($_POST['unset' . $message->id]);
        }

        $likes = new Likes();
        $dislikes = new Dislike();
                            /* Systeme des likes */
        if (isset($_POST['like' . $message->id])) {
            // On vérifie qu'il n'y a pas pour cette utilisateur un dislike
            $dislike = $dislikes->disLike($_SESSION['user']['id'], $message->id);

            if ($dislike === 0) {
                // Si il n'y en a pas on vérifie qu'il n'y a pas de like
                $like = $likes->like($_SESSION['user']['id'], $message->id);

                if ($like === 0) {
                    // Si il n'y en a pas on enregistre le like dans la table like
                    $likes->setId_utilisateur($_SESSION['user']['id'])
                        ->setId_message($message->id)
                        ->setId_conversation($_GET['id_conversation'])
                        ->setId_topic($_GET['id']);
                    $likes->create();
                } else {
                    // Si il y en a un on le supprime
                    $like = $likes->deletelike($_SESSION['user']['id'], $message->id);
                }
            } else {
                // Si il y a un dislike on le supprime
                $dislike = $dislikes->deleteDislike($_SESSION['user']['id'], $message->id);
                // On créé le like
                $likes->setId_utilisateur($_SESSION['user']['id'])
                    ->setId_message($message->id)
                    ->setId_conversation($_GET['id_conversation'])
                    ->setId_topic($_GET['id']);
                $likes->create();
            }
        }

        /* Système des dislikes */
        if (isset($_POST['dislike' . $message->id])) {
            // On vérifie qu'il n'y est pas pour cette utilisateur un like
            $like = $likes->Like($_SESSION['user']['id'], $message->id);

            if ($like === 0) {
                // Si il n'y en a pas on vérifie qu'il n'y a pas de dislike
                $dislike = $dislikes->disLike($_SESSION['user']['id'], $message->id);

                if ($dislike === 0) {
                    // Si il n'y en a pas on enregistre le dislike dans la table like
                    $dislikes->setId_utilisateur($_SESSION['user']['id'])
                        ->setId_message($message->id)
                        ->setId_conversation($_GET['id_conversation'])
                        ->setId_topic($_GET['id']);
                    $dislikes->create();
                } else {
                    $dislike = $dislikes->deleteDislike($_SESSION['user']['id'], $message->id);
                }
            } else {
                // Si il y a un like on le supprime
                $like = $likes->deletelike($_SESSION['user']['id'], $message->id);
                // On créé le dislike
                $dislikes->setId_utilisateur($_SESSION['user']['id'])
                    ->setId_message($message->id)
                    ->setId_conversation($_GET['id_conversation'])
                    ->setId_topic($_GET['id']);
                $dislikes->create();
            }
        }
        ?> 
          
        <section class="commentaires_article"> <?php 
        if (isset($message_supprimer)){
            if ($message->id == $message_supprimer) {
            echo '<p class="message_valide_supprimer btn btn-danger btn-center justify-center">Ce message à bien été supprimer</p>';          
            }
        }
            ?>

            <!-- Ancre -->
            <div id="<?= $message->id ?>"></div>
            <!-- Messages avec login date  --> 
            <section>
                <section class="identite_messages">
                    <span><?= $message->login ?></span><br>
                    <p>Il y a <?php require_once'function/dates.php';
                     echo depuis($message->date);?></p>
                </section>
                <section class="message_messages">
                    <p><?= $message->message ?></p>
                </section>
            </section>
            <section class="affichage_messages">
                <!-- Affichage du nombre de likes et dislikes -->
                <section class="affichage_doigts_messages">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill text-primary " viewBox="0 0 16 16"><path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.964.22.817.533 2.512.062 4.51a9.84 9.84 0 0 1 .443-.05c.713-.065 1.669-.072 2.516.21.518.173.994.68 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.162 3.162 0 0 1-.488.9c.054.153.076.313.076.465 0 .306-.089.626-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.826 4.826 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.616.849-.231 1.574-.786 2.132-1.41.56-.626.914-1.279 1.039-1.638.199-.575.356-1.54.428-2.59z"/></svg> 
                    <span><?= $likes->likeMessage($message->id) ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill text-danger" viewBox="0 0 16 16"><path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/></svg> 
                    <span><?= $dislikes->dislikeMessage($message->id) ?></span>
                </section>
                <!-- Boutton de suppression du message -->
                <section class="supprimer_message_centre">
                    <?php
                    $commentaire = new CommentairesModel();
                    $commentaire_count = $commentaire->findCount($message->id);
                    if (isset($_SESSION['user']['id_droits']) AND $_SESSION['user']['id_droits'] >= 100 AND $commentaire_count != 0 AND $nb_message != 1) {
                        
                        ?>
                        <form action="" method="post">
                            <button name="supprimer_message<?= $message->id ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle mb-1 text-danger" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                                Message
                            </button>
                        </form><?php
                    }
                    ?>            
                </section>
                <!-- Affichage du nombres de commentaires si existes sinon afficher supprimer pour modo-->
                <?php
                $commentaire = new CommentairesModel();
                $commentaire_count = $commentaire->findCount($message->id);
                if ($commentaire_count !== 0) { ?>
                    <section class="affichage_commentaires_messages">
                        <form action="#<?= $message->id ?>" method="post"><?php
                            if ($commentaire_count === 1) { ?>
                                <button name="commentaire<?= $message->id ?>" value="commentaire">1 commentaire</button>
                            <?php
                            }
                            if ($commentaire_count > 1) { ?>
                                <button name="commentaire<?= $message->id ?>" value="commentaire"><?= $commentaire_count ?> commentaires</button>
                            <?php
                            }
                            ?>
                        </form>
                    </section>
                <?php
                }
                else {?>
                    <!-- Boutton de suppression du message -->
                    <section class="supprimer_message_droite">
                        <?php
                        if (isset($_SESSION['user']['id_droits']) AND $_SESSION['user']['id_droits'] >= 100 AND $nb_message != 1) {
                            ?>
                            <form action="" method="post">
                                <button name="supprimer_message<?= $message->id ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle mb-1 text-danger" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                                Message</button>
                            </form><?php
                        }
                        ?>            
                    </section>
                    <?php
                }
                ?>
                
            </section>
            <section class="actions_messages">
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                
                <!--  Pouces qui servent à valider un formulaire pour incrémenter en BDD les likes et dislikes -->
                <section class="pouces_increment_messages">
                    <form action="#<?= $message->id ?>" method="post">
                        <?php
                        if ($likes->like($_SESSION['user']['id'], $message->id) !== 0) { ?>
                            <section class="pouce_like_validate">
                                <button value=1 name="like<?= $message->id ?>">
                                    Like <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up mb-1 text-white " viewBox="0 0 16 16"><path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/></svg>
                                </button>
                            </section>
                        <?php
                        } else { ?>
                            <section class="pouce_like_novalidate">
                                <button value=1 name="like<?= $message->id ?>">
                                    Like <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up mb-1" viewBox="0 0 16 16"><path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/></svg>
                                </button>
                            </section>
                        <?php
                        }
                        ?>
                    </form>
                </section>                   
                <!-- Bouton qui va servir à AFFICHER LE FORMULAIRE pour pouvoir commenter le message  -->
                <section class="commenter_action_messages">
                    <?php
                     if (!isset($_POST['unset' . $message->id])) {
                        ?>
                        <form action="#<?= $message->id ?>" method="post">
                            <button name="commenter<?= $message->id ?>" value="commenter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/></svg>
                                Commenter
                            </button>
                        </form>
                        <?php
                        }
                        ?>
                </section>      
                <section class="pouces_increment_messages">
                <form action="#<?= $message->id ?>" method="post">
                    <?php
                        if ($dislikes->disLike($_SESSION['user']['id'], $message->id) !== 0) { ?>
                            <section class="pouce_dislike_validate">
                                <button value=1 name="dislike<?= $message->id ?>">
                                    Dislike <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down text-white" viewBox="0 0 16 16"><path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/></svg>
                                </button>
                            </section>
                        <?php
                        } else { ?>
                            <section class="pouce_dislike_novalidate">
                                <button value=1 name="dislike<?= $message->id ?>">
                                Dislike <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16"><path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/></svg>
                                </button>
                            </section>
                        <?php
                        }
                        ?>
                    </form>
                </section>
                <?php
                }
                ?>
            </section>
            <section class="affiche_commentaires_messages">
                <!-- Bouton qui va servir à faire disparaitre le les commentaires -->
                <section class="hidden_messages">
                    <?php
                    if (isset($_POST['commenter' . $message->id]) or isset($_POST['commentaire' . $message->id])) {
                    ?>
                        <form action="#<?= $message->id ?>" method="post">
                            <button name="unset<?= $message->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/></svg>
                            </button>
                        </form>
                    <?php
                    }
                    ?>
                </section> 
                <section class="visual_commentaires_messages">   
                    <?php
                    /*Si le bouton commenter ou commentaire est activer apparait le formulaire d'ajout de commentaire */
                    if (isset($_POST['commenter' . $message->id]) or isset($_POST['commentaire' . $message->id])) { ?>                      
                        <?php
                        if ($commentaire_count != 0) {
                            $commentaires = $commentaire->findCommentaires($message->id);
                            foreach ($commentaires as $commentaire) {?>
                                <!-- Balise pour le bouton commenter -->
                                <div id=<?= $commentaire->id_commentaire?>></div>

                                <!-- Visualisation du commentaire et les infos log et date -->
                                <section class="com_messages">
                                    <?php
                                    echo '<span>' . $commentaire->login . '</span><i class="com_messages_i">Il y a ' .depuis($commentaire->date). '</i><br>';
                                    echo $commentaire->commentaire;                       
                                    ?>
                                </section>
                                    <?php
                            }
                           
                        } ?>         
                        <section class="creer_commentaire_messages">
                            <form action="#<?= $message->id ?>" method="post">
                                <div>
                                    <textarea name="new_commentaire" value="new_commentaire" cols="30" rows="1" placeholder="Ecrivez un message....." required></textarea>
                                </div>
                                <div>
                                    <input type="submit" name="envoi<?= $message->id ?>" value="envoyer">
                                </div>
                            </form>
                        </section>
                    <?php
                    }
                    ?>
                </section>   
            </section>
        </section>
            <?php
            } 
            ?>       
        <section class="pagination_messages">
            <?php
            if ($currentPage != 1) {
                echo '<a href="messages.php?id='.$_GET['id'].'&id_conversation='.$_GET['id_conversation'].'&start='.($currentPage-1).'">Précédant</a>'; 
            } 
            
            for($i=1;$i<=$pages;$i++) {
                
                
                if($i == $currentPage) {
                    echo $i.' ';
                } else {
                    echo '<a href="messages.php?id='.$_GET['id'].'&id_conversation='.$_GET['id_conversation'].'&start='.$i.'">'.$i.'</a> ';
                }
            }
            
            if ($currentPage < $pages) {
                echo '<a href="messages.php?id='.$_GET['id'].'&id_conversation='.$_GET['id_conversation'].'&start='.($currentPage+1).'">Suivant</a>';
            }
            ?>
        </section>
        <section class="liste_conversations_messages">
            <a href="conversation.php?id=<?=$_GET['id']?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short mb-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/></svg>
            Conversations</a>
        </section>
        <section class="supprimer_conversation">
            <?php

            // Si un admin ou un modérateur est connecter apparait le bouton pour supprimer la conversation
            if(isset($_SESSION['user']['id_droits']) AND $_SESSION['user']['id_droits'] >= 100){
                ?>
                <form action="" method="post">
                    <button name="supprimer_conversation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle mb-1 text-white" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                        Conversation
                    </button>
                </form><?php              
            }
            ?>
        </section>
        <?php
        if (isset($_SESSION['user'])) {
            ?>
        <h2>Ajouter un message</h2>
        <section class="formulaire_messages">
            <form action="" method=post>
                <textarea name="message" cols="30" rows="10" placeholder="Ecrivez un message" required></textarea>
                </div>
                <div>
                    <input type="submit" value="Envoyer votre message" name="Creer">
                </div>
            </form>
        </section>
        <?php
       
    }
        
       