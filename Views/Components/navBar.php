<ul class="navbar">
    <li class="navbar-brand"><a href="/">Marmiton-TTI</a></li>

    <div class="navbar-links">
        <?php if (isset($_SESSION['utilisateur'])) : ?>
            <li><a href="mesRecettes">Mes recettes</a></li>
            <li><a href="creerRecette" class="btn-creer">+ Créer une recette</a></li>

            <?php if ($_SESSION['utilisateur']->role === 'admin'): ?>
                <li><a href="administration">Admin</a></li>
            <?php elseif ($_SESSION['utilisateur']->role === 'moderateur'): ?>
                <li><a href="moderation">Modération</a></li>
            <?php endif; ?>

            <li class="navbar-user">
                <?= htmlspecialchars($_SESSION['utilisateur']->prenomUser) ?>
                <ul class="dropdown">
                    <li><a href="profil">Mon profil</a></li>
                    <li><a href="deconnexion">Déconnexion</a></li>
                </ul>
            </li>
        <?php else : ?>
            <li><a href="inscription">S'inscrire</a></li>
            <li><a href="connexion" class="btn-creer">Se connecter</a></li>
        <?php endif; ?>
    </div>
</ul>