<div class="admin-container">
    <div class="admin-header">
        <h1>👨‍🍳 Mes Recettes</h1>
        <?php if (isset($_SESSION["utilisateur"])) : ?>
            <a href="/creerRecette" class="btn-creer" id="navBarAddRecette">+ Ajouter une recette</a>
        <?php endif; ?>
    </div>

    <?php if (empty($recettes)) : ?>
        <div class="info-box">
            <p class="center">Vous n'avez pas encore partagé de recettes. Commencez l'aventure !</p>
        </div>
    <?php else : ?>

    <div class="flexible wrap justify-content-center">
        <?php foreach ($recettes as $recette) : ?>
            <div class="card">
                <h2 class="center"><?= htmlspecialchars($recette->rec_titre) ?></h2>

                <?php if (!empty($recette->rec_image)) : ?>
                    <img src="<?= htmlspecialchars($recette->rec_image) ?>" alt="Photo de <?= htmlspecialchars($recette->rec_titre) ?>">
                <?php else : ?>
                    <div class="text-muted center" style="height: 215px; display: flex; align-items: center; justify-content: center; background: #262626; border-radius: 14px; margin-bottom: 16px;">
                        Pas d'image
                    </div>
                <?php endif; ?>

                <div class="center">
                    <p>
                        <span class="text-muted"> • <?= (int)$recette->rec_temps_preparation ?> min</span>
                    </p>

                    <div style="margin-top: 15px;">
                        <a href="/voirRecette?rec_id=<?= (int)$recette->rec_id ?>" class="btn-promouvoir" style="display: block; margin-bottom: 10px; padding: 10px;">
                            👁️ Voir la recette
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>