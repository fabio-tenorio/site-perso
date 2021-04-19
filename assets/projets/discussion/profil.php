<?php
// Une page permettant de modifier son profil (profil.php) :
//     Cette page possède un formulaire permettant à l’utilisateur de modifier son
//     login et son mot de passe.
session_start();


function profil () {
    // checker la connexion à bdd
    $database = mysqli_connect ("localhost:3306", "fabio-tenorio", "owP97b~3", "fabio-tenorio-de-carvalho_discussion");
    if (mysqli_connect_errno()) {
        echo "The connexion to the database failed".mysqli_connect_error();
        exit();
    }
    if (isset($_POST["newlogin"]) and isset($_POST["newpass"])) {
            if ($_POST["newpass"]!=="" or $_POST["newlogin"]!=="") {
                $_SESSION["login"]=$_POST["newlogin"];
                $_SESSION["password"]=$_POST["newpass"];
                //encrypter le nouveau mot-de-passe
                $_POST["newpass"]=password_hash($_POST["newpass"], PASSWORD_DEFAULT);
                $changelogin = "UPDATE utilisateurs SET login='$_POST[newlogin]', password='$_POST[newpass]' WHERE id=$_SESSION[id]";
                mysqli_query($database, $changelogin);
                return ("<p class=\"alert alert-success\">modification réussie !</p>");
            } else {
                return ("<p class=\"alert alert-warning\">désolé. Modification échouée");
            }
    }
}

//deconnexion
if (isset($_GET["signout"])) {
    if ($_GET["signout"]=="getout") session_destroy();
    header('Location:index.php');
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
        <nav>
        <?php
            if (isset($_SESSION["login"])) {
                echo ("
                <a href=\"index.php\">accueil</a>
                <a href=\"#\">la \"ciranda\"</a>
                <a href=\"discussion.php\">discussion</a>
                <a href=\"#\">nous contacter</a>
                <form method=\"GET\" action=\"profil.php\">
                    <button class=\"btn btn-link\" type=\"submit\" name=\"signout\" value=\"getout\">déconnexion</button>
                </form>
                ");
            }
        ?>
        </nav>
    </header>
    <main class="formulairesmain">
        <?php echo profil() ?>
        <h2>profil</h2>
        <form action="profil.php" method="POST">
            <?php
            if (isset($_SESSION["login"])) {
                echo("
                <p class=\"ProfileData\">votre login actuel: ".$_SESSION["login"]."</p>
                ");
            }
            ?>
            <div class="form-group">
                <label for="newlogin">nouveau login: </label>
                <input type="text" name="newlogin">
            </div>
            <div class="form-group">
                <label for="newpass">nouveau mot-de-passe: </label>
                <input type="password" name="newpass">
            </div>
            <button class="btn btn-success" type="submit" name="valider" value="valider">submit</button>
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