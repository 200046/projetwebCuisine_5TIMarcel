<h1>Marmiton-TTI</h1>

<div class="flexible wrap space-around">
    <?php foreach ($recettes as $recette) : ?>
        <div class="border card">
            <h2 class="center"><?= $recette->rec_titre ?></h2>
            <div class="flexible discImageEcole">
                <img src="<?= $recette->rec_image ?>" alt="photo de la recette">
            </div>
            <div class="center">
                <p><span><?= $recette->rec_difficulte ?></span> - <span><?= $recette->rec_temps_preparation ?></span> min, <?= $recette->recetteCategorie ?></p>
                <h3><a href="/voirrecette?tre_rec_id=<?= $recette->tre_rec_id ?>" class="btn btn-page">Voir la recette</a></h3>
                <?php if ($uri == '/mesrecettes') : ?>
                    <p><a href="/supprimerrecette?tre_rec_id=<?= $recette->tre_rec_id ?>">Supprimer la recette</a></p>
                    <p><a href="/modifierrecette?tre_rec_id=<?= $recette->tre_rec_id ?>">Modifier la recette</a></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
/*
 * Projet : Gestion de Recettes
 * Date : 31/03/2026
 */
