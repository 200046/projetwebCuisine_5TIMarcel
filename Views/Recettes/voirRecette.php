<div class="flex space-evenly wrap">
    <div class="border card" style="max-width: 800px; width: 100%;">

        <h2 class="center"><?= htmlspecialchars($recette->rec_titre) ?></h2>

        <div class="flexible discImageEcole center">
            <img src="<?= $recette->rec_image ?>" alt="photo de la recette">
        </div>

        <div class="center">
            <p>
                <span><?= htmlspecialchars($recette->rec_difficulte) ?></span> -
                <span><?= (int)$recette->rec_temps_preparation ?></span> min -
                <span><?= htmlspecialchars($recette->recetteCategorie ?? "Général") ?></span>
            </p>
        </div>

        <div class="mb-3">
            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($recette->rec_description)) ?></p>
        </div>

        <div class="mb-3">
            <h3>Ingrédients</h3>
            <p><?= nl2br(htmlspecialchars($recette->rec_ingredients)) ?></p>
        </div>

        <div class="mb-3">
            <h3>Étapes</h3>
            <p><?= nl2br(htmlspecialchars($recette->rec_etapes)) ?></p>
        </div>

        <?php if (!empty($tags)) : ?>
            <div class="mb-3">
                <h3>Tags</h3>
                <?php foreach ($tags as $tag) : ?>
                    <span class="badge"><?= htmlspecialchars($tag->tag_nom ?? $tag->cat_nom) ?></span>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <div class="center mt-3">
            <a href="/" class="btn btn-secondary">Retour à l'accueil</a>

            <?php if (isset($_SESSION['utilisateur']) && (int)$_SESSION['utilisateur']->uti_id === (int)$recette->rec_uti_id) : ?>
                <a href="/modifierRecette?rec_id=<?= $recette->rec_id ?>" class="btn btn-primary">Modifier</a>
                <a href="/supprimerRecette?rec_id=<?= $recette->rec_id ?>" class="btn btn-danger">Supprimer</a>
            <?php endif ?>
        </div>

    </div>
</div>