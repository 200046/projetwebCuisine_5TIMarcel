<div class="admin-container">
    <div class="users-section">
        <h2>Comptes suspendus</h2>
        <?php $suspendusTrouves = false; ?>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th> <th>Login</th>
                    <th>Email</th>
                    <th>Nb Recettes</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateursData as $data): ?>
                    <?php if ($data['uti_est_suspendu']): ?>
                        <?php $suspendusTrouves = true; ?>
                        <?php $user = $data['user']; ?>
                        <tr>
                            <td><?= $user->uti_id ?></td>
                            
                            <td><?= htmlspecialchars($user->uti_nom) ?></td>
                            
                            <td><?= htmlspecialchars($user->uti_prenom) ?></td>
                            
                            <td><?= htmlspecialchars($user->uti_login) ?></td>
                            
                            <td><?= htmlspecialchars($user->uti_email) ?></td>
                            
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