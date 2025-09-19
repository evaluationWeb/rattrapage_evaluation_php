<?php
//demarrage de la session
session_start();
//imports
include "utils/tools.php";
include "env.php";
include "utils/bdd.php";
include "model/user.php";

//Appel de la méthode connexion
$message = connexion();


/**
 * Méthode qui va gérer le formulaire de connexion
 * @return string $message
 */
function connexion(): string
{
    //Test si le formulaire est submit
    if (isset($_POST["submit"])) {
        //Test si les champs sont tous remplis
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            //Nettoyage
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            //bloc try catch pour gérer les erreurs SQL
            try  {
                //test si le compte existe
                if (isUserExistByEmail($email)) {
                    //récupération du compte
                    $user = findUserByEmail($email);
                    //Test si le password est valide
                    if (password_verify($password, $user["password"])) {
                        //Création de la session
                        $_SESSION["idUser"] = $user["idUser"];
                        $_SESSION["connected"] = true;
                        //redirection vers la page d'accueil connecté
                        header('Location: index.php');
                    }
                }
                return "les informations de connexion sont incorrectes";
            } catch (Exception $e) {
                return "Erreur de connexion avec la BDD";
            }
            
        } else {
            return "Veuillez remplir tous les champs de formulaire";
        }
    }
    return "";
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/pico.min.css">
    <link rel="stylesheet" href="public/style.css">
    <title>Connexion</title>
</head>

<body>
    <header class="container-fluid">
        <?php include "navbar.php"; ?>
    </header>
    <main class="container-fluid">

        <form action="" method="post">
            <h2>Se connecter</h2>
            <input type="email" name="email" placeholder="saisir le mail" require>
            <input type="password" name="password" placeholder="saisir le mot de passe" require>
            <input type="submit" value="connexion" name="submit">
            <p class="error"><?= $message ?? "" ?></p>
        </form>
    </main>
</body>

</html>