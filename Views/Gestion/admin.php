<div class="admin-container">
    <!-- Messages de notification -->
    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Tableau des utilisateurs -->
    <div class="users-section">
        <h2>Gestion des utilisateurs</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Précat_nom</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateursData as $data): ?>
                    <?php $user = $data['user']; ?>
                    <tr class="<?= $data['uti_est_suspendu'] ? 'suspendu' : '' ?>">
                        <td><?= $user->uti_id ?></td>
                        <td><?= htmlspecialchars($user->uti_cat_nom) ?></td>
                        <td><?= htmlspecialchars($user->preuti_cat_nom) ?></td>
                        <td><?= htmlspecialchars($user->uti_login) ?></td>
                        <td><?= htmlspecialchars($user->uti_email) ?></td>
                        <td>
                            <?php if ($user->uti_role === 'admin'): ?>
                                <span class="badge badge-admin">Admin</span>
                            <?php elseif ($user->uti_role === 'moderateur'): ?>
                                <span class="badge badge-moderateur">Modérateur</span>
                            <?php else: ?>
                                <span class="badge badge-user">Utilisateur</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($data['uti_est_suspendu']): ?>
                                <span class="badge badge-suspendu">Suspendu</span>
                            <?php else: ?>
                                <span class="badge badge-actif">Actif</span>
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <?php if ($user->uti_id != $_SESSION["utilisateur"]->uti_id): ?>
                                <?php if ($data['uti_est_suspendu']): ?>
                                    <a href="?action=reactiver&id=<?= $user->uti_id ?>" class="btn-reactiv">
                                        <img class="btn-img" src="../../Assets/Images/activate.png" alt="Activate">
                                    </a>
                                <?php else: ?>
                                    <a href="?action=suspendre&id=<?= $user->uti_id ?>" class="btn-suspend">
                                        <img class="btn-img" src="../../Assets/Images/banned.png" alt="Banned">
                                    </a>
                                <?php endif; ?>

                                <?php if ($user->uti_role === 'moderateur'): ?>
                                    <a href="?action=retrograder&id=<?= $user->uti_id ?>" class="btn-retrograder">
                                        <img class="btn-img" src="../../Assets/Images/down.png" alt="Retrograder">
                                    </a>
                                <?php elseif ($user->uti_role === 'user'): ?>
                                    <a href="?action=promouvoir&id=<?= $user->uti_id ?>" class="btn-promouvoir">
                                        <img class="btn-img" src="../../Assets/Images/up.png" alt="Promouvoir">
                                    </a> <?php endif; ?>
                                <a href="/admVoirUser?id=<?= $user->uti_id ?>" class="btn-promouvoir">
                                    <img class="btn-img" src="../../Assets/Images/oeil.png" alt="Voir">
                                </a>
                            <?php else: ?>
                                <span class="text-muted">(Vous)</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
/*
 * Projet : Gestion de Recettes
 * Date : 31/03/2026
 */
