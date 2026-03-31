<div class="admin-container">
    <h2>Gestion des Catégories</h2>

    <?php if (!empty($messageErreur)) : ?>
        <div class="alert alert-danger" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            <strong>⚠️ Action impossible :</strong> <?= htmlspecialchars($messageErreur) ?>
        </div>
    <?php endif; ?>

    <div class="users-section mb-3">
        <form method="post" action="" class="flex gap-10">
            <input type="text" name="nouveau_nom" class="form-control" placeholder="Ex: Desserts" required>
            <button type="submit" name="btnAjouter" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom (Modifier et valider par OK)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat) : ?>
                <tr>
                    <td><?= $cat->cat_id ?></td>
                    <td>
                        <form method="post" action="" class="flex">
                            <input type="hidden" name="cat_id" value="<?= $cat->cat_id ?>">
                            <input type="text" name="update_nom" value="<?= htmlspecialchars($cat->cat_nom) ?>" class="form-control" required>
                            <button type="submit" name="btnUpdate" class="btn-reactiv" style="margin-left:8px">OK</button>
                        </form>
                    </td>
                    <td class="actions">
                        <a href="?action=supprCat&id=<?= $cat->cat_id ?>" class="btn-suspend">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>