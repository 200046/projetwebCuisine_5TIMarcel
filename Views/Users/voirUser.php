<h1>
    <?= htmlspecialchars($userVu->uti_prenom) ?> 
    <?= htmlspecialchars($userVu->uti_nom) ?>
</h1>

<div class="flexible wrap space-around">
    <?php foreach ($recettes as $recette) : ?>
        <div class="border card">
            <h2 class="center"><?= htmlspecialchars($recette->rec_titre) ?></h2>
            
            <div class="flexible discImageEcole">
                <?php if (!empty($recette->rec_image)) : ?>
                    <img src="<?= htmlspecialchars($recette->rec_image) ?>" alt="photo de la recette">
                <?php else : ?>
                    <p>Pas d'image</p>
                <?php endif; ?>
            </div>

            <div class="center">
                <p>
                    <span><?= htmlspecialchars($recette->rec_difficulte) ?></span> - 
                    <span><?= (int)$recette->rec_temps_preparation ?></span> min
                </p>
                
                <h3>
                    <a href="/voirrecette?rec_id=<?= (int)$recette->rec_id ?>" class="btn btn-page">
                        Voir la recette
                    </a>
                </h3>
            </div>
        </div>
    <?php endforeach; ?>
    
    <?php if (empty($recettes)) : ?>
        <p>Cet utilisateur n'a pas encore partagé de recettes.</p>
    <?php endif; ?>
</div>