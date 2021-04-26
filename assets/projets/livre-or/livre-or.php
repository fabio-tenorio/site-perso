<!--
- Une page permettant de voir le livre d’or (livre-or.php) :
Sur cette page on voit l’ensemble des commentaires, organisés du plus
récent au plus ancien. Chaque commentaire doit être composé d’un texte
“posté le `jour/mois/année` par `utilisateur`” suivi du commentaire. Si
l’utilisateur est connecté, sur cette page figure également un lien vers la
page d’ajout de commentaire. -->

<?php
session_start();
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");
// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
//deux requetes - la 1ere pour selectionner les commentaires et la 2eme pour selectionner les logins
$sqlcommentaires = "SELECT * FROM commentaires ORDER BY date DESC";
$query = mysqli_query ($database, $sqlcommentaires);
$commentaires = mysqli_fetch_all ($query);

$sqlutilisateurs = "SELECT * FROM utilisateurs";
$query = mysqli_query ($database, $sqlutilisateurs);
$utilisateurs = mysqli_fetch_all ($query);

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
                    <li><a href="commentaire.php">Commenter</a></li>
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
            //boucle à la recherche des commentaires
            for ($index=0;isset($commentaires[$index]);$index++) {
                echo("<article>");
                echo("<p class=\"commentaire_date\">posté le ");
                $convert_data = date( "d/m/Y", strtotime($commentaires[$index][3]));
                echo($convert_data);
                // boucle à la recherche du commentateur
                for ($id=0;isset($utilisateurs[$id]);$id++) {
                    if ($commentaires[$index][2]==$utilisateurs[$id][0]) {
                        echo(" par ".$utilisateurs[$id][1]);
                        continue;
                    }
                }
                echo("</p><br/>");
                echo("<p class=\"comment_text\">".$commentaires[$index][1]."</p>");
                echo("</article><br/>");
            }
            // j'ai ajouté une autre façon de inserer des commentaires en utilisant la fonction include
            include ('commentaire2.php');
            ?>
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