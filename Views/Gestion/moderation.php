<div class="admin-container">
    <div class="users-section">
        <h2>Comptes suspendus</h2>
        <?php $suspendusTrouves = false; ?>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Nb Recettes</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateursData as $data): ?>
                    <?php if ($data['estSuspendu']): ?>
                        <?php $suspendusTrouves = true; ?>
                        <?php $user = $data['user']; ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= htmlspecialchars($user->nomUser) ?></td>
                            <td><?= htmlspecialchars($user->prenomUser) ?></td>
                            <td><?= htmlspecialchars($user->loginUser) ?></td>
                            <td><?= $data['nbRecettes'] ?></td>
                            <td><span class="badge badge-suspendu">Suspendu</span></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if (!$suspendusTrouves): ?>
                    <tr>
                        <td colspan="7" style="text-align:center; color:#999;">Aucun compte suspendu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>