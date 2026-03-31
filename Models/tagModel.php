<?php
// Récupérer tous les tags
function getAllTags($pdo) {
    return $pdo->query("SELECT * FROM tags ORDER BY tag_nom ASC")->fetchAll(PDO::FETCH_OBJ);
}

// Ajouter un tag
function addTag($pdo, $nom) {
    $stmt = $pdo->prepare("INSERT INTO tags (tag_nom) VALUES (:nom)");
    return $stmt->execute(['nom' => $nom]);
}

// Renommer un tag
function updateTag($pdo, $id, $nom) {
    $stmt = $pdo->prepare("UPDATE tags SET tag_nom = :nom WHERE tag_id = :id");
    return $stmt->execute(['nom' => $nom, 'id' => $id]);
}

// Supprimer un tag
function deleteTag($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM tags WHERE tag_id = :id");
    return $stmt->execute(['id' => $id]);
}

// Vérifier si le tag est utilisé dans la table pivot tags_recettes
function countRecettesByTag($pdo, $id) {
    // Fidèle à ton schéma : table 'tags_recettes', colonne 'tre_tag_id'
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM tags_recettes WHERE tre_tag_id = :id");
    $stmt->execute(['id' => $id]);
    return (int)$stmt->fetch(PDO::FETCH_OBJ)->total;
}