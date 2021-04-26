<!--
- Un formulaire d’ajout de commentaire (commentaire.php)
Ce formulaire ne contient qu’un champs permettant de rentrer son
commentaire et un bouton de validation. Il n’est accessible qu’aux
utilisateurs connectés. Chaque utilisateur peut poster plusieurs
commentaires.
-->

<?php
session_start();
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");
// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
// var_dump($_SESSION["id"]);

if (isset($_POST["commentaire"]) and isset($_POST["valider"])) {
    if ($_POST["commentaire"]!=="" and $_POST["valider"]=="enregistrer") {
        $timeregister = date ("Y-m-d H:i:s");
        $comment = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$_POST[commentaire]', '$_SESSION[id]', '$timeregister')";
        if (mysqli_query($database, $comment)) {
            $_SESSION["confirm_comment"]="Commentaire enregistré!";
            mysqli_close($database);
            header('Location:index.php');
        } else {
            echo ("<p class=\"warning\">nous n'avons pas réussi à enregistrer votre commentaire: </p>".mysqli_error($database));
        }
    } elseif ($_POST["commentaire"]!=="" and $_POST["valider"]=="enregistrer") {
        echo ("<p class=\"warning\">Pourquoi aussi laconique?</p>");
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
    <body id="comment_body">
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
                </ul>
                <?php
                if (isset($_SESSION["username"])) {
                    echo("
                    <div id=\"profile_signout\">
                    <a href=\"profil.php\">Votre profil</a>
                    <form method=\"GET\" action=\"index.php\">
                        <button type=\"submit\" name=\"signout\" value=\"getout\" class=\"buttonform\">Se deconnecter</button>
                    </form>
                    </div>");
                }
                ?>
            </nav>
        </header>
    <main id="comment_main">
        <?php
        echo("<h2>Salut <i>".$_SESSION["username"]."</i>, ce serait bien d'avoir votre avis.</h2>");
        ?>
        <form action="commentaire.php" method="POST" class="formulaires">
            <label for="commentaire">Laissez votre commentaire: </label>
            <textarea id="commentaire" name="commentaire" rows="10" cols="40">Rédigez votre avis sur le site ou sur l'oeuvre de Spinoza...</textarea>
            <button class="buttonform" type="submit" name="valider" value="enregistrer">enregistrer</button>
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