<?php
session_start();
$isLoggedIn = isset($_SESSION['id_client']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique T-Shirts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../client/assets/css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #222;
            color: #fff;
            padding: 15px 20px;
        }
        nav {
            margin-top: 10px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Boutique T-Shirts</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="client/content/tshirts.php">T-Shirts</a>
        <?php if ($isLoggedIn): ?>
            <a href="client/content/panier.php">Mon panier</a>
            <a href="client/content/logout.php">Déconnexion</a>
            <a href="client/content/mesCommandes.php">Mes Commandes</a>
        <?php else: ?>
            <a href="client/content/login.php">Connexion</a>
        <?php endif; ?>
    </nav>
    <hr>
</header>
<main>
