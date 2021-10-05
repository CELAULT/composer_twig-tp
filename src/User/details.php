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

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Détails de l'utilisateur </title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h1>Détails de l'utilisateur <?= $user->getEmail() ?></h1>

                    <p>ID : <?= $user->getId() ?></p>
                    <p>Email : <?= $user->getEmail() ?></p>
                    <p><a href="index.php">Retour</a> <a href="edit.php?id=<?= $user->getId() ?>">Modifier</a></p>
                </section>
            </div>
        </main>
    </body>
</html>