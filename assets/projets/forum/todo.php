<?php
// TODO implement theme du forum: langages informatiques web dev
//      la page index.php une <section> dans main qui affiche:
//           si la personne est connecté comme utilisateur:
//             liens vers les topics publics
//             liens aussi vers les topics privés
//          ELSE,
//              liens vers les topics publics
//              les topics privés pas accéssibles (bien que visibles) aux personnes non connectées
//          si la personne est connecté comme modérateur:
//              liens vers les topics publics
//              lien vers les topics privés
//           si la personne est connecté en tant qu'admin:
//              liens vers les topics publics
//                   récuperer sur la bdd l'id_droit (SELECT)
//              lien vers les topics privés
//              lien vers les topics admin
//     afficher et créer des topics sur la page topics.php
//      créer une page topics.php
//      les topics peuvent être publics, privés ou accéssibles qu'à l'admin
//          sur la bdd 'forum', créer une table 'topic' qui contient: id, titre, description, datetime, id_droit, id_utilisateur;
//          accéder à la bdd et SELECT * sur table 'topic'
//      pour l'accès public (sans connexion):
//      if $id_droit == 0 (ou !isset($_SESSION['user']) - voir conditions créee par Manu
//      pour afficher les topics selon le droit d'accès:
//           afficher les topics où id_droit <= id_utilisateur;
//     les topics peuvent être créees que par l'admin et le modérateur
//           IF $id_droit >= 100: un formulaire s'affiche pour INSERT INTO topics nouveau topic
//           ELSE (soit la personne n'est pas connecté, soit connecté comme utilisateur) le formulaire ne s'affiche pas
//           afficher et créer des conversations qui sont liées aux topics
//           les conversations peuvent Être créees par tout le monde
//     créer une page conversations.php qui affiche la liste des conversations du topic correspondant (prendre avec get['id'])
//               un tableau pour la liste des conversations où chaque ligne va afficher:
//                  le titre de la conversation;
//                  le créateur de la conversation ('id' et 'login');
//                  la date de la conversation;
//                  la date (voir plus: contenu, créateur, ...) du dernier message enregistré sur la conversation;
//                  IF $id_droit>=1: un formulaire s'affiche pour INSERT INTO conversations nouvelle conversation
//                  ELSE le formulaire ne s'affiche pas
//      afficher et créer des messages qui sont liées aux conversations
//      créer une table messages sur la bdd: id, message, datetime, like (valeur par défaut==0), dislike (par défaut=0), id_utilisateur,
//      créer une page messages.php qui:
//          affiche la liste des messages
//      les messages peuvent être ajoutés par toutes les personnes connectées
//          les utilisateurs peuvent éditer/modifier leur dernier message publié.
//      les messages peuvent être suprimmer par le modérateur et par l'admin
//      SQL DELETE msg WHERE id du messsage
//      pour chaque msg, il y aura un button visible à l'utilisateur peut signaler un abus
//      pour chaque msg, il y aura un button visible que pour les modérateurs et pour l'admin ($id_droit >= 100)
//      pour chaque msg, il y aura deux buttons (like et dislike);
//           deux méthodes:
//                IF (button=='like') +1
//                UPDATE 'like' WHERE id (du message)==X;
//                IF (button=='dislike') -1
//                UPDATE 'dislike' WHERE id (du message)==X;
//      FACULTATIF: pour chaque msg, créer un button pour répondre au message spécifique
//      créer trois types de profil utilisateur: utilisateur = 1, modérateur = 100, admin = 200
//      confirmer le password sans faire des requêtes à la bdd
//      créer sur la bdd, table 'user': id, login, email, password, date(inscription), id_droit
//      créer une page inscription.php
//            que s'affiche que pour l'utilisateur non connecté
//               si la personne est connecté, le lien vers inscription disparait et s'affiche la page profil.php
//            une fois l'inscription aboutie, rédiriger vers la page connexion.php
//      à chaque inscription, par défaut, l'id_droit == 1;
//      créer une page membres.php
//            le bouton search au header sur cette page permet de selectionner les personnes qui sont inscrites
//            IF $id_droit == 1: afficher
//               afficher un tableau avec tous les profils des utilisateurs inscrits avec:
//                (photo, login, email, date (membre depuis...), nombre de messages envoyés)
//            IF $id_droit >=200:
//               afficher aussi un checkbox pour changer les id_droits des autres utilisateurs
//
// TODO implement theme du forum: langages informatiques web dev
//      la page index.php une <section> dans main qui affiche:
//           IF la personne est connectée...
//                   récuperer sur la bdd selon l'id_droit (SELECT)
//                IF si la personne est utilisateur ordinaire, afficher:
//                   liens vers les topics publics
//                   liens aussi vers les topics privés
//                IF si la personne est modératrice, afficher:
    //               liens vers les topics publics
    //               lien vers les topics privés
        //        IF si la personne est connecté en tant qu'admin, afficher:
        //           liens vers les topics publics
        //           lien vers les topics privés
        //           lien vers les topics admin
//          ELSE,
//              liens vers les topics publics
//              les topics privés pas accéssibles (bien que visibles) aux personnes non connectées
//          
//     afficher et créer des topics sur la page topics.php
//      créer une page topics.php
//      les topics peuvent être publics, privés ou accéssibles qu'à l'admin
//          sur la bdd 'forum', créer une table 'topic' qui contient: id, titre, description, datetime, id_droit, id_utilisateur;
//          accéder à la bdd et SELECT * sur table 'topic'
//      pour l'accès public (sans connexion):
//      if $id_droit == 0 (ou !isset($_SESSION['user']) - voir conditions créee par Manu
//      pour afficher les topics selon le droit d'accès:
//           afficher les topics où id_droit <= id_utilisateur;
//     les topics peuvent être créees que par l'admin et le modérateur
//           IF $id_droit >= 100: un formulaire s'affiche pour INSERT INTO topics nouveau topic
//           ELSE (soit la personne n'est pas connecté, soit connecté comme utilisateur) le formulaire ne s'affiche pas
//           afficher et créer des conversations qui sont liées aux topics
//           les conversations peuvent Être créees par tout le monde
//     créer une page conversations.php qui affiche la liste des conversations du topic correspondant (prendre avec get['id'])
//               un tableau pour la liste des conversations où chaque ligne va afficher:
//                  le titre de la conversation;
//                  le créateur de la conversation ('id' et 'login');
//                  la date de la conversation;
//                  la date (voir plus: contenu, créateur, ...) du dernier message enregistré sur la conversation;
//                  IF $id_droit>=1: un formulaire s'affiche pour INSERT INTO conversations nouvelle conversation
//                  ELSE le formulaire ne s'affiche pas
//      afficher et créer des messages qui sont liées aux conversations
//      créer une table messages sur la bdd: id, message, datetime, like (valeur par défaut==0), dislike (par défaut=0), id_utilisateur,
//      créer une page messages.php qui:
//          affiche la liste des messages
//      les messages peuvent être ajoutés par toutes les personnes connectées
//          les utilisateurs peuvent éditer/modifier leur dernier message publié.
//      les messages peuvent être suprimmer par le modérateur et par l'admin
//      SQL DELETE msg WHERE id du messsage
//      pour chaque msg, il y aura un button visible à l'utilisateur peut signaler un abus
//      pour chaque msg, il y aura un button visible que pour les modérateurs et pour l'admin ($id_droit >= 100)
//      pour chaque msg, il y aura deux buttons (like et dislike);
//           deux méthodes:
//                IF (button=='like') +1
//                UPDATE 'like' WHERE id (du message)==X;
//                IF (button=='dislike') -1
//                UPDATE 'dislike' WHERE id (du message)==X;
//      FACULTATIF: pour chaque msg, créer un button pour répondre au message spécifique
//      créer trois types de profil utilisateur: utilisateur = 1, modérateur = 100, admin = 200
//      confirmer le password sans faire des requêtes à la bdd
//      créer sur la bdd, table 'user': id, login, email, password, date(inscription), id_droit
//      créer une page inscription.php
//            que s'affiche que pour l'utilisateur non connecté
//               si la personne est connecté, le lien vers inscription disparait et s'affiche la page profil.php
//            une fois l'inscription aboutie, rédiriger vers la page connexion.php
//      à chaque inscription, par défaut, l'id_droit == 1;
//      créer une page membres.php
//            le bouton search au header sur cette page permet de selectionner les personnes qui sont inscrites
//            IF $id_droit == 1: afficher
//               afficher un tableau avec tous les profils des utilisateurs inscrits avec:
//                (photo, login, email, date (membre depuis...), nombre de messages envoyés)
//            IF $id_droit >=200:
//               afficher aussi un checkbox pour changer les id_droits des autres utilisateurs
//
/* theme du forum: langages informatiques web dev
*      la page index.php une <section> dans main qui affiche:
*           si la personne est connecté comme utilisateur:
*              liens vers les topics publics
*              liens aussi vers les topics privés
*           ELSE,
*               liens vers les topics publics
*               les topics privés pas accéssibles (bien que visibles) aux personnes non connectées
*           si la personne est connecté comme modérateur:
*               liens vers les topics publics
*               lien vers les topics privés
*           si la personne est connecté en tant qu'admin:
*               liens vers les topics publics
*               lien vers les topics privés
*               lien vers les topics admin

* afficher et créer des topics sur la page topics.php
*      créer une page topics.php
*      les topics peuvent être publics, privés ou accéssibles qu'à l'admin
*          sur la bdd 'forum', créer une table 'topic' qui contient: id, titre, description, datetime, id_droit, id_utilisateur;
*          accéder à la bdd et SELECT * sur table 'topic'
*      pour l'accès public (sans connexion):
*      if $id_droit == 0 (ou !isset($_SESSION['user']) - voir conditions créee par Manu
*      pour afficher les topics selon le droit d'accès:
            afficher les topics où id_droit <= id_utilisateur;
*      les topics peuvent être créees que par l'admin et le modérateur
*           IF $id_droit >= 100: un formulaire s'affiche pour INSERT INTO topics nouveau topic
*           ELSE (soit la personne n'est pas connecté, soit connecté comme utilisateur) le formulaire ne s'affiche pas

* afficher et créer des conversations qui sont liées aux topics
*      les conversations peuvent Être créees par tout le monde
* créer une page conversations.php qui affiche la liste des conversations du topic correspondant (prendre avec get['id'])
*               un tableau pour la liste des conversations où chaque ligne va afficher:
*                  le titre de la conversation; table conversation
*                  le créateur de la conversation ('id' et 'login'); id table utilisateur
*                  la date de la conversation; table conversation
*                  la date (voir plus: contenu, créateur, ...) du dernier message enregistré sur la conversation; table message inner id conversation
*                  IF $id_droit>=1: un formulaire s'affiche pour INSERT INTO conversations nouvelle conversation
*                  ELSE le formulaire ne s'affiche pas

* afficher et créer des messages qui sont liées aux conversations
*      créer une table messages sur la bdd: id, message, datetime, like (valeur par défaut==0), dislike (par défaut=0), id_utilisateur,
*      créer une page messages.php qui:
*          affiche la liste des messages
*      les messages peuvent être ajoutés par toutes les personnes connectées
*          les utilisateurs peuvent éditer/modifier leur dernier message publié.
*      les messages peuvent être suprimmer par le modérateur et par l'admin
*      SQL DELETE msg WHERE id du messsage
*      pour chaque msg, il y aura un button visible à l'utilisateur peut signaler un abus
*      pour chaque msg, il y aura un button visible que pour les modérateurs et pour l'admin ($id_droit >= 100)
*      pour chaque msg, il y aura deux buttons (like et dislike);
*           deux méthodes:
*                IF (button=='like') +1
*                UPDATE 'like' WHERE id (du message)==X;
*                IF (button=='dislike') -1
*                UPDATE 'dislike' WHERE id (du message)==X;
*      FACULTATIF: pour chaque msg, créer un button pour répondre au message spécifique 

* créer trois types de profil utilisateur: utilisateur = 1, modérateur = 100, admin = 200
*      confirmer le password sans faire des requêtes à la bdd
*      créer sur la bdd, table 'user': id, login, email, password, date(inscription), id_droit
*      créer une page inscription.php
*            que s'affiche que pour l'utilisateur non connecté
*               si la personne est connecté, le lien vers inscription disparait et s'affiche la page profil.php
*            une fois l'inscription aboutie, rédiriger vers la page connexion.php
*      à chaque inscription, par défaut, l'id_droit == 1;
*      créer une page membres.php
*            le bouton search au header sur cette page permet de selectionner les personnes qui sont inscrites
*            IF $id_droit == 1: afficher
*               afficher un tableau avec tous les profils des utilisateurs inscrits avec:
                (photo, login, email, date (membre depuis...), nombre de messages envoyés)
*            IF $id_droit >=200:
*               afficher aussi un checkbox pour changer les id_droits des autres utilisateurs 
*/



?>