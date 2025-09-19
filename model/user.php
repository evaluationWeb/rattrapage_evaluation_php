<?php
    /**
     * Méthode qui vérifie si un user existe en BDD avec son email
     * @param email string email de l'utilisateur
     * @return bool true si existe sion false
     * @throws bool false si erreur SQL
     */
    function isUserExistByEmail(string $email): bool {
        try {
                //Récupération de la valeur de name (category)
                $email = $email;
                //Ecrire la requête SQL
                $request = "SELECT u.id_users FROM users AS u WHERE u.email = ?";
                //préparer la requête
                $req = connectBDD()->prepare($request);
                //assigner le paramètre
                $req->bindParam(1, $email, PDO::PARAM_STR);
                //exécuter la requête
                $req->execute();
                //récupérer le resultat
                $data = $req->fetch(PDO::FETCH_ASSOC);
                //Test si l'enrgistrement est vide
                if (empty($data)) {
                    return false;
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
    }
    
    /**
     * Méthode qui  ajoute un user en BDD
     * @param array $user tableau de l'utilisateur
     * @return void ne retrourne rien
     * @throws Exception erreur SQL 
     */
    function saveUser(array $user): void {
        try {
                //Récupération des données de l'utilisateur
                $firstname = $user["firstname"];
                $lastname = $user["lastname"];
                $email = $user["email"];
                $password = $user["password"];
                $request = "INSERT INTO users(firstname, lastname, email, password) VALUE (?,?,?,?)";

                //prépararation de la requête
                $req = connectBDD()->prepare($request);
                //bind param
                $req->bindParam(1, $firstname, \PDO::PARAM_STR);
                $req->bindParam(2, $lastname, \PDO::PARAM_STR);
                $req->bindParam(3, $email, \PDO::PARAM_STR);
                $req->bindParam(4, $password, \PDO::PARAM_STR);
        
                //éxécution de la requête
                $req->execute();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
    }
        /**
     * Méthode qui vérifie si un user existe en BDD avec son email
     * @param email string email de l'utilisateur
     * @return array retourne le tableau de l'utilisateur
     */
    function findUserByEmail(string $email,): array
    {
        try {
            //Ecrire la requête SQL
            $request = "SELECT u.id_users AS idUser, u.firstname, u.lastname, u.password, u.email FROM users AS u WHERE u.email = ?";
            //préparer la requête
            $req = connectBDD()->prepare($request);
            //assigner le paramètre
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            //exécuter la requête
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
