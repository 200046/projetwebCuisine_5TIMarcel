<?php
require_once("Models/userModel.php");
$uri = $_SERVER["REQUEST_URI"];

/*
|--------------------------------------------------------------------------
| ROUTE : PAGE D'ADMINISTRATION
|--------------------------------------------------------------------------
*/
if ($uri === "/administration" || str_starts_with($uri, "/administration?")) {

    if (!isset($_SESSION["utilisateur"])) {
        header("Location: /connexion");
        exit();
    }

    $title = "Page d'Administration";

    if (!verifAdmin($pdo, $_SESSION["utilisateur"]->uti_id)) {
        $error = "Accès non autorisé. Vous devez être administrateur.";
        $template = "Views/Gestion/error.php";
        require_once("Views/base.php");
        exit();
    }

    $message = null;
    $messageType = null;

    // CORRECTION : On utilise uti_id au lieu de id
    if (isset($_GET['action']) && isset($_GET['uti_id'])) {

        $action = $_GET['action'];
        $id = $_GET['uti_id'];

        if ($id == $_SESSION["utilisateur"]->uti_id) {
            $message = "Vous ne pouvez pas suspendre votre propre compte";
            $messageType = "error";
        } else {
            if ($action === 'suspendre') {
                suspendreUtilisateur($pdo, $id);
                $message = "Utilisateur suspendu avec succès";
                $messageType = "success";
            } elseif ($action === 'reactiver') {
                reactiverUtilisateur($pdo, $id);
                $message = "Utilisateur réactivé avec succès";
                $messageType = "success";
            } elseif ($action === 'promouvoir') {
                promouvoirModerateur($pdo, $id);
                $_SESSION['flash_message'] = "Utilisateur promu modérateur avec succès";
                $_SESSION['flash_type'] = "success";
            } elseif ($action === 'retrograder') {
                retrograderUtilisateur($pdo, $id);
                $_SESSION['flash_message'] = "Utilisateur rétrogradé avec succès";
                $_SESSION['flash_type'] = "success";
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
            // CORRECTION : on utilise uti_id et on retire le "cat_" devant nombre
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
| ROUTE : VOIR UN UTILISATEUR (ADMIN)
|--------------------------------------------------------------------------
*/
// CORRECTION : L'URL doit être /admVoirUser?uti_id=...
elseif (str_starts_with($uri, "/admVoirUser") && isset($_GET['uti_id'])) {

    if (!isset($_SESSION["utilisateur"])) {
        header("Location: /connexion");
        exit();
    }

    if (!verifAdmin($pdo, $_SESSION["utilisateur"]->uti_id)) {
        header("Location: /");
        exit();
    }

    $message = null;
    $messageType = null;
    $target_uti_id = (int)$_GET['uti_id'];

    // CORRECTION : suppression d'une recette (on utilise rec_id)
    if (isset($_GET['action']) && $_GET['action'] === 'supprimerRecette' && isset($_GET['rec_id'])) {
        deleteTagsRecette($pdo, (int)$_GET['rec_id']);
        deleteOneRecette($pdo);
        $message = "Recette supprimée avec succès";
        $messageType = "success";
    }

    // Suspension / Réactivation
    if (isset($_GET['action']) && $_GET['action'] === 'suspendre') {
        suspendreUtilisateur($pdo, $target_uti_id);
    }
    if (isset($_GET['action']) && $_GET['action'] === 'reactiver') {
        reactiverUtilisateur($pdo, $target_uti_id);
    }

    $userVu = getUserById($pdo, $target_uti_id);
    $recettes = getRecettesByUserId($pdo, $target_uti_id);

    $title = "Voir l'utilisateur";
    $template = "Views/Gestion/voirUser.php";
    require_once("Views/base.php");
}