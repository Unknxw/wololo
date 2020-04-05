<?php
/**
 * Index du projet GSB
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Maxence Simon
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$isConnected = isConnected();
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);

//Si non connecte
if (!$isConnected) {
    require 'vues/header.php';
    $uc = 'connexion';
//Si comptable
} elseif (isset($_SESSION['type']) && (empty($uc) && $_SESSION['type'] === 'comptable')) {
    require 'vues/headerComptable.php';
    $uc = 'accueilComptable';
//Si visiteur
} elseif (isset($_SESSION['type']) && (empty($uc) && $_SESSION['type'] === 'visiteur')) {
    require 'vues/header.php';
    $uc = 'accueil';
}

//Switch pour la page
switch ($uc) {
    case 'connexion':
        include 'controllers/Connexion.php';
        break;
    case 'accueil':
        include 'controllers/Accueil.php';
        break;
    case 'accueilComptable' :
        include 'controllers/AccueilComptable.php';
        break;
    case 'manegeFrais':
        include 'controllers/GererFrais.php';
        break;
    case 'stateFrais':
        include 'controllers/EtatFrais.php';
        break;
    case 'suivrePaiement':
        include 'controllers/SuivrePaiement.php';
        break;
    case 'validFrais':
        include 'controllers/ValiderFrais.php';
        break;
    case 'deconnexion':
        include 'controllers/Deconnexion.php';
        break;
}