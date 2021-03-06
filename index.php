<?php
require 'controller/frontend/controller.php';

try{
    if(isset($_GET['page'])){ // On vérifier si l'action a été consulté , si oui on l'affecte
        switch ($_GET['page']) {
            case 'article_list':
                (isset($_GET['category_id']) ? articles_list($_GET['category_id']) : articles_list());
                break;
            case 'article':
                article(); 
                break;
            case 'login_register':
                (isset($_POST['register']) ? register() : login() );
                break;
            case 'user_profile':
                update_profile();
                break;
            
            default:
                // On redirige le visiteur vers la page d'accueil
                header('location:index.php');
                exit;
        }
    }
    else{
        // si on a recu le parametre logout en url
        if (isset($_GET['logout']) AND isset($_SESSION['user'])){
            // on deconecte
            unset($_SESSION["user"]);
            // On redirige le visiteur vers la page d'accueil
            header('location:index.php');
            exit;
        }
        articles_list('', 3); //on affiche les trois derniers
    }
}
catch (Exception $e){
    echo 'Erreur : ' . $e->getMessage();
}