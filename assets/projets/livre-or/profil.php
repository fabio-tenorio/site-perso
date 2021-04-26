<!--
- Une page permettant de modifier son profil (profil.php) :
Cette page possède un formulaire permettant à l’utilisateur de modifier son
login et son mot de passe.
-->

<?php
session_start();
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");
// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
if (isset($_POST["newlogin"]) and isset($_POST["newpass"])) {
    if($_POST["valider"]=="valider") {
        $changelogin = "UPDATE utilisateurs SET login='$_POST[newlogin]', password='$_POST[newpass]' WHERE id=$_SESSION[id]";
        mysqli_query($database, $changelogin);
        echo ("<p class=\"cestbon\">modification réussie</p>");
    } else {
        echo ("<p class=\"warning\">echec de la modification: </p>".mysqli_connect_error());
    }
}
//deconnexion
if (isset($_GET["signout"])) {
    if ($_GET["signout"]=="getout") unset($_SESSION);
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
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="http://spinoza.fr/">L'Éthique en ligne</a></li>
                    <li><a href="https://fr.wikipedia.org/wiki/Baruch_Spinoza">Savoir plus sur Spinoza</a></li>
                    <li><a href="livre-or.php">Livre d'or</a></li>
                    <li><a href="commentaire.php">Commenter</a></li>
                </ul>
                <?php
                if (isset($_SESSION["username"])) {
                    echo("
                    <div id=\"profile_signout\">
                    <form method=\"GET\" action=\"index.php\">
                        <button type=\"submit\" name=\"signout\" value=\"getout\" class=\"buttonform\">Se deconnecter</button>
                    </form>
                    </div>");
                }
                ?>
            </nav>
        </header>
        <main id="main_profil">
            <h2>Ici vous pouvez modifier votre login et votre mot-de-passe</h2>
            <form action="profil.php" method="POST" class="formulaires">
                <label for="newlogin">Votre nouveau login: </label>
                <input type="text" name="newlogin">
                <label for="newpass">Votre nouveau mot de passe: </label>
                <input type="password" name="newpass">
                <button type="submit" name="valider" value="valider" class="buttonform">valider</button>
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
                <li><a>Qui sommes-nous</a></li>
            </ul>
        </footer>
    </body>
</html>