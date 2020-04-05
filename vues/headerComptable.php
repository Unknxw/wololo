<?php
/**
 * Vue entete pour les comptables
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title> 
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="./styles/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php
            $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
            if ($isConnected) {
                ?>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1>
                            <img src="./images/logo.jpg" class="img-responsive" 
                                 alt="Laboratoire Galaxy-Swiss Bourdin" 
                                 title="Laboratoire Galaxy-Swiss Bourdin">
                        </h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right orange" role="tablist">
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Accueil
                                </a>
                            </li>
                            <li <?php if ($uc == 'validFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=validFrais">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Valider les fiches de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'suivrePaiement') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=suivrePaiement">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Suivre le paiement des fiches de frais
                                </a>
                            </li>
                            <li 
                            <?php if ($uc == 'disconnect') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=deconnexion&action=envoieDeconnexion">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    Déconnection
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            } else {
                ?>   
                <h1>
                    <img src="./images/logo.jpg"
                         class="img-responsive center-block"
                         alt="Laboratoire Galaxy-Swiss Bourdin"
                         title="Laboratoire Galaxy-Swiss Bourdin">
                </h1>
                <?php
            }
