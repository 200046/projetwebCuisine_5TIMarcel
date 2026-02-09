<?php 
require_once("Models/userModel.php");

// Récupération du chemin désiré
$uri = $_SERVER["REQUEST_URI"];

if ($uri === "/connexion") {
   // Vérifier si l'utilisateur a cliqué sur le bouton du form
   if (isset($_POST['btnEnvoi'])) {
      // Tentative de connexion et de récupération des données de l'utilisateur
      if (connectUser($pdo)) {
         // Redirection vers la page d'accueil
         header("location:/");
         exit();
      }
   }
   $title = "Connexion";
   $template = "Views/Users/connexion.php";
   require_once("Views/base.php");
} elseif ($uri === "/deconnexion") {
   // Nettoyage de la session et retour à l'index
   session_destroy();
   header("location:/");
   exit();
} elseif ($uri === "/inscription") {
   if (isset($_POST['btnEnvoi'])) {
      // Vérif des données encodées
      $messageError = verifEmptyData();
      // S'il n'y a pas d'erreur
      if (!$messageError) {
         // Ajout de l'utilisateur à la base de données
         createUser($pdo);
         // Redirection vers la page de connexion
         header("location:/connexion");
         exit();
      }
   }
   $title = "Inscription";
   $template = "Views/Users/inscription.php";
   require_once("Views/base.php");
} elseif ($uri === "/profil") {
   if (isset($_POST['btnEnvoi'])) {
      // Vérif des données encodées
      $messageError = verifEmptyData();
      // S'il n'y a pas d'erreur
      if (!$messageError) {
         // Modification de l'utilisateur dans la base de données
         updateUser($pdo);
         // Mise à jour des données de session
         updateSession($pdo);
         header("location:/profil");
         exit();
      }
   }
   $title = "Mon profil";
   $template = "Views/Users/InscriptionOrEditProfile.php";
   require_once("Views/base.php");
} elseif ($uri === "/supprimerProfil") {
   // Supprimer d'abord les recettes de l'utilisateur
   deleteTagsRecetteFromUser($pdo);
   deleteAllRecettesFromUser($pdo);
   // Puis supprimer l'utilisateur
   deleteUser($pdo);
   header("location:/deconnexion");
   exit();
}
