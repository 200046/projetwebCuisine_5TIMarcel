<!-- Page de connexion -->
<div class="flex space-evenly wrap">

    <?php if (isset($_GET['compte']) && $_GET['compte'] === 'suspendu'): ?>
        <div class="alert alert-danger">
            <strong>Compte suspendu !</strong> Votre compte a été suspendu. Vous ne pouvez plus vous connecter.
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <strong>Erreur !</strong> <?= $error ?>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <fieldset>
            <legend>Se connecter</legend>
            <div id="formError" class="alert alert-danger" style="display:none;"></div>

            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text"
                    placeholder="Login"
                    class="form-control"
                    id="login"
                    name="login"
                    value="<?= isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '' ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>

                <div style="position: relative;">
                    <input type="password"
                        class="form-control password-input"
                        name="mot_de_passe"
                        required
                        style="padding-right: 40px;">

                    <button type="button" class="toggle-password"
                        style="
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                    border: none;
                    background: transparent;
                    cursor: pointer;
                    z-index: 10;
                ">
                        👁️
                    </button>
                </div>
            </div>

            <div>
                <button name="btnEnvoi" class="btn btn-primary">Se connecter</button>
            </div>
        </fieldset>

        <div class="mt-4">
            <h4 class="text-danger">Pas encore inscrit ?</h4>
            <a href="/inscription" class="btn btn-secondary">Créer un compte</a>
        </div>
    </form>

</div>