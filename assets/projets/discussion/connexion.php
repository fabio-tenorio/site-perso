<?php
// Une page contenant un formulaire de connexion (connexion.php) :
//     Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
//     formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
//     informations, alors l’utilisateur devient connecté et une (ou plusieurs)
//     variables de session sont créées.

session_start();

function connexion () {
        $database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_discussion");
    // vérifier la connexion à la bdd
    if (mysqli_connect_errno()) {
        echo "connexion échouée".mysqli_connect_error();
        exit();
    }
    // vérifier le remplissage du formulaire
    if (isset($_POST["login"]) and isset($_POST["password"])) {
        // faire la requête
        $querylogin = "SELECT * FROM utilisateurs WHERE login LIKE '$_POST[login]'";
        $query = mysqli_query ($database, $querylogin);
        $inscrit = mysqli_fetch_array ($query);
        // var_dump($inscrit);
        //si le login n'est pas bon
        if ($inscrit==NULL) {
            return ("<p class=\"alert alert-warning\">Vous n'êtes pas inscrit-e</p>");
        } else {
            // si le login est bon, vérifier le mot-de-passe encrypté lors de l'inscription
            if (password_verify($_POST["password"], $inscrit[2])) {
                $_SESSION["id"]=$inscrit["id"];
                $_SESSION["login"]=$inscrit["login"];
                $_SESSION["password"]=$inscrit["password"];
                return ("<p class=\"alert alert-success\">Salut ".$_SESSION["login"]."! Vous êtes connecté-e</p>");
            } else {
                // si le mot-de-passe est incorrect
                return ("<p class=\"alert alert-warning\">mot-de-passe incorrect</p>");
            }
        }
    }
}

//deconnexion

if (isset($_GET["signout"])) {
    if ($_GET["signout"]=="getout") session_destroy();
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
            <?php
            if (isset($_SESSION["login"])) {
                echo ("
                <a href=\"index.php\">accueil</a>
                <a href=\"#\">la \"ciranda\"</a>
                <a href=\"discussion.php\">discussion</a>
                <a href=\"#\">nous contacter</a>   
                ");
            } else {
                echo ("
                <a href=\"index.php\">accueil</a>
                <a href=\"#\">la \"ciranda\"</a>
                <a href=\"inscription.php\">inscription</a>
                <a href=\"discussion.php\">discussion</a>
                <a href=\"#\">nous contacter</a>   
                ");
            }
            ?>
        </nav>
    </header>

<! the main -->

    <main class="formulairesmain">
        <?php
        echo connexion();
        ?>
        <h2>Log in</h2>
        <form action="connexion.php" method="POST">
            <div class="form-group">
                <label for="login">login: </label>
                <input type="text" name="login" placeholder="votre nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <label for="password">mot-de-passe: </label>
                <input type="password" name="password" required>
            </div>
            <button class="btn btn-primary" type="submit" name="valider">valider</button>
        </form>
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