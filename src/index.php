<!doctype html>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

        <title>COMPOSER / TWIG</title>
    </head>

    <body>
        <center>
            <h1>COMPOSER / TWIG</h1>

            <?php
                require_once '../vendor/autoload.php';

                use Monolog\Handler\StreamHandler;
                use Monolog\Logger;

                $logger = new Logger('main');
                $logger->pushHandler(new StreamHandler(__DIR__ . '/../log/app.log', Logger::DEBUG));
                $logger->info('First message');
                $loader = new \Twig\Loader\FilesystemLoader('../templates');

                $twig = new \Twig\Environment($loader,
                [
                    'cache' => '../cache',
                ]);

                echo $twig->render('base.html.twig',
                [
                    'title' => 'Essai de Twig',
                    'text' => 'Texte inséré dans la page.',
                ]);

                print('Le message est enregistré dans le fichier ' . __DIR__ . '/../log/app.log');
            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
        </center>
    </body>
</html>