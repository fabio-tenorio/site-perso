<?php
// - Une page contenant le fil de discussion (discussion.php) :
// Sur cette page, les utilisateurs connectés peuvent voir l’ensemble des
// messages dans un fil de discussion. En dessous du fil de discussion se
// trouvent un champs contenant le message et un bouton permettant de
// l’envoyer. Les utilisateurs non connectés souhaitant accéder à cette page
// sont redirigés vers la page de connexion.

session_start();

// rédiriger vers connexion si la personne n'est pas connectée
if (!isset($_SESSION["login"])) {
    header('Location: connexion.php');
}

// function pour insérer le message 
function insertion (string $message) {
    // connecter à la bdd
    $database = mysqli_connect ("localhost:3306", "fabio-tenorio", "owP97b~3", "fabio-tenorio-de-carvalho_discussion");
    // vérifier la connexion à la bdd
    if (mysqli_connect_errno()) {
        echo "La connexion à la base de données a échouée".mysqli_connect_error();
        exit();
    }
    // récupérer la date et l'heure de l'envoi
    $timeregister = date ("Y-m-d H:i:s");
    // insérer le message, l'id_utilisateur de la personne connectée et la date d'envoi dans la bdd
    $insertion = "INSERT INTO messages (message, id_utilisateur, date) VALUES ('$message', '$_SESSION[id]', '$timeregister')";
    // rendre la requête executée
    return mysqli_query($database, $insertion);
}
//fonction pour refraichir la page automatiquement
function refresh() {
    // unset($_POST["valider"]);
    $discussion = $_SERVER['PHP_SELF'];
    return ("<meta http-equiv=\"refresh\" content=\"URL='"."$discussion"."'");
}
?>

<!doctype html>
<html lang="fr">
<head>
    <title>Ciranda | La Plateforme</title>
    <meta charset="UTF-8">
    <!-- PHP pour refraichir la page automatiquement -->
    <?php if (isset($_POST["valider"])) {
        refresh ();
    }?>
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
        <h1 id="title"><span class="color1">c</span><span class="color2">i</span><span class="color3">r</span><span class="color1">a</span><span class="color2">n</span><span class="color3">d</span><span class="color1">a</span></h1>
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
            <a href="index.php">accueil</a>
            <a href="#">la "ciranda"</a>
            <a href="#">nous contacter</a>
        </nav>
    </header>
    <main id="maindiscussion">
    <?php
    // fonction pour afficher les messages à chaque nouvelle insertion
    function affichage () {
    // connecter à la bdd
    $database = mysqli_connect ("localhost:3306", "fabio-tenorio", "owP97b~3", "fabio-tenorio-de-carvalho_discussion");
    // vérifier la connexion à la bdd
    if (mysqli_connect_errno()) {
        echo "La connexion à la base de données a échouée".mysqli_connect_error();
        exit();
    }
    // prendre toutes les lignes et colonnes de la table messages en les rangeant par date
    $selectmsg = "SELECT * FROM messages ORDER BY id ASC";
    // prendre toutes les lignes et colonnes de la table utilisateurs
    $selectuser = "SELECT * FROM utilisateurs";
    // affecter la première requête à $result
    $result1=mysqli_query($database, $selectmsg);
    // récuperer le résultat de la requête sur $msg sous la forme d'array
    $msg=mysqli_fetch_all($result1);
    // affecter la deuxième requête à $result2
    $result2=mysqli_query($database, $selectuser);
    // récuperer le résultat de la requête sur $user sous la forme d'array
    $user=mysqli_fetch_all($result2);
    // boucle à la recherche des messages
    for ($index=0;isset($msg[$index]);$index++) {
        echo("<article id=\"msgthread\">");
        echo("<p>posté le ");
        $convert_data = date( "d/m/Y", strtotime($msg[$index][3]));
        echo("<span class=\"emp\">".$convert_data."</span>");
        // boucle à la recherche de l'utilisateur
        for ($id=0;isset($user[$id]);$id++) {
            if ($msg[$index][2]==$user[$id][0]) {
                echo(" par <span class=\"emp\">".$user[$id][1]."</span>");
                continue;
            }
        }
        echo("</p><br/>");
        // une petite distinction dans le style pour démarquer les messages de la personne connectée
        if ($msg[$index][2]==$_SESSION["id"]) {
            echo("<p id=\"msgconnected\">".$msg[$index][1]."</p>");    
        } else {
            echo("<p id=\"msgothers\">".$msg[$index][1]."</p>");
        }
        echo("</article><br/>");
    }
    mysqli_close($database);
    return TRUE;
}
    if (isset($_POST["valider"]) and $_POST["message"]!=="") {
        insertion($_POST["message"]);
    }
    affichage();
?>
        <section id="messagebox">
            <form class="form-inline" action="discussion.php" method="POST">
                <div class="form-group">
                    <label for="commentaire"><?php echo $_SESSION["login"]?> dit:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" cols="100"></textarea>
                    <button class="btn btn-success" type="submit" name="valider" value="enregistrer">enregistrer</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <div id="footerliens">
            <a>Qui sommes-nous</a>
            <a>Application développée en PHP</a>
            <a>Crowdfunding</a>
            <a>Nous contacter</a>
        </div>
        <div id="reseauxsociaux">
            <a href="#"><img class="imgicon" src="images/instagram.svg" alt="linkedIn logo"></a>
            <a href="#"><img class="imgicon" src="images/youtube.svg" alt="Facebook logo"></a>
            <a href="#"><img class="imgicon" src="images/twitter.svg" alt="Instragram logo"></a>
            <a href="#"><img class="imgicon" src="images/facebook.svg" alt="Twitter logo"></a>
        </div>
    </footer>
</body>
</html>