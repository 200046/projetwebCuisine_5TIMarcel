<div class="flex space-evenly wrap">
    <div class="border card" style="max-width: 800px; width: 100%;">

        <h2 class="center"><?= $recette->rec_titre ?></h2>

        <div class="flexible discImageEcole center">
            <img src="https://picsum.photos/400/300?random=<?= $recette->rec_image ?>" alt="photo de la recette">
        </div>

        <div class="center">
            <p>
                <span><?= $recette->rec_difficulte ?></span> - 
                <span><?= $recette->rec_temps_preparation ?></span> min -
                <span><?= $recette->recetteCategorie ?></span>
            </p>
        </div>

        <div class="mb-3">
            <h3>Description</h3>
            <p><?= nl2br($recette->rec_description) ?></p>
        </div>

        <div class="mb-3">
            <h3>Ingrédients</h3>
            <p><?= nl2br($recette->rec_ingredients) ?></p>
        </div>

        <div class="mb-3">
            <h3>Étapes</h3>
            <p><?= nl2br($recette->rec_etapes) ?></p>
        </div>

        <?php if (!empty($tags)) : ?>
        <div class="mb-3">
            <h3>Tags</h3>
            <?php foreach ($tags as $tag) : ?>
                <span class="badge"><?= $tag['cat_nom'] ?></span>
            <?php endforeach ?>
        </div>
        <?php endif ?>

        <div class="center mt-3">
            <a href="/" class="btn btn-secondary">Retour à l'accueil</a>

            <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->uti_id === $recette->rec_uti_id) : ?>
                <a href="/modifierRecette?tre_rec_id=<?= $recette->tre_rec_id ?>" class="btn btn-primary">Modifier</a>
                <a href="/supprimerRecette?tre_rec_id=<?= $recette->tre_rec_id ?>" class="btn btn-danger">Supprimer</a>
            <?php endif ?>
        </div>

    </div>
</div>
/*
 * Projet : Gestion de Recettes
 * Date : 31/03/2026
 */
