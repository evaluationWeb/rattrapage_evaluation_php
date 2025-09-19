<?php
//demarrage de la session
session_start();
//imports
include "utils/tools.php";
include "env.php";
include "utils/bdd.php";
include "model/user.php";

//Appel de la méthode pour ajouter un compte
$message = register();

/**
 * Méthode qui gére le formulaire d'enregistrement de compte
 * @return string $message 
 */
function register(): string
{
    //Test si le formulaire est submit
    if (isset($_POST["submit"])) {
        //Test si les champs sont tous remplis
        if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
            
            //Nettoyage
            $firstname = sanitize($_POST["firstname"]);
            $lastname = sanitize($_POST["lastname"]);
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);

            //bloc try catch pour gérer les erreurs SQL
            try {
                if (!isUserExistByEmail($email)) {
                    //hash du password
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $user = [];
                    $user["firstname"] = $firstname;
                    $user["lastname"] = $lastname;
                    $user["email"] = $email;
                    $user["password"] = $hash;
                    //Appel de la méthode saveUser 
                    saveUser($user);
                    return "le compte " . $email . " a été ajouté en BDD";
                } else {
                    return "Le compte existe déja";
                }
            } catch (Exception $e) {
                return "Erreur d'enregistrement en BDD";
            }
            //test si le compte n'existe pas

        } else {
            return "Veuillez remplir tous les champs de formulaire";
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
    <title>s'inscrire</title>
</head>

<body>
    <header class="container-fluid">
        <?php include "navbar.php"; ?>
    </header>
    <main class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>S'inscrire</h2>
            <p class="error"><?= $message ?? "" ?></p>
            <input type="text" name="firstname" placeholder="saisir le prénom" require>
            <input type="text" name="lastname" placeholder="saisir le nom" require>
            <input type="email" name="email" placeholder="saisir le mail" require>
            <input type="password" name="password" placeholder="saisir le password" require>
            <input type="submit" value="inscription" name="submit">
        </form>
    </main>
</body>

</html>