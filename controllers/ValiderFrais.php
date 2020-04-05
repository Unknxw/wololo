<?php
    include_once 'vues/headerComptable.php';

    $visitors = $pdo->getAllVisiteur();
    if (!isset($_GET['Vid']) && !isset($_GET['mois']) && isset($_GET['search']) && $_POST['name'] !== '') {
        $leNom = $_POST['name'];
        $visitorsFilter = [];

        foreach ($visitors as $unVisiteur) {
            if ((strpos(strtolower($unVisiteur['Vnom']), strtolower($leNom)) !== false) || (strpos(strtolower($unVisiteur['Vprenom']), strtolower($leNom)) !== false)) {
                array_push($visitorsFilter, $unVisiteur);
            }
        }
    }
    if (isset($_GET['Vid']) && !isset($_GET['mois'])) {
        $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
        include_once 'vues/headerComptable.php';
        include_once 'vues/choixFrais.php';
        if (count($lesFiches) === 0) {
            echo '<h3 style="color:orange">Aucune fiche de frais pour ce visiteur.</h2>';
        } else {
            echo '<h3 style="color:orange">Veuillez choisir un mois.</h2>';
        }
    } else if (isset($_GET['Vid']) && isset($_GET['mois']) && !isset($_GET['maj'])) {
        $lesFiches = $pdo->getLesMoisDisponibles($_GET['Vid']);
        $fiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
        $horsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
        $justificatifs = $pdo->getNbjustificatifs($_GET['Vid'], $_GET['mois']);
        include_once 'vues/choixFrais.php';
        include_once 'vues/file.php';
    } else if (isset($_GET['Vid']) && isset($_GET['mois']) && isset($_GET['maj'])) {
        if ($_GET['maj'] === 'fraisForfait') {
            if (isset($_POST['discard'])) {
                $fiche = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
                header("Refresh:0; url=index.php?uc=validFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
            } else {
                $maj = array('ETP' => $_POST['ETP'], 'KM' => $_POST['KM'], 'NUI' => $_POST['NUI'], 'REP' => $_POST['REP']);
                $pdo->majFraisForfait($_GET['Vid'], $_GET['mois'], $maj);
                header("Refresh:0; url=index.php?uc=validFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
            }
        } elseif ($_GET['maj'] === 'fraisHorsForfait') {

            if (isset($_POST['discard'])) {
                $fiche = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
                header("Refresh:0; url=index.php?uc=validFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
            } else {
                $pdo->majFraisHorsForfait($_GET['Vid'], $_GET['mois'], $_POST['libelle'], $_POST['date'], $_POST['montant'], $_GET['fraisId']);
                header("Refresh:0; url=index.php?uc=validFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
            }
        } elseif ($_GET['maj'] === 'validationFiche') {

            if (isset($_POST['discard'])) {
                header("Refresh:0; url=index.php?uc=validFrais&Vid=" . $_GET['Vid'] . "&mois=" . $_GET['mois']);
            } else {
                $pdo->majEtatFicheFrais($_GET['Vid'], $_GET['mois'], 'VA');
                $lesFrais = $pdo->getLesFraisForfait($_GET['Vid'], $_GET['mois']);
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_GET['Vid'], $_GET['mois']);
                $pdo->calculTotalFrais($_GET['Vid'], $_GET['mois'], $lesFrais, $lesFraisHorsForfait);
                header("Refresh:0; url=index.php?uc=validFraiss&Vid=" . $_GET['Vid']);
            }

        }
    } elseif (!isset($_GET['Vid']) && !isset($_GET['mois'])) {
        include_once 'vues/headerComptable.php';
        include_once 'vues/choixFrais.php';
    }