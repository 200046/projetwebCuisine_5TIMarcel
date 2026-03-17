<div class="flex space-evenly wrap">
    <div class="border card" style="max-width: 800px; width: 100%;">

        <h2 class="center"><?= $recette->recetteTitre ?></h2>

        <div class="flexible discImageEcole center">
            <img src="https://picsum.photos/400/300?random=<?= $recette->recetteImage ?>" alt="photo de la recette">
        </div>

        <div class="center">
            <p>
                <span><?= $recette->recetteDifficulte ?></span> - 
                <span><?= $recette->recetteTempsPreparation ?></span> min -
                <span><?= $recette->recetteCategorie ?></span>
            </p>
        </div>

        <div class="mb-3">
            <h3>Description</h3>
            <p><?= nl2br($recette->recetteDescription) ?></p>
        </div>

        <div class="mb-3">
            <h3>Ingrédients</h3>
            <p><?= nl2br($recette->recetteIngredients) ?></p>
        </div>

        <div class="mb-3">
            <h3>Étapes</h3>
            <p><?= nl2br($recette->recetteEtapes) ?></p>
        </div>

        <?php if (!empty($tags)) : ?>
        <div class="mb-3">
            <h3>Tags</h3>
            <?php foreach ($tags as $tag) : ?>
                <span class="badge"><?= $tag['nom'] ?></span>
            <?php endforeach ?>
        </div>
        <?php endif ?>

        <div class="center mt-3">
            <a href="/" class="btn btn-secondary">Retour à l'accueil</a>

            <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->id === $recette->utilisateurId) : ?>
                <a href="/modifierRecette?recetteId=<?= $recette->recetteId ?>" class="btn btn-primary">Modifier</a>
                <a href="/supprimerRecette?recetteId=<?= $recette->recetteId ?>" class="btn btn-danger">Supprimer</a>
            <?php endif ?>
        </div>

    </div>
</div>