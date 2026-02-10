<?php
require_once "Models/recetteModel.php";

$uri = $_SERVER["REQUEST_URI"];

if($uri === "/mesRecettes"){
    $recettes = selectMyRecettes($pdo);

    $title = "Mes Recettes";                                   // titre à afficher dans l'onglet
    $template = "Views/pageAccueil.php";                       // chemin vers la vue demandée
    require_once "Views/base.php";                             // appel de la page de base
} 
elseif ($uri === "/creerRecette") {
    
} 
elseif (isset($_GET["recetteId"]) && $uri === "/voirRecette?recetteId=" . $_GET["recetteId"]) {
    $recette = selectOneRecette($pdo);
    $tags = selectTagsActiveRecette($pdo);
    $title = "Détails de la recette";                         // titre à afficher dans l'onglet
    $template = "Views/Recettes/voirRecette.php";             // chemin vers la vue demandée
    require_once "Views/base.php";                            // appel de la page de base
}

elseif (isset($_GET["recetteId"]) && $uri === "/modifierRecette?recetteId=" . $_GET["recetteId"]) {
    if (isset($_POST['btnEnvoi'])) {
        updateRecette($pdo); // mettre à jour la table recette
        deleteTagsRecette($pdo, $_GET["recetteId"]);
        for ($i = 0; $i < count($_POST["tags"]); $i++) {
            $tagId = $_POST["tags"][$i];
            ajouterTagsRecette($pdo, $_GET["recetteId"], $tagId);
        }
        header("location: /mesRecettes");
    }
    $recette = selectOneRecette($pdo);
    $tagsActiveRecette = selectTagsActiveRecette($pdo);
    $tags = selectAllTags($pdo);
    $title = "Modifier une recette";                          // titre à afficher dans l'onglet
    $template = "Views/Recettes/editerOuCreerRecette.php";    // chemin vers la vue demandée
    require_once "Views/base.php";                            // appel de la page de base
}

elseif (isset($_GET["recetteId"]) && $uri === "/supprimerRecette?recetteId=" . $_GET["recetteId"]) {
    $recette = selectOneRecette($pdo);
    
    if (isset($_POST['confirmerSuppression'])) {
        deleteTagsRecette($pdo, $_GET["recetteId"]);
        deleteOneRecette($pdo);
        header("location: /mesRecettes");
        exit();
    }
    
    $title = "Supprimer une recette";
    $template = "Views/Recettes/supprimerRecette.php";
    require_once "Views/base.php";
}