<?php
//demarrage la session
session_start();
//imports
include "utils/tools.php";
include "env.php";
include "utils/bdd.php";
include "model/note.php";

//Appel de la méthode addNote (model note) pour ajouter la note en BDD
$message = addNote();


/**
 * Méthode pour ajouter une note en BDD
 * @return string $message 
 */
function addNote(): string
{
    //test si l'utilisateur n'est pas connecté
    if (!isset($_SESSION["connected"])) {
        //redirection vers index.php
        header("Location: index.php");
    }

    //Test si le formulaire est submit
    if (isset($_POST["submit"])) {
        //test si les champs sont remplis
        if (
            !empty($_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["created_at"])
        ) {
            //récupération du user depuis la session
            $idUser = sanitize($_SESSION["idUser"]);
            //nettoyage des informations de la note (formulaire)
            $title = sanitize($_POST["title"]);
            $content = sanitize($_POST["content"]);
            $created_at = sanitize($_POST["created_at"]);
            //Tableau de la note
            $note = [];
            $note["title"] = $title;
            $note["content"] = $content;
            $note["created_at"] = $created_at;
            $note["idUser"] = $idUser;
            //appel de la méthode pour ajouter une note en BDD (bloc try catch)
            try {
                saveNote($note);
            } catch (Exception $e) {
                return "Erreur d'enregistrement en BDD";
            }
            return "La note a été ajouté en BDD";
        } else {
            return "Veuillez remplir tous les champs du formulaire";
        }
    }
    return "";
}

?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/pico.min.css">
    <link rel="stylesheet" href="public/style.css">
    <title>Ajouter une note</title>
</head>

<body>
    <header class="container-fluid">
        <?php include "navbar.php"; ?>
    </header>
    <main class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Ajouter une note à votre liste</h2>
            <p class="error"><?= $message ?? "" ?></p>
            <input type="text" name="title" placeholder="saisir le titre" require>
            <textarea name="content" rows="5" cols="30" placeholder="saisir le contenu de la note" require></textarea>
            <label for="created_at">Saisir la date de la note</label>
            <input type="date" name="created_at" require>
            <input type="submit" value="Ajouter" name="submit">
        </form>
    </main>
</body>

</html>