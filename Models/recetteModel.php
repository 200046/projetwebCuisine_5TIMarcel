<?php

// -----------------------------
// Fonction pour récupérer toutes les recettes
// -----------------------------
function selectAllRecettes($pdo)
{
    try {
        // Correction : categories (pluriel), utilisateurs (pluriel)
        $query = 'SELECT recettes.*, categories.cat_nom AS recetteCategorie, utilisateurs.uti_est_suspendu 
                  FROM recettes
                  INNER JOIN utilisateurs ON recettes.rec_uti_id = utilisateurs.uti_id
                  INNER JOIN categories ON recettes.rec_cat_id = categories.cat_id
                  WHERE utilisateurs.uti_est_suspendu = 0';

        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute();

        return $selectRecette->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -----------------------------
// Supprimer les tags des recettes d'un utilisateur
// -----------------------------
function deleteTagsRecetteFromUser($pdo)
{
    try {
        // Correction : tags_recettes (selon ton schéma SQL)
        $query = 'DELETE FROM tags_recettes 
                  WHERE tre_rec_id IN (
                    SELECT rec_id 
                    FROM recettes 
                    WHERE rec_uti_id = :rec_uti_id
                  )';

        $deleteTags = $pdo->prepare($query);
        $deleteTags->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Supprimer toutes les recettes d'un utilisateur
// -----------------------------
function deleteAllRecettesFromUser($pdo)
{
    try {
        $query = 'DELETE FROM recettes 
                  WHERE rec_uti_id = :rec_uti_id';

        $deleteRecettes = $pdo->prepare($query);
        $deleteRecettes->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer les recettes de l'utilisateur connecté
// -----------------------------
function selectMyRecettes($pdo)
{
    try {
        $query = 'SELECT * FROM recettes 
                  WHERE rec_uti_id = :rec_uti_id';

        $selectRecette = $pdo->prepare($query);
        $selectRecette->execute([
            'rec_uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);

        return $selectRecette->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer toutes les catégories
// -----------------------------
function selectAllCategories($pdo)
{
    try {
        // Correction : categories
        $query = 'SELECT * FROM categories';

        $selectCategories = $pdo->prepare($query);
        $selectCategories->execute();

        return $selectCategories->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer tous les tags
// -----------------------------
function selectAllTags($pdo)
{
    try {
        // Correction : tags
        $query = 'SELECT * FROM tags';

        $selectTags = $pdo->prepare($query);
        $selectTags->execute();

        return $selectTags->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer une seule recette
// -----------------------------
function selectOneRecette($pdo) {
    try {
        // Correction : categories
        $query = 'SELECT recettes.*, categories.cat_nom AS recetteCategorie
                  FROM recettes
                  INNER JOIN categories ON recettes.rec_cat_id = categories.cat_id
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
        // Correction : tags et tags_recettes
        $query = 'SELECT * FROM tags 
                  WHERE tag_id IN (
                    SELECT tre_tag_id 
                    FROM tags_recettes 
                    WHERE tre_rec_id = :rec_id
                  )';

        $selectTags = $pdo->prepare($query);
        $selectTags->execute([
            'rec_id' => $_GET["rec_id"]
        ]);

        return $selectTags->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Modifier une recette
// -----------------------------
function updateRecette($pdo)
{
    try {
        $query = 'UPDATE recettes SET 
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
        // Correction : tags_recettes
        $query = 'DELETE FROM tags_recettes 
                  WHERE tre_rec_id = :rec_id';

        $deleteTags = $pdo->prepare($query);
        $deleteTags->execute([
            'rec_id' => $rec_id
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


// -----------------------------
// Supprimer une recette
// -----------------------------
function deleteOneRecette($pdo)
{
    try {
        $query = 'DELETE FROM recettes 
                  WHERE rec_id = :rec_id';

        $deleteRecette = $pdo->prepare($query);
        $deleteRecette->execute([
            'rec_id' => $_GET["rec_id"]
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -----------------------------
// Ajouter un tag à une recette
// -----------------------------
function ajouterTagsRecette($pdo, $rec_id, $tag_id)
{
    try {
        // Correction : tags_recettes
        $query = 'INSERT INTO tags_recettes (tre_rec_id, tre_tag_id) 
                  VALUES (:rec_id, :tag_id)';

        $insertTag = $pdo->prepare($query);
        $insertTag->execute([
            'rec_id' => $rec_id,
            'tag_id' => $tag_id
        ]);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -----------------------------
// Ajouter une nouvelle recette
// -----------------------------
function insertRecette($pdo)
{
    try {
        $query = 'INSERT INTO recettes (
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
        die($e->getMessage());
    }
}


// -----------------------------
// Récupérer les recettes d'un utilisateur par son id
// -----------------------------
function getRecettesByUserId($pdo, $userId)
{
    try {
        $query = 'SELECT * FROM recettes WHERE rec_uti_id = :rec_uti_id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(['rec_uti_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}