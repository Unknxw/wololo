<?php
/**
 * Gestion de la déconnection
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'ceconnexion';
}

switch ($action) {
case 'envoieDeconnexion':
    include 'vues/header.php';
    include 'vues/deconnexion.php';
    break;
case 'validDeconnexion':
    if (isConnected()) {
        include 'vues/deconnexion.php';
    } else {
        ajouterErreur("Vous devez être connecter pour pouvoir vous déconnecter.");
        include 'vues/connexion.php';
    }
    break;
default:
    include 'vues/connexion.php';
    break;
}