<?php
// session_start();
// require 'Autoloader.php';

// use App\Autoloader;


// Autoloader::register();
use App\classes\Models\UtilisateursModel;

if (isset($_POST['deconnexion']))
{
    UtilisateursModel::deconnexion();
}
//echo ("variable session: ");
//var_dump($_SESSION);
//if (isset($user))
//{
//    echo ("variable user :");
//    var_dump($user);
//}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light row">
        <div class="col row">
            <a class="navbar-brand" id="icon" href="index.php">agora</a>
            <div id="user">
            <?php if (isset($_SESSION) and $_SESSION!=Null)
            {
            $user = $_SESSION;
            ?> <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
            <?php echo ("<span id='loginname'>".$user['user']['login']."</span>");?>
                <form action="" method="post">
                    <button class="btn btn-primary" type="submit" name="deconnexion" value="deconnexion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </form>
            </div>
        </div>
        <div class="col-10 row rightsidenav">
            <a href="https://fr.wikipedia.org/wiki/Agora#:~:text=Un%20article%20de%20Wikip%C3%A9dia%2C%20l'encyclop%C3%A9die%20libre." target="_blank">sur l'agora</a>
            <a href="topic.php">les topics du forum</a>
            <?php
            // créer une condition pour l'affichage des liens selon les differents profils:
                // administrateur: id_droit=200
                // modérateur: id_droit=100
                // user: id_droit=1
            // si la personne n'est pas connectée
            if (isset($user))
            { $login=$user['user']['login'];
            // si la personne est connectée comme utilisateur ordinaire ou comme modérateur
            if ($user['user']['id_droits']==1 || $user['user']['id_droits']==100)
            {?>
            <a href="membres.php">membres</a>
            <a href="profil.php">mon profil</a>
            <?php }
            // si la personne est connectée en tant qu'admin
            if ($user['user']['id_droits'] == 200)
            {?>
            <a href="membres.php">membres</a>
            <a href="profil.php">mon profil</a>
            <?php } ?>
            <a href="https://laplateforme.io/" target="_blank">qui sommes-nous</a>
            <?php }
            } else
            {
                ?>
        </div>
        <div class="col-10 row rightsidenav">
            <a href="#">sur l'agora</a>
            <a href="topic.php">les topics du forum</a>
            <a href="inscription.php">s'inscrire</a>
            <a href="connexion.php">se connecter</a>
        <?php
            }?>
            <form action="recherche_result.php" method="POST" id="searchbar" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="rechercher un contenu" aria-label="rechercher">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="recherche" value="recherche"><img src="images/search.svg" alt="#"></button>
            </form>
        </div>
    </nav>
</header>