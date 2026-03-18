<footer class="footer">
    <div class="footer-container">

        <div class="footer-left">
            <h3>🍳 Marmiton-TTI</h3>
            <p>Découvrez et partagez les meilleures recettes faites maison.</p>
            <div class="footer-links">
                <a href="/">Accueil</a>
                <a href="/inscription">S'inscrire</a>
                <a href="/connexion">Se connecter</a>
            </div>
        </div>

        <div class="footer-center">
            <p class="footer-title">Suivez-nous</p>
            <div class="socials">
                <a href="#"><img class="imageIcon" src="../../Assets/Images/icon1.jpg" alt="twitter"></a>
                <a href="#"><img class="imageIcon" src="../../Assets/Images/icon2.jpg" alt="facebook"></a>
                <a href="#"><img class="imageIcon" src="../../Assets/Images/icon3.jpg" alt="google"></a>
            </div>
        </div>

        <div class="footer-right">
            <p class="footer-title">Le site</p>
            <!-- count() compte le nombre d'éléments dans le tableau retourné par selectAllRecettes() -->
            <p>🍽️ <?= count(selectAllRecettes($pdo)) ?> recettes disponibles</p>
            <!-- date("Y") retourne l'année actuelle en 4 chiffres, ex: 2025 -->
            <p>© <?= date("Y") ?> Marmiton-TTI</p>
        </div>

    </div>
</footer>

<style>
    .footer {
        background-color: #1a1a1a;
        color: #ccc;
        margin-top: 60px;
        padding: 40px 0 20px 0;
    }

    .footer-container {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 40px;
        padding: 0 30px;
        flex-wrap: wrap;
    }

    .footer h3 {
        color: #f0a500;
        margin: 0 0 10px 0;
        font-size: 20px;
    }

    .footer p {
        font-size: 14px;
        margin: 5px 0;
    }

    .footer-title {
        color: #f0a500;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .footer-links {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-top: 10px;
    }

    .footer-links a {
        color: #ccc;
        text-decoration: none;
        font-size: 14px;
    }

    .footer-links a:hover {
        color: #f0a500;
    }

    .socials {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }

    .imageIcon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        transition: transform 0.2s;
    }

    .imageIcon:hover {
        transform: scale(1.15);
    }
</style>