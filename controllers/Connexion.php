<?php
/**
 * Gestion de la connection
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
    $uc = 'connexion';
}

switch ($action) {
    case 'envoieConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);

        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        $comptable = $pdo->getInfosComptable($login, $mdp);
        if (!is_array($comptable) && !is_array($visiteur)) {
            ajouterErreur('Login ou mot de passe incorrect');
            include 'vues/connexion.php';
        } else {
            if (is_array($visiteur)) {
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                $type = 'visiteur';
            } else {
                $id = $comptable['id'];
                $nom = $comptable['nom'];
                $prenom = $comptable['prenom'];
                $type = 'comptable';
            }
            connect($id, $nom, $prenom, $type);
            header('Location: index.php');
        }
        break;
    default:
        include 'vues/connexion.php';
        break;
}