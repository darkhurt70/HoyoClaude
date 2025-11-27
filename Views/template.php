<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>
    <header>
        <nav class="blue darken-2">
            <div class="nav-wrapper container">
                <a href="index.php" class="brand-logo">Mihoyo Collection</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=add-perso">Ajouter Personnage</a></li>
                    <li><a href="index.php?action=add-element">Ajouter Élément</a></li>
                    <li><a href="index.php?action=logs">Logs</a></li>
                    <li><a href="index.php?action=protected">Zone Protégée</a></li>
                    <?php
                    session_start();
                    if (isset($_SESSION['userUID'])): ?>
                        <li><a href="index.php?action=logout">Déconnexion (<?= $_SESSION['username'] ?>)</a></li>
                    <?php else: ?>
                        <li><a href="index.php?action=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main id="contenu" class="container">
        <?= $this->section('content') ?>
    </main>

    <footer class="page-footer blue darken-2">
        <div class="container">
            <p class="grey-text text-lighten-4">© 2025 Mihoyo Collection - Projet TP</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
