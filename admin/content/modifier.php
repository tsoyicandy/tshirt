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

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ../index.php');
    exit;
}

$tshirt = $dao->findById((int)$id);
if (!$tshirt) {
    header('Location: ../index.php');
    exit;
}

$uploadDir = '../../client/assets/static/images/';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tshirt->__set('nom', $_POST['nom']);
    $tshirt->__set('description', $_POST['description']);
    $tshirt->__set('prix', (float)$_POST['prix']);
    $tshirt->__set('id_categorie', (int)$_POST['id_categorie']);

    // gestion de l’image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $destination = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $destination)) {
            $imagePath = '/static/images/' . $fileName;
            $tshirt->__set('image', $imagePath);
        } else {
            $error = "Erreur lors du téléchargement de l'image.";
        }
    }

    if (!$error) {
        $dao->update($tshirt);
        header('Location: ../index.php');
        exit;
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Modifier un T-shirt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Modifier le T-shirt #<?= $tshirt->__get('id_tshirt') ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($tshirt->__get('nom')) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($tshirt->__get('description')) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number" name="prix" step="0.01" class="form-control" value="<?= $tshirt->__get('prix') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image actuelle</label><br>
            <img src="../../client/assets<?= $tshirt->__get('image') ?>" alt="" style="max-height:100px;">
        </div>
        <div class="mb-3">
            <label class="form-label">Changer l’image (optionnel)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">ID Catégorie</label>
            <input type="number" name="id_categorie" class="form-control" value="<?= $tshirt->__get('id_categorie') ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="../index.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>

