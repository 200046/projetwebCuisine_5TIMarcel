<?php
// Récupérer toutes les catégories
function getAllCategories($pdo) {
    // Correction : table 'categories' avec un 's'
    return $pdo->query("SELECT * FROM categories ORDER BY cat_nom ASC")->fetchAll(PDO::FETCH_OBJ);
}

// Ajouter une nouvelle catégorie
function addCategorie($pdo, $nom) {
    // Correction : table 'categories'
    $query = "INSERT INTO categories (cat_nom) VALUES (:nom)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(['nom' => $nom]);
}

// Renommer une catégorie
function updateCategorie($pdo, $id, $nom) {
    // Correction : table 'categories'
    $query = "UPDATE categories SET cat_nom = :nom WHERE cat_id = :id";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(['nom' => $nom, 'id' => $id]);
}

// Supprimer une catégorie
function deleteCategorie($pdo, $id) {
    // Correction : table 'categories'
    $query = "DELETE FROM categories WHERE cat_id = :id";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(['id' => $id]);
}

// Vérifier les liens de sécurité
function countRecettesByCategorie($pdo, $id) {
    // Correction : table 'recettes' avec un 's'
    $query = "SELECT COUNT(*) as total FROM recettes WHERE rec_cat_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return (int)$result->total;
}