<?php
    // fonction qui ajoute un utilisateur en BDD(utilisateurs)
    function createAccount($bdd, $nom, $prenom , $login , $mdp){
        try{
            $req = $bdd->prepare('INSERT INTO user(name_user, first_name_user, login_user, mdp_user) 
            VALUES(:name_user, :first_name_user, :login_user, :mdp_user)');
            $req->execute(array(
                'name_user' => $nom,
                'first_name_user' =>$prenom,
                'login_user' =>$login,
                'mdp_user' =>$mdp
                ));
        }
        catch(Exception $e)
        {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
        }
    }

    function getUserByInfo($bdd, $mail, $mdp):array {
        try{
            $req = $bdd->prepare("SELECT * FROM user 
            WHERE login_user = :login_user AND mdp_user = :mdp_user");
            $req->execute(array(
                'login_user' => $mail,  
                'mdp_user' => $mdp 
            ));
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        catch(Exception $e)
        {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
        }
    }

?>