<?php

if ($isConnected) {
    include 'vues/accueilComptable.php';
} else {
    include 'vues/connexion.php';
}