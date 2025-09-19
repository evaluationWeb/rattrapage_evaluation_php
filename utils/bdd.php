<?php
    /**
     * Méthode qui établie la connexion à la BDD avec PDO
     * @return PDO Objet PDO
     */
    function connectBDD(): PDO {

        return new \PDO('mysql:host=' . BDD_SERVER . ';dbname=' . BDD_NAME .'',
            BDD_LOGIN,
            BDD_PASSWORD, 
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    }