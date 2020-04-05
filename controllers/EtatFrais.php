<?php
/**
 * Gestion de l'affichage des frais
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
$idVisiteur = $_SESSION['idVisiteur'];
switch ($action) {
    case 'selectMonth':
        $months = $pdo->getLesMoisDisponibles($idVisiteur);
        $lesCles = array_keys($months);
        $monthASelectionner = $lesCles[0];
        include 'vues/header.php';
        include 'vues/listeMois.php';
        break;
    case 'showFrais':
        $currentMonth = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $months = $pdo->getLesMoisDisponibles($idVisiteur);
        $monthASelectionner = $currentMonth;
        include 'vues/header.php';
        include 'vues/listeMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $currentMonth);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $currentMonth);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $currentMonth);
        $numAnnee = substr($currentMonth, 0, 4);
        $numMois = substr($currentMonth, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = toFrenchDate($lesInfosFicheFrais['dateModif']);
        include 'vues/etatFrais.php';
}