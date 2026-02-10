<?php 
// Fonction pour récupérer toutes les recettes
function selectAllRecettes($pdo) {
    try {
        $query = 'SELECT * FROM recette';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute();
        $recettes = $selectRecette->fetchAll();
        return $recettes;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// Fonction pour supprimer les tags des recettes d'un utilisateur
function deleteTagsRecetteFromUser($dbh) 
{
    try {
        $query = 'DELETE FROM tag_recette WHERE recetteId IN (SELECT recetteId FROM recette WHERE utilisateurId = :utilisateurId)';
        $deleteAllTagsFromId = $dbh->prepare($query);
        $deleteAllTagsFromId->execute([
            'utilisateurId' => $_SESSION["utilisateur"]->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// Fonction pour supprimer toutes les recettes d'un utilisateur
function deleteAllRecettesFromUser($pdo) {
    try {
        $query = 'DELETE FROM recette WHERE utilisateurId = :utilisateurId';
        $deleteAllRecettesFromId = $pdo->prepare($query);
        $deleteAllRecettesFromId->execute([
            'utilisateurId' => $_SESSION["utilisateur"]->id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function selectMyRecettes($pdo)
{
    try {
        $query = 'SELECT * FROM recette WHERE utilisateurId = :utilisateurId';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'utilisateurId' => $_SESSION["utilisateur"]->id
        ]);
        $recettes = $selectRecette->fetchAll();
        return $recettes;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function selectAllCategories($pdo)
{
    try {
        $query = 'SELECT * FROM categorie';
        $selectCategories = $pdo->prepare($query);
        $selectCategories->execute();
        $categories = $selectCategories->fetchAll();
        return $categories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectAllTags($pdo)
{
    try {
        $query = 'SELECT * FROM tag';
        $selectTags = $pdo->prepare($query);
        $selectTags->execute();
        $tags = $selectTags->fetchAll();
        return $tags;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectOneRecette($pdo)
{
    try {
        $query = 'SELECT * FROM recette WHERE recetteId = :recetteId';
        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'recetteId' => $_GET["recetteId"]
        ]);
        $recette = $selectRecette->fetch();
        return $recette;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function selectTagsActiveRecette($pdo)
{
    try {
        $query = 'SELECT * FROM tag WHERE tagId IN (SELECT tagId FROM tag_recette WHERE recetteId = :recetteId)';
        $selectTags = $pdo->prepare($query);
        $selectTags->execute([
            'recetteId' => $_GET["recetteId"]
        ]);
        $tags = $selectTags->fetchAll();
        return $tags;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function updateRecette($dbh)
{
    try {
        $query = 'UPDATE recette SET 
                  recetteTitre = :titre, 
                  recetteDescription = :description, 
                  recetteIngredients = :ingredients, 
                  recetteEtapes = :etapes, 
                  recetteTempsPreparation = :temps_preparation, 
                  recetteDifficulte = :difficulte, 
                  recetteCategorieId = :categorieId, 
                  recetteImage = :image 
                  WHERE recetteId = :recetteId';
        
        $updateRecetteFromId = $dbh->prepare($query);
        $updateRecetteFromId->execute([
            'titre' => $_POST["titre"],
            'description' => $_POST["description"],
            'ingredients' => $_POST["ingredients"],
            'etapes' => $_POST["etapes"],
            'temps_preparation' => $_POST["temps_preparation"],
            'difficulte' => $_POST["difficulte"],
            'categorieId' => $_POST["categorieId"],
            'image' => $_POST["image"],
            'recetteId' => $_GET["recetteId"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function deleteTagsRecette($dbh, $recetteId)
{
    try {
        $query = 'DELETE FROM tag_recette WHERE recetteId = :recetteId';
        $deleteTagsFromId = $dbh->prepare($query);
        $deleteTagsFromId->execute([
            'recetteId' => $recetteId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function deleteOneRecette($pdo)
{
    try {
        $query = 'DELETE FROM recette WHERE recetteId = :recetteId';
        $deleteRecette = $pdo->prepare($query);
        $deleteRecette->execute([
            'recetteId' => $_GET["recetteId"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function ajouterTagsRecette($pdo, $recetteId, $tagId)
{
    try {
        $query = 'INSERT INTO tag_recette (recetteId, tagId) VALUES (:recetteId, :tagId)';
        $insertTag = $pdo->prepare($query);
        $insertTag->execute([
            'recetteId' => $recetteId,
            'tagId' => $tagId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}