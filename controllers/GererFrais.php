<?php
/**
 * Gestion des frais
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

$idVisiteur = $_SESSION['idVisiteur'];
$month = getMonths(date('d/m/Y'));
$numAnnee = substr($month, 0, 4);
$numMois = substr($month, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'saisirFrais':
    if ($pdo->estPremierFraisMois($idVisiteur, $month)) {
        $pdo->creeNouvellesLignesFrais($idVisiteur, $month);
    }
    include 'vues/header.php';
    break;
case 'validerMajFraisForfait':
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    if (lesQteFraisValides($lesFrais)) {
        $pdo->majFraisForfait($idVisiteur, $month, $lesFrais);
        include 'vues/header.php';
    } else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/header.php';
    }
    break;
case 'validerCreationFrais':
    $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    valideInfosFrais($dateFrais, $libelle, $montant);
    if (nbErreurs() != 0) {
        include 'vues/header.php';
    } else {
        $pdo->creeNouveauFraisHorsForfait(
            $idVisiteur,
            $month,
            $libelle,
            $dateFrais,
            $montant
        );
        include 'vues/header.php';
    }
    break;
case 'supprimerFrais':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    $pdo->supprimerFraisHorsForfait($idFrais);
    include 'vues/header.php';
    break;
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $month);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $month);
require 'vues/listeFraisForfait.php';
require 'vues/listeFraisHorsForfait.php';