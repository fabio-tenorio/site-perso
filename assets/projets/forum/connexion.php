<?php
// On débute la session
session_start();

// Appel de l'Autoloader
require 'Autoloader.php';

// Recherche les classes dans leur namespace
use App\Autoloader;
use App\classes\Models\UtilisateursModel; 
 
// Autoloader permettant d'appeler les classes automatiquement sans faire de require
Autoloader::register();

/* Vérification que login et password ont été renseignés */
if (isset($_POST['login']) AND isset($_POST['password'])) 
{   
    // On instancie la classe UtilisateursModel
    $bd = new UtilisateursModel();

    // Requete demandant à la base de donnée si login à une correspondance
    $data = $bd->login($_POST['login']);
    
    if(!empty($data) AND password_verify($_POST['password'], $data->password)){
        // Si $data n'est pas vide, bingo: correspondance trouvée
        // Si password_verify() fonctionne alors mot de passe ok
        
        // On hydrate l'objet $user grace à $data
        $user = $bd->hydrate($data);
        // On insère alors les variables de session grace à setSession()
        $user->setSession();
    }
    else {
            $message = "Mot de passe ou login incorrect";
    }   
}
// echo("<pre>");
// print_r($_SESSION);
// echo("</pre>");
// inclure le head.html de la page
include 'head.html';
?>
<body>
<header>
    <?php require('header.php') ?>
</header>
<main class="main_connexion bg-img">
        <section class=connexion>        
            <h1>Connexion</h1>        
            <section>
                <form action="" method="post">
                    <div class="erreur">
                        <p>
                        <?php
                            if (isset($message)) 
                            {
                                echo $message;
                            }
                        ?>
                        </p>  
                    <div>            
                        <label for="login">Login</label><br>
                        <input type="text" name="login" id="login" required>
                    </div>
                    <div>
                        <label for="pass">Mot de passe</label><br>
                        <input type="password" id="pass" name="password" minlength="4" required>
                    </div>
                    <div class=bouton>
                        <input type="submit" name="envoyer" value="Se connecter">
                    </div>
                </form>
            </section>
        </section>
    </main>
  <?php include('footer.php')?>
</body>
</html>