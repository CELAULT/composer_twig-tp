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
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = strip_tags($_POST['email']);
                $passwd = strip_tags($_POST['passwd']);
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($passwd);
                if ($manager->add($user)) {
                    $_SESSION['message'] = "Utilisateur ajouté";
                }
                
                else {
                    $_SESSION['error'] = "Une erreur est intervenue";
                };

                header('Location: index.php');
            }
            
            else {
                $_SESSION['error'] = "Le formulaire est incomplet";

                header('Location: index.php');
            }
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

        <title>Ajouter un Utilisateur</title>

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

                    <h1>Ajouter un Utilisateur</h1>

                    <form method="post">
                        <div class="form-group">
                            <label for="email">E-Mail</label>

                            <input type="text" id="email" name="email" class="form-control">

                            <label for="passwd">Mot de Passe</label>

                            <input type="password" id="passwd" name="passwd" class="form-control">

                        </div>
                        
                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </section>
            </div>
        </main>
    </body>
</html>