<div class="admin-container">
    <h2>Gestion des Tags 🏷️</h2>

    <?php if (!empty($messageErreur)) : ?>
        <div class="alert alert-danger" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            <strong>⚠️ Blocage :</strong> <?= htmlspecialchars($messageErreur) ?>
        </div>
    <?php endif; ?>

    <div class="users-section mb-3">
        <form method="post" action="" class="flex gap-10">
            <input type="text" name="nouveau_tag" class="form-control" placeholder="Nouveau tag (ex: Végétarien, Sans Gluten)" required>
            <button type="submit" name="btnAjouterTag" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $t) : ?>
                <tr>
                    <td><?= $t->tag_id ?></td>
                    <td>
                        <form method="post" action="" class="flex">
                            <input type="hidden" name="tag_id" value="<?= $t->tag_id ?>">
                            <input type="text" name="update_nom" value="<?= htmlspecialchars($t->tag_nom) ?>" class="form-control" required>
                            <button type="submit" name="btnUpdateTag" class="btn-reactiv" style="margin-left:5px">OK</button>
                        </form>
                    </td>
                    <td>
                        <a href="?action=supprTag&id=<?= $t->tag_id ?>" class="btn-suspend">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>