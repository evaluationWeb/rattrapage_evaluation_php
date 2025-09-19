<?php
//démarrage de la session
session_start();
//test si l'utilisateur n'est pas connecté
if (!isset($_SESSION["connected"])) {
    header("Location: index.php");
}
//suppression de la session
session_destroy();
//redirection vers la page d'accueil
header('Location: index.php');
