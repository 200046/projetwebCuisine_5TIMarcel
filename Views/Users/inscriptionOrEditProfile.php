<div class="flex space-evenly wrap">
    <form method="post" action="">
        <fieldset>
            <legend><?= isset($_SESSION['utilisateur']) ? 'Modifier mon profil' : 'Inscription' ?></legend>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" placeholder="Votre nom" class="form-control" id="nom" name="nom" required
                <?php if (isset($_SESSION['utilisateur'])) : ?>value="<?= htmlspecialchars($_SESSION['utilisateur']->uti_nom) ?>" <?php endif ?>>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" placeholder="Votre prénom" class="form-control" id="prenom" name="prenom" required
                <?php if (isset($_SESSION['utilisateur'])) : ?>value="<?= htmlspecialchars($_SESSION['utilisateur']->uti_prenom) ?>" <?php endif ?>>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" placeholder="Email" class="form-control" id="email" name="email" required
                <?php if (isset($_SESSION['utilisateur'])) : ?>value="<?= htmlspecialchars($_SESSION['utilisateur']->uti_email) ?>" <?php endif ?>>
            </div>

            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" placeholder="Login" class="form-control" id="login" name="login" required
                <?php if (isset($_SESSION['utilisateur'])) : ?>value="<?= htmlspecialchars($_SESSION['utilisateur']->uti_login) ?>" <?php endif ?>>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Mot de passe" class="form-control" id="mot_de_passe" name="mot_de_passe" required
                <?php if (isset($_SESSION['utilisateur'])) : ?>value="<?= htmlspecialchars($_SESSION['utilisateur']->uti_motdepasse) ?>" <?php endif ?>>
            </div>

            <div class="flex space-between mt-3">
                <button name="btnEnvoi" class="btn btn-primary">
                    <?= isset($_SESSION['utilisateur']) ? 'Mettre à jour' : 'S\'inscrire' ?>
                </button>

                <?php if (isset($_SESSION['utilisateur'])) : ?>
                    <button type="submit" name="btnDelete" class="btn btn-danger" onclick="return confirm('Supprimer définitivement votre compte ?');">
                        Supprimer mon profil
                    </button>
                <?php endif; ?>
            </div>

        </fieldset>
    </form>
</div>