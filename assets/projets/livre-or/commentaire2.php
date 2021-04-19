<?php
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
<section id="comment_section">
    <form action="commentaire.php" method="POST" class="formulaires">
        <label for="commentaire">Laissez votre commentaire: </label>
        <textarea id="commentaire" name="commentaire" rows="10" cols="40">Rédigez votre avis sur le site ou sur l'oeuvre de Spinoza...</textarea>
        <button class="buttonform" type="submit" name="valider" value="enregistrer">enregistrer</button>
    </form>
</section>