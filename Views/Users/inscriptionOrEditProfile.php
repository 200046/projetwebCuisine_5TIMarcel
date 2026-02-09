<div class="flex space-evenly wrap">
    <form method="post" action="">
        <fieldset>
            <legend><?= isset($_SESSION['user']) ? 'Modifier mon profil' : 'Inscription' ?></legend>
            <div class="mb-3">
                <label for="Nom" class="form-label">Nom</label>
                <input type="text" placeholder="Nom" class="form-control" id="nom" name="nom" required 
                <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->nomUser ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="Prenom" class="form-label">Prénom</label>
                <input type="text" placeholder="Prénom" class="form-control" id="prenom" name="prenom" required 
                <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->prenomUser ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" placeholder="Email" class="form-control" id="email" name="email" required 
                <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->emailUser ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="Login" class="form-label">Login</label>
                <input type="text" placeholder="Login" class="form-control" id="login" name="login" required 
                <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->loginUser ?>" <?php endif ?>>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Mot de passe" class="form-control" id="mot_de_passe" name="mot_de_passe" required 
                <?php if (isset($_SESSION['user'])) : ?>value="<?= $_SESSION['user']->passWordUser ?>" <?php endif ?>>
            </div>
            <div>
                <button name="btnEnvoi" class="btn btn-primary">
                    <?= isset($_SESSION['user']) ? 'Mettre à jour' : 'S\'inscrire' ?>
                </button>
            </div>
        </fieldset>
    </form>
</div>