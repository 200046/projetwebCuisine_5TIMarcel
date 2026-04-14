<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO PRINCIPAL -->
    <title><?= $title ?> | Marmiton-TTI</title>
    <meta name="description" content="Découvrez et partagez des recettes faciles et gourmandes sur Marmiton-TTI. Cuisine simple, rapide et délicieuse pour tous.">
    <!-- TWITTER CARD -->
    <meta name="twitter:title" content="<?= $title ?> | Marmiton-TTI">
    <meta name="twitter:description" content="Découvrez des recettes simples et délicieuses.">
    <meta name="twitter:image" content="../Assets/Images/logo.png">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../Assets/Images/logo.png" type="image/x-icon">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/Css/base.css">
</head>

<body>
    <header>
        <?php require_once("Views/Components/navBar.php") ?>
    </header>

    <main>
        <?php require_once("$template"); ?>
    </main>

    <footer>
        <?php require_once("Views/Components/footer.php") ?>
    </footer>

    <!-- SCRIPTS -->
    <script src="../Assets/Scripts/script.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>