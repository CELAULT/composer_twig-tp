<?php
    session_start();

    require_once('Manager/UsersManager.php');
    require_once('Entity/User.php');
    require_once("../conf.php");

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $manager = new UsersManager($db);

        if ($_POST) {
            if (isset($_POST['id']) && !empty($_POST['id'])&& isset($_POST['email']) && !empty($_POST['email'])) {
                $id = strip_tags($_POST['id']);
                $email = strip_tags($_POST['email']);
                $user = $manager->getOne($id);

                if (!$user) {
                    $_SESSION['error'] = "Cet id n'existe pas";

                    header('Location: index.php');

                    exit();
                }

                $user->setEmail($email);
                $manager->update($user);
                $_SESSION['message'] = "Utilisateur  modifié";

                header('Location: index.php');
            }
            
            else {
                $_SESSION['error'] = "Le formulaire est incomplet";

                header('Location: index.php');
            }
        }

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

        <title>Modifier un utilisateur</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <?php
                        if (!empty($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                            
                            $_SESSION['error'] = "";
                        }
                    ?>

                    <h1>Modifier un utilisateur</h1>

                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            
                            <input type="text" id="email" name="email" class="form-control" value="<?= $user->getEmail() ?>">
                            
                            <label for="email">Rôles</label>
                            
                            <input type="text" id="roles" name="roles" class="form-control" value="<?= $user->getRoles() ?>">
                        </div>

                        <input type="hidden" value="<?= $user->getId() ?>" name="id">

                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </section>
            </div>
        </main>
    </body>
</html>