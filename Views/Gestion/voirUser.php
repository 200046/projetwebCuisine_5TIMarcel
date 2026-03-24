<div class="admin-container">

    <div class="admin-header">
        <h1>Profil de <?= htmlspecialchars($userVu->prenomUser) ?> <?= htmlspecialchars($userVu->nomUser) ?></h1>
        <a href="/administration" class="btn-reactiv">← Retour</a>
    </div>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Infos utilisateur -->
    <div class="users-section">
        <h2>Informations</h2>
        <p><strong>Login :</strong> <?= htmlspecialchars($userVu->loginUser) ?></p>
        <p><strong>Rôle :</strong> <?= htmlspecialchars($userVu->role) ?></p>
    </div>

    <!-- Recettes de l'utilisateur -->
    <div class="users-section">
        <h2>Recettes (<?= count($recettes) ?>)</h2>

        <?php if (count($recettes) === 0): ?>
            <p>Cet utilisateur n'a aucune recette.</p>
        <?php else: ?>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Difficulté</th>
                        <th>Temps (min)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recettes as $recette): ?>
                        <tr>
                            <td><?= $recette->recetteId ?></td>
                            <td><?= htmlspecialchars($recette->recetteTitre) ?></td>
                            <td><?= htmlspecialchars($recette->recetteDifficulte) ?></td>
                            <td><?= $recette->recetteTempsPreparation ?></td>
                            <td class="actions">
                                <a href="/voirrecette?recetteId=<?= $recette->recetteId ?>" class="btn-promouvoir">Voir</a>
                                <a href="?id=<?= $userVu->id ?>&action=supprimerRecette&recetteId=<?= $recette->recetteId ?>" class="btn-suspend">
                                    Supprimer
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>