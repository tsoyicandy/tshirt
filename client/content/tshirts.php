<?php
include '../src/php/utils/header.php';
$isLoggedIn = isset($_SESSION['id_client']);

?>

<head>
    <meta charset="UTF-8">
    <title>Catalogue T-Shirts</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>const isLoggedIn = <?= isset($_SESSION['id_client']) ? 'true' : 'false' ?>;</script>
    <script src="../assets/js/tshirts.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .tshirt { border: 1px solid #ccc; padding: 10px; margin: 10px; width: 250px; display: inline-block; vertical-align: top; }
        .image { height: 200px; background-size: cover; background-position: center; }
        .disabled { opacity: 0.5; pointer-events: none; }
    </style>
</head>
<body>
    <h1>Nos T-Shirts</h1>
    <div class="container mt-4">
        <div id="filters" class="mb-3"></div>
        <div class="row" id="catalogue"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal fade" id="tshirtModal" tabindex="-1" aria-labelledby="tshirtModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tshirtModalLabel">Détail du T-shirt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body" id="tshirtModalBody">
                    Chargement...
                </div>
            </div>
        </div>
    </div>

</body>
<?php include '../src/php/utils/footer.php'; ?>
