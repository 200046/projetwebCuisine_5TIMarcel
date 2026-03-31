<?php

/*
|--------------------------------------------------------------------------
| Chargement des modèles
|--------------------------------------------------------------------------
*/
require_once "Models/recetteModel.php";
require_once("Models/userModel.php");

/*
|--------------------------------------------------------------------------
| Récupération de l'URL demandée
|--------------------------------------------------------------------------
*/
$uri = $_SERVER["REQUEST_URI"];

/*
|--------------------------------------------------------------------------
| ROUTE : MES RECETTES
|--------------------------------------------------------------------------
*/
if ($uri === "/mesRecettes") {
    $recettes = selectMyRecettes($pdo);
    $title = "Mes Recettes";
    $template = "Views/pageAccueil.php";
    require_once "Views/base.php";
}

/*
|--------------------------------------------------------------------------
| ROUTE : CRÉER UNE RECETTE
|--------------------------------------------------------------------------
*/
elseif ($uri === "/creerRecette") {
    if (isset($_POST["btnEnvoi"])) {
        // La fonction renvoie maintenant rec_id (clé primaire de recette)
        $rec_id = insertRecette($pdo); 
        header("Location: /");
        exit();
    }

    $categories = selectAllCategories($pdo);
    $tags = selectAllTags($pdo);
    $title = "Créer une recette";
    $template = "Views/Recettes/editerOuCreerRecette.php";
    require_once "Views/base.php";
}

/*
|--------------------------------------------------------------------------
| ROUTE : VOIR UNE RECETTE
|--------------------------------------------------------------------------
| URL attendue : /voirrecette?rec_id=...
*/
elseif (isset($_GET["rec_id"]) && str_starts_with($uri, "/voirrecette")) {

    $recette = selectOneRecette($pdo);
    $tags = selectTagsActiveRecette($pdo);

    $title = "Détails de la recette";
    $template = "Views/Recettes/voirRecette.php";
    require_once "Views/base.php";
}

/*
|--------------------------------------------------------------------------
| ROUTE : MODIFIER UNE RECETTE
|--------------------------------------------------------------------------
| URL attendue : /modifierRecette?rec_id=...
*/
elseif (isset($_GET["rec_id"]) && strpos($uri, "/modifierRecette") === 0) {

    $messageSuccess = null;
    $rec_id = (int)$_GET["rec_id"]; // Sécurisation en entier

    if (isset($_POST['btnEnvoi'])) {
        updateRecette($pdo);
        deleteTagsRecette($pdo, $rec_id);

        foreach ($_POST["tags"] ?? [] as $tag_id) {
            ajouterTagsRecette($pdo, $rec_id, (int)$tag_id);
        }

        $messageSuccess = "Recette modifiée avec succès !";
    }

    // On récupère les données à jour pour le formulaire
    $recette = selectOneRecette($pdo);
    $tagsActiveRecette = selectTagsActiveRecette($pdo);
    $tags = selectAllTags($pdo);
    $categories = selectAllCategories($pdo);

    $title = "Modifier une recette";
    $template = "Views/Recettes/editerOuCreerRecette.php";
    require_once "Views/base.php";
}

/*
|--------------------------------------------------------------------------
| ROUTE : SUPPRIMER UNE RECETTE
|--------------------------------------------------------------------------
| URL attendue : /supprimerRecette?rec_id=...
*/
elseif (isset($_GET["rec_id"]) && strpos($uri, "/supprimerRecette") === 0) {

    $rec_id = (int)$_GET["rec_id"];
    $recette = selectOneRecette($pdo);

    if (isset($_POST['confirmerSuppression'])) {
        deleteTagsRecette($pdo, $rec_id);
        deleteOneRecette($pdo);

        header("Location: /mesRecettes");
        exit();
    }

    $title = "Supprimer une recette";
    $template = "Views/Recettes/supprimerRecette.php";
    require_once "Views/base.php";
}