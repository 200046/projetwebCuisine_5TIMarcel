<div class="container">
    <h1>Inscription</h1>
    
    <?php if (isset($messageError)): ?>
        <div class="alert alert-danger">
            <?= $messageError ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="/inscription">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        
        <button type="submit" name="btnEnvoi" class="btn btn-primary">S'inscrire</button>
        <a href="/connexion" class="btn btn-link">Déjà un compte ? Connectez-vous</a>
    </form>
</div>