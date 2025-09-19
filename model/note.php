<?php


    /**
     * Méthode qui ajoute une note en BDD
     * @param array $note tableau de note
     * @return void ne retourne rien
     * @throws Exception $e erreur SQL
     */
    function saveNote(array $note): void {

        try {
            //Requête SQL
            $request = "INSERT INTO note(title, content, created_at, id_users)
            VALUE(?,?,?,?)";
            //préparation
            $req = connectBDD()->prepare($request);
            //bind des paramètres
            $req->bindParam(1, $note["title"], PDO::PARAM_STR);
            $req->bindParam(2, $note["content"], PDO::PARAM_STR);
            $req->bindParam(3, $note["created_at"], PDO::PARAM_STR);
            $req->bindParam(5, $note["idUser"], PDO::PARAM_INT);
            //exécution de la requête
            $req->execute();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * Méthode qui retourne la liste des notes d'un utilsiateur (idUsers)
     * @param int $idUsers
     * @return array tableau de note
     * @throws Exception $e erreur SQL
     */
    function findAllNote(int $idUser): array {
        try {
            //Requête SQL avec 2 jointures categoy et users
            $request = "SELECT n.id_note, n.title, n.content, n.created_at, u.id_users FROM note AS n
            INNER JOIN users AS u ON n.id_users = u.id_users WHERE n.id_users = ? ORDER BY b.title";
            //préparation
            $req = connectBDD()->prepare($request);
            //bind du paramètre idUsers
            $req->bindParam(1, $idUser, PDO::PARAM_INT);
            //exécution de la requête
            $req->execute();
            //retourne un tableau de livres
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

