<div class="error-container">
        <div class="error-icon">⚠️</div>
        <h1>Accès non autorisé</h1>
        
        <div class="error-content">
            <p><?= isset($error) ? htmlspecialchars($error) : "Vous n'avez pas les droits pour accéder à cette page." ?></p>
            <p>Cette section est réservée aux administrateurs.</p>
        </div>
        
        <a href="/" class="btn-retour">Retour à l'accueil</a>
        
        <div class="error-details">
            <p>Si vous pensez que c'est une erreur, contactez l'administrateur.</p>
        </div>
    </div>