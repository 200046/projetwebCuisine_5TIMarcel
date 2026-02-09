<?php
// appel au modèle pour la gestion des recettes
require_once "Models/recetteModel.php";

// récupération du chemin désiré
$uri = $_SERVER["REQUEST_URI"];

if($uri === "/mesRecettes"){
    // rappel de la page d'accueil adaptée avec vérification de l'état de connexion
    $recettes = selectMyRecettes($pdo);

    $title = "Mes Recettes";                                   // titre à afficher dans l'onglet
    $template = "Views/pageAccueil.php";                       // chemin vers la vue demandée
    require_once "Views/base.php";                             // appel de la page de base
} 
elseif ($uri === "/creerRecette") {
    // page pour créer une nouvelle recette
    
} 
// ceci n'est possible que si on dispose d'un id pour la recette => isset($_GET["recetteId"])
elseif (isset($_GET["recetteId"]) && $uri === "/voirRecette?recetteId=" . $_GET["recetteId"]) {
    // rechercher les données de la recette concernée ainsi que les tags correspondants
    $recette = selectOneRecette($pdo);
    $tags = selectTagsActiveRecette($pdo);
    $title = "Détails de la recette";                         // titre à afficher dans l'onglet
    $template = "Views/Recettes/voirRecette.php";             // chemin vers la vue demandée
    require_once "Views/base.php";                            // appel de la page de base
}

// Mise à jour des données d'une recette
elseif (isset($_GET["recetteId"]) && $uri === "/modifierRecette?recetteId=" . $_GET["recetteId"]) {
    // si on a validé des modifications
    if (isset($_POST['btnEnvoi'])) {
        updateRecette($pdo); // mettre à jour la table recette
        // pour mettre à jour les tags, il faut d'abord supprimer les anciens, puis réécrire les nouveaux
        deleteTagsRecette($pdo, $_GET["recetteId"]);
        for ($i = 0; $i < count($_POST["tags"]); $i++) {
            $tagId = $_POST["tags"][$i];
            // attention qu'il ne s'agit plus nécessairement du lastIndex !
            ajouterTagsRecette($pdo, $_GET["recetteId"], $tagId);
        }
        header("location: /mesRecettes");
    }
    // rechercher les données de la recette concernée ainsi que les tags correspondants
    $recette = selectOneRecette($pdo);
    $tagsActiveRecette = selectTagsActiveRecette($pdo);
    $tags = selectAllTags($pdo);
    $title = "Modifier une recette";                          // titre à afficher dans l'onglet
    $template = "Views/Recettes/editerOuCreerRecette.php";    // chemin vers la vue demandée
    require_once "Views/base.php";                            // appel de la page de base
}

// suppression de la recette courante
elseif (isset($_GET["recetteId"]) && $uri === "/supprimerRecette?recetteId=" . $_GET["recetteId"]) {
    // Récupérer la recette d'abord pour l'afficher dans la vue
    $recette = selectOneRecette($pdo);
    
    // Si confirmation de suppression
    if (isset($_POST['confirmerSuppression'])) {
        // attention à l'ordre : supprimer les dépendances d'abord !
        deleteTagsRecette($pdo, $_GET["recetteId"]);
        deleteOneRecette($pdo);
        header("location: /mesRecettes");
        exit();
    }
    
    // Sinon, afficher la page de confirmation
    $title = "Supprimer une recette";
    $template = "Views/Recettes/supprimerRecette.php";
    require_once "Views/base.php";
}