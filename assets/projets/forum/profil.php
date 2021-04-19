<?php
session_start();

// Appel de la classe Autoloader
require_once 'Autoloader.php';

// Permet de ne pas nommer les namespaces des classes Autoloader et UtilisateursModel
use App\Autoloader;
use App\Classes\Models\UtilisateursModel;

// Autoloader permettant d'appeler les classes automatiquement
Autoloader::register();

$login = $_SESSION['user']['login'];

if (isset($_POST['envoyer']) AND $_POST['new_password'] != $_POST['confirm_password']){
    $message = '<p>Mot de passe et confirmation mot de passe différents</p>';
}
if (isset($_POST['envoyer']) AND $_POST['new_password'] = $_POST['confirm_password']) {
    // Réecriture et securisation des variables recupérées dans la base de données
    $loginn=htmlspecialchars($_POST['new_login'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['new_email'], ENT_QUOTES);
    $nom = htmlspecialchars($_POST['new_nom'], ENT_QUOTES);
    $prenom = htmlspecialchars($_POST['new_prenom'], ENT_QUOTES);

    // Sécurisation du mot de passe
    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
    // On instancie la classe UtilisateursModel dans $profilModif
    $profilModif = new UtilisateursModel;

    // On hydrate l'objet $profilModif
    $profilModif->setId($_SESSION['user']['id'])
        ->setLogin($loginn)
        ->setNom($nom)
        ->setPrenom($prenom)
        ->setPassword($password)
        ->setMail($email)
        ->setId_droits($_SESSION['user']['id_droits']);

    // On enregistre dans la base de données
    $profilModif->update();

    // On réactualise les variables de session user
    $profilModif->setSession();
    
    // Confirmation texte et changement de la variable $_SESSION['login']
    $messageok = "<section class=message_ok>Votre profil a bien été modifié!</section>";
    $_SESSION['user']['login'] = $loginn;
    $login = $loginn;                     
}
include 'head.html';
?>
<body>
    <header>
    <?php require('header.php')?>
    </header>
    <main class="main_profil">
        <section class="profil">
            <?php   
            if (isset($messageok)) 
            {
                echo $messageok;
            }  
            else {
                echo ' <h1>Modifier son profil</h1>';
            }
            ?>       
            <section>
                <form class="form" action="#" method="POST">
                    <div class=erreur>
                    <?php
                        if (isset($message)) 
                        {
                            echo $message;
                        }
                    ?>
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label><br>
                        <input type="text" name="new_login" id="login" required placeholder=<?php echo $_SESSION['user']['login']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label><br>
                        <input type="text" name="new_nom" id="nom" required placeholder=<?php echo $_SESSION['user']['nom']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label><br>
                        <input type="text" name="new_prenom" id="prenom" required placeholder=<?php echo $_SESSION['user']['prenom']; ?>>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" name="new_email" id="email" required placeholder=<?php echo $_SESSION['user']['mail'];?>>
                    </div>                   
                    <div class="form-group">
                        <label for="pass">Mot de passe</label><br>
                        <input type="password" id="pass" name="new_password"  minlength="4" required>
                    </div>
                    <div class="form-group">
                        <label for="confpass">Confirmer le mot de passe</label><br>
                        <input type="password" id="confpass" name="confirm_password" minlength="4" required>
                    </div>
                    <div class="btn btn-primary">
                        <button type="submit" name="envoyer" value="envoyer">Enregistrer vos modifications</button>
                    </div>
                </form>
            </section>
        </section>
    </main>
    <footer>
    <?php require('footer.php'); ?>
    </footer>  
</body>

</html>