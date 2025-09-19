<?php
    //demarrage de la session
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/pico.min.css">
    <link rel="stylesheet" href="public/style.css">
    <title>Accueil</title>
</head>
<body>
    <header class="container-fluid">
        <?php
            //import du menu
            include "navbar.php"; 
        ?>
    </header>
    <main class="container-fluid">
        <h2>Bienvenue sur notre super site !!</h2>
    </main>
</body>
</html>
