<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?> — TechMada RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f8f6f1; font-family: 'DM Sans', sans-serif; }
        .navbar { background: #2d5a3d; color: white; }
        .navbar a { color: white; text-decoration: none; }
        .content { padding: 2rem; max-width: 1000px; margin: auto; }
        .card-custom { background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;}
        .table-custom th { background: #f8f6f1; color: #7a8f80; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;}
        .statut-attente { color: #b8750a; background: #fef9ee; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; }
        .statut-approuvee { color: #1e6b3f; background: #edf7f2; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; }
        .statut-refusee { color: #c0392b; background: #fdf0ee; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; }
        .btn-forest { background: #2d5a3d; color: white; border: none; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .btn-forest:hover { background: #3d7a52; color:white; }
        .btn-danger-custom { background: #c0392b; color: white; border: none; padding: 8px 16px; border-radius: 8px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" style="font-family:'Playfair Display',serif" href="/user">TechMada RH - <?php if(session()->get('role') === 'rh') echo 'Espace RH'; else echo 'Espace Employé'; ?></a>
            <div class="d-flex">
                <span class="me-3 mt-2"><?= session()->get('prenom') ?> <?= session()->get('nom') ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm mt-1">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="content">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>