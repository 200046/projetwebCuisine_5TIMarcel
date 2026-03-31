<?php if (isset($_SESSION["utilisateur"])) : ?>
    <a href="/creerRecette" class="btn btn-primary mb-3">Ajouter une recette</a>
<?php endif; ?>

<?php
// Note : Idéalement, cette requête devrait être dans ton Model
// On s'assure de récupérer les recettes
$recettes = $pdo->query('SELECT * FROM recette')->fetchAll(PDO::FETCH_OBJ);

if (!$recettes) {
    echo "<p>Aucune recette disponible.</p>";
}
?>

<div class="flexible wrap space-around">
    <?php foreach ($recettes as $recette) : ?>
        <?php 
        // Vérifie que la recette appartient à l'utilisateur connecté
        // On utilise bien rec_uti_id (clé étrangère) et uti_id (session)
        if (!isset($_SESSION["utilisateur"]) || (int)$recette->rec_uti_id !== (int)$_SESSION["utilisateur"]->uti_id) {
            continue;
        }
        ?>

        <div class="border card">
            <h2 class="center"><?= htmlspecialchars($recette->rec_titre) ?></h2>

            <div class="flexible discImageEcole">
                <?php if (!empty($recette->rec_image)) : ?>
                    <img src="<?= htmlspecialchars($recette->rec_image) ?>" alt="Photo de la recette">
                <?php else : ?>
                    <p>Aucune image disponible</p>
                <?php endif; ?>
            </div>

            <div class="center">
                <p>
                    <span><?= htmlspecialchars($recette->rec_difficulte) ?></span> - 
                    <span><?= (int)$recette->rec_temps_preparation ?></span> min
                </p>

                <h3>
                    <a href="/voirRecette?rec_id=<?= (int)$recette->rec_id ?>" class="btn btn-page">
                        Voir la recette
                    </a>
                </h3>

                <p>
                    <a href="/modifierRecette?rec_id=<?= (int)$recette->rec_id ?>" class="btn btn-warning">Modifier</a>
                    <a href="/supprimerRecette?rec_id=<?= (int)$recette->rec_id ?>" class="btn btn-danger" 
                       onclick="return confirm('Voulez-vous vraiment supprimer cette recette ?');">
                        Supprimer
                    </a>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>