<?php
session_start();
session_destroy();
/* Redirige vers la page d'accueil */
header("Location:index.php");
?>