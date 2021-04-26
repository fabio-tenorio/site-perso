<!--
- Une page contenant un formulaire de connexion (connexion.php) :
Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
informations, alors l’utilisateur devient connecté et une (ou plusieurs)
variables de session sont créées. -->

<?php
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");
// vérifier la connexion à la bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
// vérifier si l'utilisateur a rempli le formulaire
if (isset($_POST["login"]) and isset($_POST["password"])) {
    // les requetes SQL avec les informations fournies par l'utilisateur
    $requetelogin = "SELECT * FROM utilisateurs WHERE login LIKE '$_POST[login]'";
    $requetepsw = "SELECT * FROM utilisateurs WHERE password LIKE '$_POST[password]'";
    $query = mysqli_query ($database, $requetelogin);
    $query2 = mysqli_query ($database, $requetepsw);
    $signedup = mysqli_fetch_array ($query);
    // var_dump($signedup);
    $confirmed = mysqli_fetch_array ($query2);
    // var_dump($signedup);
    // si le login inséré ne correspond pas aux logins déjà enrégistrés dans la bdd
    if ($signedup==NULL) {
        echo("<p class=\"warning\">Désolé. Vous n'êtes pas inscrit(e)</p>");
    } else {
        // si le login est enrégistré, mais le mot de passe est incorrect
        if ($signedup["password"]!==$_POST["password"]) {
            echo ("<p class=\"warning\">mot-de-passe incorrect</p>");
        } else {
            // si tout est bon, alors créer des variables des sessions pour les autres pages
            session_start();
            $_SESSION["username"]=$_POST["login"];
            $_SESSION["password"]=$_POST["password"];
            $_SESSION["id"]=$signedup["id"];
            echo("<p class=\"cestbon\">Vous êtes connecté!</p>");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>L'Éthique de Spinoza</title>
        <meta charset="UTF-8">
        <meta name="description" content="page de connexion sur le site L'Éthique de Spinoza">
        <meta name="keywords" content="Philosophie, Philosophy, Éthique, Espinosa">
        <meta name="author" content="Fabio Tenorio">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Arapey&family=Poiret+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css"> 
    </head>
    <body>
        <header>
            <h1>Ethica Ordine Geometrico Demonstrata</h1>
            <img src="images/spinoza.jpg" alt="dessin de Baruch Spinoza">
            <h2>Un site dédié à l'oeuvre du philosophe Baruch Spinoza</h2>
            <?php
            if (isset($_SESSION["username"])) {
                echo ("
                <div class=\"balloon\">
                    <img src=\"images/balloon.svg\" alt=\"#\">
                    <div id=\"salut\"><p>Salut</p>"."<a id=\"username\" href=\"profil.php\">".$_SESSION["username"]."!</a>"."</div> 
                </div>");
            }
            ?>
            <nav>
                <ul>
                <?php
                if (isset($_SESSION["username"])) {
                    echo ("
                        <li><a href=\"index.php\">Accueil</a></li>
                        <li><a href=\"http://spinoza.fr/\">L'Éthique en ligne</a></li>
                        <li><a href=\"https://fr.wikipedia.org/wiki/Baruch_Spinoza\">Savoir plus sur Spinoza</a></li>
                        <li><a href=\"livre-or.php\">Livre d'or</a></li>
                        <li><a href=\"commentaire.php\">Commenter</a></li>");
                } else {
                    echo ("
                        <li><a href=\"index.php\">Accueil</a></li>
                        <li><a href=\"http://spinoza.fr/\">L'Éthique en ligne</a></li>
                        <li><a href=\"https://fr.wikipedia.org/wiki/Baruch_Spinoza\">Savoir plus sur Spinoza</a></li>
                        <li><a href=\"inscription.php\">S'inscrire</a></li>");
                }
                ?>
                </ul>
            <?php
            if (isset($_SESSION["username"])) {
                echo("
                <div id=\"profile_signout\">
                <a href=\"profil.php\">Votre profil</a>
                <form method=\"GET\" action=\"connexion.php\">
                    <button type=\"submit\" name=\"signout\" class=\"buttonform\">Se deconnecter</button>
                </form>
                </div>");
            }
            //deconnexion

            if (isset($_GET["signout"])) {
                session_destroy($_SESSION);
                header('Location: connexion.php');
            }

            ?>
            </nav>
        </header>
        <main id="inscription_main">
            <h2>Se connecter</h2>
            <form action="connexion.php" method="POST" class="formulaires">
                <label for="login">login: </label>
                <input type="text" name="login" placeholder="votre nom d'utilisateur">
                <label for="password">mot-de-passe: </label>
                <input type="password" name="password" required>
                <button type="submit" name="connect" value="connected" class="buttonform">Se connecter</button>
            </form>
        </main>
        <footer>
            <ul>
                <li><a>Stanford Encyclopedia of Philosophy</a></li>
                <li><a>Philosophy Papers</a></li>
                <li><a href="http://spinoza.fr/">Spinoza.fr</a></li>
                <li><a>Spinoza en portugais</a></li>
            </ul>
            <ul>
                <li><a>Biographie de Spinoza</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="connexion.php">Se connecter</a></li>
                <li><a>Qui sommes-nous</a></li>
            </ul>
        </footer>
</html>