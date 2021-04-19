<?php

// Vous décidez de créer un fil de discussion permettant à vos visiteurs de
// communiquer.
// Pour commencer, créez votre base de données nommée “discussion” à
// l’aide de phpmyadmin. Dans cette bdd, créez une table “utilisateurs” qui
// contient les champs suivants :
// - id, int, clé primaire et Auto Incrément
// - login, varchar de taille 255
// - password, varchar de taille 255
// Créez une table “messages” qui contient les champs suivants :
// - id, int, clé primaire et Auto Incrément
// - message, varchar 140
// - id_utilisateur, int
// - date, date
// Maintenant que la base de données est prête, vous allez avoir besoin de
// créer différentes pages :
// - Une page d’accueil qui présente votre site (index.php)

session_start();
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "owP97b~3", "fabio-tenorio-de-carvalho_discussion");
// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}

//deconnexion

if (isset($_GET["logout"])) {
    session_destroy();
    header('Location: connexion.php');
}

?>

<!doctype html>
<html lang="fr">
<head>
    <title>Ciranda | La Plateforme</title>
    <meta charset="UTF-8">
    <meta name="description" content="un forum pour stimuler des discussions plus structurées logiquement">
    <meta name="keywords" content="discussion, forum, ciranda, logique, argumentation">
    <meta name="author" content="Fabio Tenorio">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noticia+Text&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1 id="title"><span class="color1">c</span><span class="color2">i</span><span class="color3">r</span><span class="color4">a</span><span class="color1">n</span><span class="color2">d</span><span class="color3">a</span></h1>
        <img src="images/ciranda3.png" alt="image d'une ciranda">
        <h2>Une autre façon d'intéragir en ligne</h2>
        <div id="profilcoin">
            <?php if (isset($_SESSION["login"])) {
                echo ("<img src=\"images/profilicon.png\" alt=\"#\">");
                echo "<p id=\"login\">".$_SESSION["login"]."</p>";
                echo ("<a href=\"profil.php\">mon profil</a>");
                echo ("
                <form method=\"GET\" action=\"index.php\">
                    <button id =\"deco\" class=\"btn btn-link\" type=\"submit\" name=\"logout\" value=\"logout\">me déconnecter</button>
                </form>");
                }  ?>
        </div>
        <nav>
        <?php
            // si l'on n'est pas connecté
            if (!isset($_SESSION["login"])) {
                echo ("
                <a href=\"index.php\">accueil</a>
                <a href=\"#\">la \"ciranda\"</a>
                <a href=\"inscription.php\">inscription</a>
                <a href=\"connexion.php\">connexion</a>
                <a href=\"discussion.php\">discussion</a>
                <a href=\"#\">nous contacter</a>
                ");
            // si l'on est connecté
            } else {
                echo("
                <a href=\"index.php\">accueil</a>
                <a href=\"#\">la \"ciranda\"</a>
                <a href=\"discussion.php\">discussion</a>
                <a href=\"#\">nous contacter</a>
                ");
            }
        ?>
        </nav>
    </header>
    <main id="indexmain">
        <section id="section1">
            <h2>Vos discussions plus structurées logiquement</h2>
            <p>Il nous semble, en effet, que les évolutions socio-politiques plaident pour un renouvellement
                des modes d’observation du politique. Les habitants des démocraties occidentales manifestent,
                depuis bientôt deux décennies, une défiance à l’égard du personnel politique et un effritement
                de la confiance, ainsi qu’une désaffection croissante à l’égard des modalités de participation
                au pouvoir qui leur sont réservées, comme en témoignent la montée des taux d’abstention,
                et l’érosion des effectifs syndicaux et partisans. Mais on observe, dans le même temps,
                le développement de pratiques concurrentes destinées à agir sur la décision politique :
                renouvellement des formes de manifestation, coordinations, création d’associations
                destinées à représenter les absents de la scène politique, développement des pratiques
                de recherche et diffusion de l’information et de l’expertise, etc. Le renouvellement des
                modes d’approche de la politisation doit nous aider à mieux comprendre ces transformations
                et à en saisir toute la portée. </p>
                <img src="images/toulmin.jpg" alt="#">
        </section>
        <section id="section2">
            <h2>Une interface agréable</h2>
            <p>Le terme UI fait référence à l’interface par le biais de laquelle l’utilisateur interagit :
                être un site web, une application mobile ou un logiciel. Le travail de l’UI designer est
                important pour toute entreprise ou organisation souhaitant marquer sa présence sur le web.
                UI est l’abréviation d’user interface ou interface utilisateur. L’UI design se rapporte
                donc à l’environnement graphique dans lequel évolue l’utilisateur d’un logiciel, d’un site
                web ou d’une application. La mission de l’UI designer consiste à créer une interface agréable
                et pratique, facile à prendre en main. Ainsi, l’UI design fait partie de l’UX design, en cela
                qu’il travaille à donner la meilleure expérience possible à l’utilisateur, mais il s’attache
                plus particulièrement aux éléments perceptibles : éléments graphiques, boutons, navigation,
                typographie…</p>
                <img src="images/discussion.png" alt="#">
        </section>
        <section id="section3">
            <h2>Plusieurs fonctionnalités disponibles</h2>
            <p>Un forum est un espace sur votre site où vous invitez vos utilisateurs à entrer
                en contact avec vous et mais également à ce qu’ils le fassent entre eux.
                Vos utilisateurs ont parfois des questions techniques, des doutes, et ont besoin
                de réponses. Un salarié de votre entreprise peut alors y répondre, mais également
                la communauté. Google par exemple met à disposition un puissant forum d’aide où les
                utilisateurs s’entraident. Je dirais que cela est plutôt réservé aux grands groupes,
                qui ont un volume massif d’utilisateurs. Il est alors intéressant de les réunir sur
                une plateforme (type forum) qui vous appartient. Pour les plus petites structures,
                j’opterais a priori (sauf cas particulier) de passer par les réseaux sociaux
                classiques, où vous animez votre communauté.</p>
            <img src="images/profil.png" alt="#">
        </section>
    </main>
    <footer>
        <div id="footerliens" class="container">
            <a>Qui sommes-nous</a>
            <a>Application développée en PHP</a>
            <a>Crowdfunding</a>
            <a>Nous contacter</a>
        </div>
        <div id="reseauxsociaux" class="container">
            <a href="#"><img class="imgicon" src="../images/instagram.svg" alt="linkedIn logo"></a>
            <a href="#"><img class="imgicon" src="../images/youtube.svg" alt="Facebook logo"></a>
            <a href="#"><img class="imgicon" src="../images/twitter.svg" alt="Instragram logo"></a>
            <a href="#"><img class="imgicon" src="../images/facebook.svg" alt="Twitter logo"></a>
        </div>
    </footer>
</body>
</html>