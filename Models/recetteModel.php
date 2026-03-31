<?php

// -----------------------------
// Fonction pour récupérer toutes les recettes
// -----------------------------
function selectAllRecettes($pdo)
{
    try {
        $query = 'SELECT recette.*, categorie.cat_nom AS recetteCategorie, utilisateur.uti_est_suspendu 
                  FROM recette
                  INNER JOIN utilisateur ON recette.rec_uti_id = utilisateur.uti_id
                  INNER JOIN categorie ON recette.rec_cat_id = categorie.cat_id
                  WHERE utilisateur.uti_est_suspendu = 0';

        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute();

        $recettes = $selectRecette->fetchAll(PDO::FETCH_OBJ);

        return $recettes;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// -----------------------------
// Supprimer les tags des recettes d'un utilisateur
// -----------------------------
function deleteTagsRecetteFromUser($pdo)
{
    try {
        $query = 'DELETE FROM tag_recette 
                  WHERE tre_rec_id IN (
                    SELECT rec_id 
                    FROM recette 
                    WHERE rec_uti_id = :rec_uti_id
                  )';

        $deleteTags = $pdo->prepare($query);

        $deleteTags->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Supprimer toutes les recettes d'un utilisateur
// -----------------------------
function deleteAllRecettesFromUser($pdo)
{
    try {

        $query = 'DELETE FROM recette 
                  WHERE rec_uti_id = :rec_uti_id';

        $deleteRecettes = $pdo->prepare($query);

        $deleteRecettes->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Récupérer les recettes de l'utilisateur connecté
// -----------------------------
function selectMyRecettes($pdo)
{
    try {

        $query = 'SELECT * FROM recette 
                  WHERE rec_uti_id = :rec_uti_id';

        $selectRecette = $pdo->prepare($query);

        $selectRecette->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);

        $recettes = $selectRecette->fetchAll();

        return $recettes;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Récupérer toutes les catégories
// -----------------------------
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


// -----------------------------
// Récupérer tous les tags
// -----------------------------
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


// -----------------------------
// Récupérer une seule recette
// -----------------------------
function selectOneRecette($pdo) {
    try {
        $query = 'SELECT recette.*, categorie.cat_nom AS recetteCategorie
                  FROM recette
                  INNER JOIN categorie ON recette.rec_cat_id = categorie.cat_id
                  WHERE rec_id = :rec_id';

        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'rec_id' => $_GET["rec_id"]
        ]);

        return $selectRecette->fetch(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer les tags actifs d'une recette
// -----------------------------
function selectTagsActiveRecette($pdo)
{
    try {

        $query = 'SELECT * FROM tag 
                  WHERE tag_id IN (
                    SELECT tre_tag_id 
                    FROM tag_recette 
                    WHERE tre_rec_id = :rec_id
                  )';

        $selectTags = $pdo->prepare($query);

        $selectTags->execute([
            'rec_id' => $_GET["rec_id"]
        ]);

        $tags = $selectTags->fetchAll();

        return $tags;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Modifier une recette
// -----------------------------
function updateRecette($pdo)
{
    try {
        $query = 'UPDATE recette SET 
          rec_titre = :titre, 
          rec_description = :description, 
          rec_ingredients = :ingredients, 
          rec_etapes = :etapes, 
          rec_temps_preparation = :temps_preparation, 
          rec_difficulte = :difficulte, 
          rec_cat_id = :rec_cat_id, 
          rec_image = :image 
          WHERE rec_id = :rec_id';

        $updateRecette = $pdo->prepare($query);

        $updateRecette->execute([
            'titre'             => $_POST["titre"],
            'description'       => $_POST["description"],
            'ingredients'       => $_POST["ingredients"],
            'etapes'            => $_POST["etapes"],
            'temps_preparation' => $_POST["temps_preparation"],
            'difficulte'        => $_POST["difficulte"],
            'rec_cat_id'        => $_POST["rec_cat_id"],
            'image'             => $_POST["image"],
            'rec_id'            => $_GET["rec_id"]
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Supprimer les tags d'une recette
// -----------------------------
function deleteTagsRecette($pdo, $rec_id)
{
    try {

        $query = 'DELETE FROM tag_recette 
                  WHERE tre_rec_id = :rec_id';

        $deleteTags = $pdo->prepare($query);

        $deleteTags->execute([
            'rec_id' => $rec_id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Supprimer une recette
// -----------------------------
function deleteOneRecette($pdo)
{
    try {

        $query = 'DELETE FROM recette 
                  WHERE rec_id = :rec_id';

        $deleteRecette = $pdo->prepare($query);

        $deleteRecette->execute([
            'rec_id' => $_GET["rec_id"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// -----------------------------
// Ajouter un tag à une recette
// -----------------------------
function ajouterTagsRecette($pdo, $rec_id, $tag_id)
{
    try {

        $query = 'INSERT INTO tag_recette (tre_rec_id, tre_tag_id) 
                  VALUES (:rec_id, :tag_id)';

        $insertTag = $pdo->prepare($query);

        $insertTag->execute([
            'rec_id' => $rec_id,
            'tag_id' => $tag_id
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

// -----------------------------
// Ajouter une nouvelle recette
// -----------------------------
function insertRecette($pdo)
{
    try {
        $query = 'INSERT INTO recette (
                    rec_titre, 
                    rec_description, 
                    rec_ingredients, 
                    rec_etapes, 
                    rec_temps_preparation, 
                    rec_difficulte, 
                    rec_cat_id, 
                    rec_image,
                    rec_uti_id
                  ) VALUES (
                    :titre, 
                    :description, 
                    :ingredients, 
                    :etapes, 
                    :temps_preparation, 
                    :difficulte, 
                    :rec_cat_id, 
                    :image,
                    :rec_uti_id
                  )';

        $insertRecette = $pdo->prepare($query);

        $insertRecette->execute([
            'titre'            => $_POST["titre"],
            'description'      => $_POST["description"],
            'ingredients'      => $_POST["ingredients"],
            'etapes'           => $_POST["etapes"],
            'temps_preparation'=> $_POST["temps_preparation"],
            'difficulte'       => $_POST["difficulte"],
            'rec_cat_id'       => $_POST["rec_cat_id"],
            'image'            => $_POST["image"],
            'rec_uti_id'       => $_SESSION["utilisateur"]->uti_id
        ]);

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Récupérer les recettes d'un utilisateur par son id
// -----------------------------
function getRecettesByUserId($pdo, $userId)
{
    try {
        $query = 'SELECT * FROM recette WHERE rec_uti_id = :rec_uti_id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(['rec_uti_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}