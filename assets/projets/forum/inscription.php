<?php 
// On demarre la session
session_start();

//Reinitialise messages
$message_erreur = null;
$messageok = null;

// Appelle les classes
require_once 'Autoloader.php';

// Permet de ne pas nommer les namespaces des classes Autoloader et UtilisateursModel
use App\Autoloader;
use App\classes\Models\UtilisateursModel;

// Autoloader permettant d'appeler les classes automatiquement
Autoloader::register();

//Vérifie que le mot de passe à bien été confirmé 
if (isset($_POST['envoyer']) AND  $_POST['password'] != $_POST['confirm_password']) 
{
    $message_erreur = '<p>Mot de passe et confirmation du mot de passe sont différents</p>';   
}

// Contrôle pour vérifier si la variable $_POST['Bouton'] est bien définie et que la confirmation du mot de passe est ok
if(isset($_POST['envoyer']) AND $_POST['password'] === $_POST['confirm_password'])  
{   
    //enregistre les variables de login et password
    $login = htmlspecialchars($_POST['login'], ENT_QUOTES);
    $mail = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES);
    $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // on instancie la classe Utilisateurs model dans $bd
    $bd = new UtilisateursModel();
    
    // Appel de la la méthode login pour rechercher un utilisateur dans la Base de données renvoie le resultat dans $data
    $data = $bd->login($login);
    /* $datas = $bd->login_nom($nom); */

    // Vérifie si il y a un resultat
    if (!empty($data))
    {
        // Ce login existe déjà
        $message_erreur = '<p>'.$login.' ou '.$mail.' existent déjà.</p>';
    }
    else 
    {
        // On enregistre en Bdd l'utilisateur 
        // On hydrate l'objet $bd
        $bd->setLogin($login)
            ->setMail($mail)
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setPassword($password)
            ->setId_droits(1);
        
        // Création du l'utilisateur en Base de donnée
        $bd->create();

        // Informe l'utilisateur que le profil à été créé
        $messageok = "<section class=message_ok>Votre profil a bien été crée, vous pouvez <br> <a href=\"connexion.php\">vous connecter.</section>";
    }         
}
include ('head.html');
?>

<body>
    <?php require('header.php')?>
    <main class=main_inscription>      
        <section class=formulaire>        
        
                           
            <section>
                <form action="" method="post">
                    <div class = erreur>
                    
                    <?php 
                    if (isset($message_ok)) 
                    {
                        echo $message_ok;
                    }
                    elseif (isset($message_erreur)) 
                    {
                        echo $message_erreur;
                    }
                    else {
                        echo '<h1>Créer votre profil</h1>';
                    }
                    ?>  
                                      
                    </div>
                    <div>
                        <label for="login">Login</label><br>
                        <input type="text" name="login" id="login" required>
                    </div>
                    <div>
                        <label for="Nom">Nom</label><br>
                        <input type="text" name="nom" id="Nom" required>
                    </div>
                    <div>
                        <label for="prenom">Prénom</label><br>
                        <input type="text" name="prenom" id="prenom" required>
                    </div>
                    <div>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div>
                        <label for="pass">Mot de passe</label><br>
                        <input type="password" id="pass" name="password" minlength="2" required>
                    </div>
                    <div>
                        <label for="conf_pass">Confirmer le mot de passe</label><br>
                        <input type="password" id="conf_pass" name="confirm_password" minlength="2" required>
                    </div>
                    <div class=bouton>
                        <input type="submit" name="envoyer" value="Envoyer le formulaire" >
                    </div>
                   
                </form>
            </section>
                
        </section>
    </main>
    <?php include('footer.php') ?>
</body>

</html>