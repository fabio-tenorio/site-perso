<!--

Pour commencer, créez votre base de données nommée “livreor” à l’aide
de phpmyadmin. Dans cette bdd, créez une table “utilisateurs” qui contient
les champs suivants :
- id, int, clé primaire et Auto Incrément
- login, varchar de taille 255
- password, varchar de taille 255
Créez une table “commentaires” qui contient les champs suivants :
- id, int, clé primaire et Auto Incrément
- commentaire, TEXT
- id_utilisateur, int
- date, datetime
Maintenant que la base de données est prête, vous allez avoir besoin de
créer différentes pages :
- Une page d’accueil qui présente votre site (index.php)

-->

<?php
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");

// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
session_start();

// une message sera affichée dans le cas où un utilisateur insere un commentaire 
if (isset($_SESSION["confirm_comment"])) {
    echo ("<p class=\"cestbon\">".$_SESSION["confirm_comment"]."</p>");
}

//deconnexion
if (isset($_GET["signout"])) {
    if ($_GET["signout"]=="getout") session_destroy($_SESSION);
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>L'Éthique de Spinoza</title>
        <meta charset="UTF-8">
        <meta name="description" content="un site dédié à l'oeuvre du philosophe Baruch Spinoza">
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
            <?php
            if (isset($_SESSION["username"])) {
                echo ("
                <div class=\"balloon\">
                    <img src=\"images/balloon.svg\" alt=\"#\">
                    <div id=\"salut\"><p>Salut</p>"."<a id=\"username\" href=\"profil.php\">".$_SESSION["username"]."!</a>"."</div> 
                </div>");
            } else {
                echo ("
                <div class=\"balloon\">
                    <img src=\"images/balloon.svg\" alt=\"#\">
                    <div class=\"anonyme\">Qui es-tu?</div> 
                </div>");
            }
            ?>
            <h2>Un site dédié à l'oeuvre du philosophe Baruch Spinoza</h2>
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
                            <li><a href=\"inscription.php\">S'inscrire</a></li>
                            <li><a href=\"connexion.php\">Se connecter</a></li>");
                    }
                    ?>
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
        <main id="index_main">
            <section>
                <h3>Bienvenu-es!</h3>
                <p>Ce site est dédié au philosophe Spinoza et à son œuvre.
                Baruch Spinoza, né le 24 novembre 1632 à Amsterdam et mort le 21 février 1677
                à La Haye, est un philosophe néerlandais. Il occupe une place importante dans
                l'histoire de la philosophie, sa pensée, appartenant au courant des modernes
                rationalistes, ayant eu une influence considérable sur ses contemporains
                et nombre de penseurs postérieurs.<br/>
                En philosophie, Spinoza est, avec René Descartes et Gottfried Wilhelm Leibniz,
                l'un des principaux représentants du rationalisme. Héritier critique du cartésianisme,
                le spinozisme se caractérise par un rationalisme absolu laissant une place à la
                connaissance intuitive, une identification de Dieu avec la nature, une définition
                de l'homme par le désir, une conception de la liberté comme compréhension de la nécessité,
                une critique des interprétations théologiques de la Bible aboutissant à une conception laïque
                des rapports entre politique et religion. Il s'inscrit dans l'école de pensée philosophique
                matérialiste qui se distingue par une distance de Platon ou d'Aristote.<br/>
                Après sa mort, le spinozisme connut une influence durable et fut largement mis en débat.
                L'œuvre de Spinoza entretient en effet une relation critique avec les positions traditionnelles
                des religions monothéistes que constituent le judaïsme, le christianisme et l'islam.
                Spinoza fut maintes fois admiré par ses successeurs : Hegel en fait « un point crucial
                dans la philosophie moderne » — « L'alternative est : Spinoza ou pas de philosophie »;
                Nietzsche le qualifiait de « précurseur », notamment en raison de son refus de la téléologie;
                Gilles Deleuze le surnommait le « Prince des philosophes » ; et Bergson ajoutait que
                « tout philosophe a deux philosophies : la sienne et celle de Spinoza ». 
                </p>
            </section>
            <section>
                <h3>L'Étique de Spinoza</h3>
                <p>L'Éthique (en latin : Ethica - en forme longue Ethica Ordine Geometrico Demonstrata
                ou Ethica More Geometrico Demonstrata, littéralement « Éthique démontrée suivant l'ordre
                des géomètres ») est une œuvre philosophique de Spinoza rédigée en latin entre 1661 et 1675,
                publiée à sa mort en 1677 et interdite l'année suivante. Il s'agit sans doute de son ouvrage
                le plus connu et le plus important : son impact, entre autres sur les penseurs français,
                va grandissant depuis les années 1930.<br/>
                La réflexion suit un cheminement qui part de Dieu pour aboutir à la liberté et la béatitude.
                Son projet relève ainsi de la philosophie pratique car le philosophe invite l'homme à dépasser
                l'état ordinaire de servitude vis-à-vis des affects pour s'émanciper et à connaître le bonheur
                au moyen d'une connaissance véritable de Dieu, identifié à la nature, et de la causalité.
                Il récuse la notion de libre-arbitre, conjuguant un déterminisme causal intégral et la possibilité
                de la liberté.
                Le texte est réputé d'un abord difficile en raison de son écriture qui s'apparente davantage
                à un traité mathématique à la manière des Éléments d'Euclide qu'à un essai littéraire.
                Comme son titre complet l'annonce, l'Éthique se veut « démontrée suivant l'ordre des géomètres »,
                c'est-à-dire à la manière des mathématiques.</p>
            </section>
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
    </body>
</html>