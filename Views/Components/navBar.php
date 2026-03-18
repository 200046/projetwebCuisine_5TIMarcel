<ul class="navbar">
    <li class="navbar-brand"><a href="/">🍳 Marmiton-TTI</a></li>

    <div class="navbar-links">
        <?php if (isset($_SESSION['utilisateur'])) : ?>
            <li><a href="mesRecettes">Mes recettes</a></li>
            <li><a href="creerRecette" class="btn-creer">+ Créer une recette</a></li>

            <?php if ($_SESSION['utilisateur']->role === 'admin'): ?>
                <li><a href="administration">⚙️ Admin</a></li>
            <?php elseif ($_SESSION['utilisateur']->role === 'moderateur'): ?>
                <li><a href="moderation">🛡️ Modération</a></li>
            <?php endif; ?>

            <li class="navbar-user">
                👤 <?= htmlspecialchars($_SESSION['utilisateur']->prenomUser) ?>
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

<style>
    .navbar {
    list-style: none;
    padding: 0 30px;
    margin: 0;
    display: flex;
    align-items: center;
    background-color: #fff;
    border-bottom: 2px solid #f0a500;
    height: 60px;
}

.navbar a {
    text-decoration: none;
    color: #333;
}

.navbar-brand a {
    font-size: 20px;
    font-weight: bold;
    color: #f0a500;
}

.navbar-links {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-left: auto;
    list-style: none;
}

.navbar-links li {
    list-style: none;
}

.navbar-links a:hover {
    color: #f0a500;
}

.btn-creer {
    background-color: #f0a500;
    color: white !important;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 14px;
    transition: background-color 0.2s;
}

.btn-creer:hover {
    background-color: #d4920a !important;
    color: white;
}

/* Dropdown */
.navbar-user {
    position: relative;
    cursor: pointer;
    font-weight: bold;
    color: #333;
}

.dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 40px;
    background: white;
    border: 1px solid #f0a500;
    border-radius: 6px;
    list-style: none;
    padding: 8px 0;
    min-width: 150px;
    z-index: 100;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.dropdown li a {
    display: block;
    padding: 8px 16px;
    color: #333;
}

.dropdown li a:hover {
    background-color: #fff8f0;
    color: #f0a500;
}

.navbar-user:hover .dropdown {
    display: block;
}
</style>