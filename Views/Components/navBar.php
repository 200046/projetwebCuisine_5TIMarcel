<!-- Barre de navigation (menu en haut) -->
<ul class="flexible space-evenly">
    <!-- Grand écran -->
    <li class="menu"><a href="index.php">Accueil</a></li>
    
    <?php if (isset($_SESSION['utilisateur'])) : ?>
        <li class="menu"><a href="mesRecettes">Mes recettes</a></li>
        <li class="menu"><a href="creerRecette">Créer une recette</a></li>
        <li class="menu"><a href="profil">Mon profil</a></li>

        <?php if ($_SESSION['utilisateur']->role === 'admin'): ?>
            <li class="menu"><a href="administration">Administration</a></li>
        <?php elseif ($_SESSION['utilisateur']->role === 'moderateur'): ?>
            <li class="menu"><a href="moderation">Modération</a></li>
        <?php endif; ?>

        <li class="menu"><a href="deconnexion">Déconnexion</a></li>
    <?php else : ?>
        <li class="menu"><a href="inscription">S'inscrire</a></li>
        <li class="menu"><a href="connexion">Se connecter</a></li>
    <?php endif; ?>
</ul>