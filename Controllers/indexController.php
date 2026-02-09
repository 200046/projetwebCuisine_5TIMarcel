<?php

require_once("Models/recetteModel.php");
$uri = $_SERVER["REQUEST_URI"];

if ($uri === "/index.php" || $uri === "/") {
    // Récuperer toutes les données de la table school 
    $recettes = selectAllRecettes($pdo);
    $title = "Page d'accueil";
    $template = "Views/pageAccueil.php";
    require_once("Views/base.php");
}
