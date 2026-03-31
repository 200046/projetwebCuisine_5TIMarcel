<ul class="navbar">
    <li class="navbar-brand"><a href="/">🍽️ Marmiton-TTI</a></li>

    <div class="navbar-links">
        <?php if (isset($_SESSION['utilisateur'])) : ?>
            <li><a href="mesRecettes" id="navBarMesRecettes">👨‍🍳 Mes recettes</a></li>
            <li><a href="creerRecette" class="btn-creer" id="navBarAddRecette">✨ Créer une recette</a></li>

            <?php if ($_SESSION['utilisateur']->uti_role === 'admin'): ?>
                <li><a href="administration" id="navBarINDEX">👑 Admin</a></li>
                <li><a href="gestionCategories" id="navBarCATEGORIE">🗂️ Catégories</a></li>
                <li><a href="gestionTags" id="navBarTAG">🏷️ Tags</a></li>
                
            <?php elseif ($_SESSION['utilisateur']->uti_role === 'moderateur'): ?>
                <li><a href="moderation" id="navBarModerateur">🛡️ Modération</a></li>
            <?php endif; ?>

            <li class="navbar-user">
                <span id="navBarPrenom">👤 <?= htmlspecialchars($_SESSION['utilisateur']->uti_prenom) ?></span>
                <ul class="dropdown">
                    <li><a href="profil" id="navBarProfil">💎 Mon profil</a></li>
                    <li><a href="deconnexion" id="navBarLogout">🚪 Déconnexion</a></li>
                </ul>
            </li>
        <?php else : ?>
            <li><a href="inscription" id="navBarInscription">📝 S'inscrire</a></li>
            <li><a href="connexion" class="btn-creer" id="navBarConnexion">🔑 Se connecter</a></li>
        <?php endif; ?>
    </div>
</ul>