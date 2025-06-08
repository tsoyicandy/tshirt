<?php
include 'content/header.php';
$isLoggedIn = isset($_SESSION['id_client']);

?>

<head>
    <meta charset="UTF-8">
    <title>Accueil - T-Shirts</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body {
            background: url('client/assets/static/images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: sans-serif;
            color: white;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 20px;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        .btn {
            background: #ffffff;
            color: #000;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            margin: 10px;
            display: inline-block;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #cccccc;
        }
    </style>
</head>
<body>
<div class="overlay">
    <h1>Bienvenue dans notre boutique de T-Shirts</h1>
    <a href="client/content/tshirts.php" class="btn">Voir les T-Shirts</a>
    <?php if ($isLoggedIn): ?>
        <a href="client/content/logout.php" class="btn">Se déconnecter</a>
    <?php else: ?>
        <a href="client/content/login.php" class="btn">Se connecter</a>
    <?php endif; ?>
</div>
</body>
<?php include 'client/src/php/utils/footer.php'; ?>
