<?php
//demarrage la session
session_start();
//imports
include "utils/tools.php";
include "env.php";
include "utils/bdd.php";
include "model/note.php";

//test si l'utilisateur n'est pas connecté
if (!isset($_SESSION["connected"])) {
    //redirection vers index.php
    header("Location: index.php");
}

//récupération de l'idUser depuis la SESSION PHP
$idUser = $_SESSION["idUser"];

//récupération des notes de l'utilisateur
try {
    //appel de la méthode findAllNote (model note) pour récupérer la liste des notes
    $notes = findAllNote($idUser);
} catch (Exception $e) {
    //Tableau erreur SQL
    $notes["error"] = "La base de donnés ne répond pas";
}


?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/pico.min.css">
    <link rel="stylesheet" href="public/style.css">
    <title>Liste des notes</title>
</head>

<body>
    <header class="container-fluid">
        <?php include "navbar.php"; ?>
    </header>
    <main class="container-fluid">
        <h2>Liste des notes</h2>
        <table class="striped">
            <thead data-theme="dark">
                <th>Title</th>
                <th>content</th>
                <th>Date de création</th>
            </thead>
            <?php if (!empty($notes["error"])) :?>
                <p class="error"> <?=$notes["error"]?></p>
            <?php else : ?>
                <!-- Boucler sur le tableau de books -->
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?= $note["title"] ?> </td>
                        <td>
                            <?= $note["content"] ?>
                        </td>
                        <td>
                            <?= $note["created_at"] ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </table>
    </main>
</body>

</html>