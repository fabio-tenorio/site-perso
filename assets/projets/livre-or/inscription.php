<!--

créez votre base de données nommée “livreor” à l’aide
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

- Une page contenant un formulaire d’inscription (inscription.php) :
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” (sauf “id”) ainsi qu’une confirmation de mot de passe. Dès
qu’un utilisateur remplit ce formulaire, les données sont insérées dans la
base de données et l’utilisateur est redirigé vers la page de connexion.

-->

<?php
$database = mysqli_connect ("localhost:3306", "fabio-tenorio", "t84ehC0^", "fabio-tenorio-de-carvalho_livreor");
// checker la connexion à bdd
if (mysqli_connect_errno()) {
    echo "La connexion à la base de données a échouée".mysqli_connect_error();
    exit();
}
if (isset($_POST["login"]) and isset($_POST["password"])) {
    $newuser = "INSERT INTO utilisateurs (login, password) VALUES ('$_POST[login]', '$_POST[password]')";
    if ($_POST["valider"]=="valider" and $_POST["password"]==$_POST["password2"]) {
        mysqli_query($database, $newuser);
        header('Location: connexion.php');
        exit("inscription réussie!");
        } elseif ($_POST["valider"]=="valider" and $_POST["password"]!==$_POST["password2"]) {
            echo ("<p class=\"warning\">Attention! Vous n'avez pas écrit le même mot de passe</p>");
        }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>L'Éthique de Spinoza</title>
        <meta charset="UTF-8">
        <meta name="description" content="page d'inscription sur le site L'Éthique de Spinoza">
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
                    <li><a href="connexion.php">Se connecter</a></li>
                </ul>
            </nav>
        </header>
        <main id="inscription_main">
            <h2>S'inscrire</h2>
            <form action="inscription.php" method="POST" class="formulaires">
                <label for="login">login: </label>
                <input type="text" name="login" placeholder="max de 8 lettres s'il vous plaît" maxlength="8" required>
                <label for="password">mot-de-passe: </label>
                <input type="password" name="password" required>
                <label for="password2">confirmez votre mot-de-passe: </label>
                <input type="password" name="password2" required>
                <button class="buttonform" type="submit" name="valider" value="valider">valider</button>
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
    </body>
</html>