<?php
include './view/view_header.php';
include './view/view_index.php';
include './utils/connectBdd.php';
include './model/model_user.php';

?>

<?php
    //session
    session_start();

    //test si le bouton submit à été cliqué
    if(isset($_POST['envoi'])){
        //test si les champs sont remplis
        if(isset($_POST['name_user']) AND isset($_POST['mdp_user']) AND
        !empty($_POST['name_user']) AND !empty($_POST['mdp_user'])){
            $mail = $_POST['name_user'];
            $mdp = $_POST['mdp_user'];
            //hash mdp en md5
            $mdp = md5($mdp);
            //récupération des informations utilisateur (array)
            $info = getUserByInfo($bdd, $mail, $mdp);
            //test si les valeurs correspondent (bdd et formulaire)
            if($mail == $info[0]['login_user'] AND $mdp == $info[0]['mdp_user']){
                //création des supers globale SESSION
                $_SESSION['id'] = $info[0]['id_user'];
                $_SESSION['nom'] = $info[0]['name_user'];
                $_SESSION['prenom'] = $info[0]['first_name_user'];
                $_SESSION['login'] = $info[0]['login_user'];
                $_SESSION['connected'] = true;
                //redirection
                header('Location: ./index.php?connected');
            }
            //sinon informations de connexion incorrectes
            else{
                //redirection
                header('Location: ./index.php?invalid');
            }
        }
        //sinon champs du formulaire vides ou incomplets
        else{
            //redirection
            header('Location: ./index.php?empty');
        }
    }
    //variable message
    $msg = "";
    //gestion des erreurs
    if(isset($_GET['deconnected'])){
        echo 'Deconnecté !!!';
    }
    if(isset($_GET['invalid'])){
        echo 'informations incorrectes!!!';
    }
    if(isset($_GET['connected'])){
        echo 'Utilisateur connecté !!!';
    }
    if(isset($_GET['empty'])){
        echo 'Veuillez remplir les champs du formulaire !!!';
    }
    //script gestion des messages d'erreurs en JS
    echo '<script>
        console.log("'.$msg.'");
        setMessage("'.$msg.'");
    </script>';     
?>