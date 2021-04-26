<?php
// - Une page contenant un formulaire d’inscription (inscription.php) :
//     Le formulaire doit contenir l’ensemble des champs présents dans la table
//     “utilisateurs” (sauf “id”) ainsi qu’une confirmation de mot de passe. Dès
//     qu’un utilisateur remplit ce formulaire, les données sont insérées dans la
//     base de données et l’utilisateur est redirigé vers la page de connexion.

function inscription () {
    $database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_discussion");
    // vérifier la connexion à la bdd
    if (mysqli_connect_errno()) {
        echo "connexion échouée".mysqli_connect_error();
        exit();
    }
    // insertion des données dans la bdd
    if (isset($_POST["login"]) and isset($_POST["password"])) {
        if ($_POST["password"]==$_POST["password2"]) {
            //encrypter le mot de passe
            $_POST["password"]=password_hash($_POST["password"], PASSWORD_DEFAULT);
            $newuser = "INSERT INTO utilisateurs (login, password) VALUES ('$_POST[login]', '$_POST[password]')";
            // vu que mysqli_query rend un boolean...
                if (mysqli_query($database, $newuser)) {
                    header('Location: connexion.php');
                    exit();
                } else {
                    return ("la requête n'a pas abouti");
                }
            } else {
                return ("<p class=\"warning\">Échec. Le mot-de-passe n'a pas été bien confirmé</p>");
            }
    }
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
            <a href="index.php">accueil</a>
            <a href="#">la "ciranda"</a>
            <a href="connexion.php">connexion</a>
            <a href="discussion.php">discussion</a>
            <a href="#">nous contacter</a>
        </nav>
    </header>
    <main class="formulairesmain">
        <?php inscription (); ?>
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST" class="formulaire">
            <div class="form-group"> 
                <label for="login">login: </label>
                <input class=".form-control" type="text" name="login" placeholder="votre nom d'utilisateur" required>
            </div>
            <div class="form-group"> 
                <label for="password">mot-de-passe: </label>
                <input class=".form-control" type="password" name="password" required>
            </div>
            <div class="form-group"> 
                <label for="password2">confirmez votre mot-de-passe: </label>
                <input class=".form-control" type="password" name="password2" required>
            </div>
            <button class="btn btn-success" type="submit" name="valider">valider</button>
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