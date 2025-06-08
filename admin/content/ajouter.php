<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../../client/src/php/db/db.php';
require_once '../../client/src/php/classes/TshirtDAO.php';
require_once '../../client/src/php/classes/Tshirt.php';

$pdo = getPDO();
$dao = new TshirtDAO($pdo);

$uploadDir = '../../client/assets/static/images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $destination = $uploadDir . $fileName;

        // Déplacement du fichier
        if (move_uploaded_file($fileTmp, $destination)) {
            $imagePath = '/static/images/' . $fileName;

            $tshirt = new Tshirt([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'prix' => (float)$_POST['prix'],
                'image' => $imagePath,
                'id_categorie' => (int)$_POST['id_categorie']
            ]);

            $dao->insert($tshirt);
            header('Location: ../index.php');
            exit;
        } else {
            $error = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $error = "Aucune image sélectionnée.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Ajouter un T-shirt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Ajouter un nouveau T-shirt</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number" name="prix" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image (fichier JPG, PNG...)</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ID Catégorie</label>
            <input type="number" name="id_categorie" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="../index.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>

