<div class="container">
    <h1>Supprimer une recette</h1>
    
    <?php if (isset($recette)) : ?>
        <div class="confirmation">
            <p>Êtes-vous sûr de vouloir supprimer la recette :</p>
            <h2><?= htmlspecialchars($recette->recetteTitre) ?></h2>
            
            <?php if (!empty($recette->recetteImage)) : ?>
                <div class="image-preview">
                    <img src="<?= $recette->recetteImage ?>" alt="<?= htmlspecialchars($recette->recetteTitre) ?>" width="200">
                </div>
            <?php endif; ?>
            
            <div class="actions">
                <form method="POST" action="/supprimerRecette?recetteId=<?= $recette->recetteId ?>">
                    <button type="submit" name="confirmerSuppression" class="btn btn-danger">Oui, supprimer</button>
                    <a href="/mesRecettes" class="btn btn-secondary">Non, annuler</a>
                </form>
            </div>
        </div>
    <?php else : ?>
        <p class="error">Recette non trouvée.</p>
        <a href="/mesRecettes" class="btn">Retour à mes recettes</a>
    <?php endif; ?>
</div>

<style>
.container {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
}

.confirmation {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
    padding: 20px;
    border-radius: 5px;
}

.image-preview {
    margin: 20px 0;
    text-align: center;
}

.image-preview img {
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.actions {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.btn {
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
    cursor: pointer;
    border: none;
    font-size: 16px;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.error {
    color: #dc3545;
    padding: 20px;
    background-color: #f8d7da;
    border-radius: 5px;
}
</style>