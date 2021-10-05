<?php
    session_start();

    require_once('Manager/UsersManager.php');
    require_once('Entity/User.php');
    require_once("../conf.php");

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $manager = new UsersManager($db);

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = strip_tags($_GET['id']);
            $user = $manager->getOne($id);

            if (!$user) {
                $_SESSION['error'] = "Cet id n'existe pas";

                header('Location: index.php');

                exit();
            }

            if ($manager->remove($user)) {
                $_SESSION['message'] = "Utilisateur supprimé";
            }
            
            else {
                $_SESSION['error'] = "Une erreur est intervenue";
            };

            header('Location: index.php');
        }
        
        else {
            $_SESSION['error'] = "URL invalide";

            header('Location: index.php');
            
            exit();
        }
    }
    
    catch (PDOException $e) {
        print('<br/>Erreur de connexion : ' . $e->getMessage());
    }
?>