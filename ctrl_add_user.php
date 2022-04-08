<?php
    /*----------------------------------------
                    IMPORT
    ----------------------------------------*/
    // header
    include './view/view_header.php';

    //importer la connexion à la BDD
    include './utils/connectBdd.php';
    // importer le model
    include './model/model_user.php';
    // importer la view(interface)
    include './view/view_add_user.php';
    //footer
    // include './view/view_footer.php';

    if(isset($_POST['name_user'])AND isset($_POST['first_name_user'])AND isset($_POST['login_user'])AND isset($_POST['mdp_user']) AND
        $_POST['name_user'] != "" AND $_POST['first_name_user'] !="" AND
        $_POST['login_user'] != "" AND
        $_POST['mdp_user'] != ""){
            createAccount($bdd, $_POST['name_user'], $_POST['first_name_user'], $_POST['login_user'], md5($_POST['mdp_user']));
            echo "le compte à été créer";
        }
        else{
            echo 'Veuillez remplir les champs du  formulaire';
        }
?>