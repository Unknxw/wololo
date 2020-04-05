<?php

    $visitors = $pdo->getAllVisiteur();
    if (!isset($_GET['Vid']) && !isset($_GET['mois'])) {
        if (!isset($_GET['search'])){
            include_once 'vues/headerComptable.php';
            include_once 'vues/choisirFraisPaiement.php';
        } else {
            if(!isset($_GET['Vid']) && !isset($_GET['mois']) && isset($_GET['search']) && $_POST['name'] !== ''){
                $leNom = $_POST['name'];
                $visitorsFilter = [];
        
            foreach ($visitors as $visiteur){
                if((strpos(strtolower($visiteur['Vnom']), strtolower($leNom)) !== false) || (strpos(strtolower($visiteur['Vprenom']), strtolower($leNom)) !== false)){
                    array_push($visitorsFilter, $visiteur);
                }
            }
                include_once 'vues/headerComptable.php';
                include_once 'vues/choisirFraisPaiement.php';
           }
        }
        
    }
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
         $lesFiches = $pdo->getLesMoisPaiement($_GET['Vid']);
         include_once 'vues/headerComptable.php';
         include_once 'vues/choisirFraisPaiement.php';
         if(count($lesFiches) === 0){
            ajouterErreur('Aucun fiche de frais pour ce visiteur.');
         } else {
            ajouterErreur('Veuillez choisir un mois.');
         }
    } elseif (isset($_GET['Vid']) && isset($_GET['mois'])){
        $lesFiches = $pdo->getLesMoisPaiement($_GET['Vid']);
        $fiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
        $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
        $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
        $Infos = $pdo->getLesInfosFicheFrais($_GET['Vid'], $_GET['mois']);
        include_once 'vues/headerComptable.php';
        include_once 'vues/choisirFraisPaiement.php';
        include_once 'vues/fichePaiement.php';
    }