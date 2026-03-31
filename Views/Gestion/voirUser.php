<div class="admin-container">

    <div class="admin-header">
        <h1>Profil de <?= htmlspecialchars($userVu->uti_prenom) ?> <?= htmlspecialchars($userVu->uti_nom) ?></h1>
        <a href="/administration" class="btn-reactiv">← Retour</a>
    </div>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="users-section">
        <h2>Informations</h2>
        <p><strong>Login :</strong> <?= htmlspecialchars($userVu->uti_login) ?></p>
        <p><strong>Rôle :</strong> <?= htmlspecialchars($userVu->uti_role) ?></p>
    </div>

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
                            <td><?= $recette->rec_id ?></td>
                            <td><?= htmlspecialchars($recette->rec_titre) ?></td>
                            <td><?= htmlspecialchars($recette->rec_difficulte) ?></td>
                            <td><?= $recette->rec_temps_preparation ?></td>
                            <td class="actions">
                                <a href="/voirrecette?rec_id=<?= $recette->rec_id ?>" class="btn-promouvoir">Voir</a>
                                
                                <a href="?uti_id=<?= $userVu->uti_id ?>&action=supprimerRecette&rec_id=<?= $recette->rec_id ?>" 
                                   class="btn-suspend" 
                                   onclick="return confirm('Supprimer définitivement cette recette ?')">
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