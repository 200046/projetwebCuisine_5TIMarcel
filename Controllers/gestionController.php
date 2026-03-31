<?php
require_once("Models/userModel.php");
require_once("Models/categorieModel.php");
require_once("Models/tagModel.php");

$uri = $_SERVER["REQUEST_URI"];

/*
|--------------------------------------------------------------------------
| ROUTE : PAGE D'ADMINISTRATION (Gestion Utilisateurs)
|--------------------------------------------------------------------------
*/
if ($uri === "/administration" || str_starts_with($uri, "/administration?")) {

    if (!isset($_SESSION["utilisateur"])) {
        header("Location: /connexion");
        exit();
    }

    if (!verifAdmin($pdo, $_SESSION["utilisateur"]->uti_id)) {
        $error = "Accès non autorisé. Vous devez être administrateur.";
        $template = "Views/Gestion/error.php";
        require_once("Views/base.php");
        exit();
    }

    $title = "Page d'Administration";
    $message = null;
    $messageType = null;

    // Gestion des actions sur les utilisateurs
    if (isset($_GET['action']) && isset($_GET['uti_id'])) {
        $action = $_GET['action'];
        $id = (int)$_GET['uti_id'];

        if ($id == $_SESSION["utilisateur"]->uti_id) {
            $message = "Vous ne pouvez pas modifier votre propre compte admin ici.";
            $messageType = "error";
        } else {
            if ($action === 'suspendre') {
                suspendreUtilisateur($pdo, $id);
            } elseif ($action === 'reactiver') {
                reactiverUtilisateur($pdo, $id);
            } elseif ($action === 'promouvoir') {
                promouvoirModerateur($pdo, $id);
            } elseif ($action === 'retrograder') {
                retrograderUtilisateur($pdo, $id);
            }
            header("Location: /administration");
            exit();
        }
    }

    $utilisateurs = getAllUtilisateurs($pdo);
    $utilisateursData = [];

    foreach ($utilisateurs as $user) {
        $utilisateursData[] = [
            'user' => $user,
            'uti_est_suspendu' => $user->uti_est_suspendu,
            'nbRecettes' => countRecettesByUser($pdo, $user->uti_id) 
        ];
    }

    $template = "Views/Gestion/admin.php";
    require_once("Views/base.php");
}

/*
|--------------------------------------------------------------------------
| ROUTE : PAGE DE MODÉRATION
|--------------------------------------------------------------------------
*/
elseif ($uri === "/moderation") {
    if (!isset($_SESSION["utilisateur"])) {
        header("Location: /connexion");
        exit();
    }

    if ($_SESSION["utilisateur"]->uti_role !== 'moderateur' && $_SESSION["utilisateur"]->uti_role !== 'admin') {
        header("Location: /");
        exit();
    }

    $utilisateurs = getAllUtilisateurs($pdo);
    $utilisateursData = [];

    foreach ($utilisateurs as $user) {
        $utilisateursData[] = [
            'user' => $user,
            'uti_est_suspendu' => $user->uti_est_suspendu,
            'nbRecettes' => countRecettesByUser($pdo, $user->uti_id)
        ];
    }

    $title = "Page de modération";
    $template = "Views/Gestion/moderation.php";
    require_once("Views/base.php");
}

/*
|--------------------------------------------------------------------------
| ROUTE : VOIR UN UTILISATEUR (DÉTAILS ADMIN)
|--------------------------------------------------------------------------
*/
elseif (str_starts_with($uri, "/admVoirUser") && isset($_GET['uti_id'])) {

    if (!isset($_SESSION["utilisateur"]) || !verifAdmin($pdo, $_SESSION["utilisateur"]->uti_id)) {
        header("Location: /");
        exit();
    }

    $target_uti_id = (int)$_GET['uti_id'];

    // Action : suppression d'une recette depuis la vue détail
    if (isset($_GET['action']) && $_GET['action'] === 'supprimerRecette' && isset($_GET['rec_id'])) {
        $rec_id = (int)$_GET['rec_id'];
        deleteTagsRecette($pdo, $rec_id); // Nettoyage table pivot tags_recettes
        deleteOneRecette($pdo);           // Suppression table recettes
        header("Location: /admVoirUser?uti_id=" . $target_uti_id);
        exit();
    }

    $userVu = getUserById($pdo, $target_uti_id);
    $recettes = getRecettesByUserId($pdo, $target_uti_id);

    $title = "Détails Utilisateur";
    $template = "Views/Gestion/voirUser.php";
    require_once("Views/base.php");
}

/*
|--------------------------------------------------------------------------
| ROUTE : GESTION DES TAGS
|--------------------------------------------------------------------------
*/
elseif ($uri === "/gestionTags" || str_starts_with($uri, "/gestionTags?")) {
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']->uti_role !== 'admin') {
        header("Location: /");
        exit();
    }

    $messageErreur = "";

    // Suppression
    if (isset($_GET['action']) && $_GET['action'] === 'supprTag' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if (countRecettesByTag($pdo, $id) > 0) {
            $messageErreur = "Action annulée : ce tag est utilisé par des recettes.";
        } else {
            deleteTag($pdo, $id);
            header("Location: /gestionTags");
            exit();
        }
    }

    // Ajout
    if (isset($_POST['btnAjouterTag']) && !empty($_POST['nouveau_tag'])) {
        addTag($pdo, $_POST['nouveau_tag']);
        header("Location: /gestionTags");
        exit();
    }

    // Update
    if (isset($_POST['btnUpdateTag']) && !empty($_POST['update_nom'])) {
        updateTag($pdo, (int)$_POST['tag_id'], $_POST['update_nom']);
        header("Location: /gestionTags");
        exit();
    }

    $tags = getAllTags($pdo);
    $title = "Gestion des Tags";
    $template = "Views/Gestion/gestionTags.php";
    require_once("Views/base.php");
}

/*
|--------------------------------------------------------------------------
| ROUTE : GESTION DES CATÉGORIES
|--------------------------------------------------------------------------
*/
elseif ($uri === "/gestionCategories" || str_starts_with($uri, "/gestionCategories?")) {
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']->uti_role !== 'admin') {
        header("Location: /");
        exit();
    }

    $messageErreur = "";

    // Suppression
    if (isset($_GET['action']) && $_GET['action'] === 'supprCat' && isset($_GET['id'])) {
        $id_a_supprimer = (int)$_GET['id'];
        $nbRecettes = countRecettesByCategorie($pdo, $id_a_supprimer);

        if ($nbRecettes > 0) {
            $messageErreur = "Action annulée : " . $nbRecettes . " recette(s) utilisent cette catégorie.";
        } else {
            deleteCategorie($pdo, $id_a_supprimer);
            header("Location: /gestionCategories");
            exit();
        }
    }

    // Ajout
    if (isset($_POST['btnAjouter']) && !empty($_POST['nouveau_nom'])) {
        addCategorie($pdo, $_POST['nouveau_nom']);
        header("Location: /gestionCategories");
        exit();
    }

    // Update
    if (isset($_POST['btnUpdate']) && !empty($_POST['update_nom'])) {
        updateCategorie($pdo, (int)$_POST['cat_id'], $_POST['update_nom']);
        header("Location: /gestionCategories");
        exit();
    }

    $categories = getAllCategories($pdo);
    $title = "Gestion des Catégories";
    $template = "Views/Gestion/gestionCategories.php";
    require_once("Views/base.php");
}