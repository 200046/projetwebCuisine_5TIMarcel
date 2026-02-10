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