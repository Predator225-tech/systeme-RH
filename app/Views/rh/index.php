<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="card-custom">
    <h3><i class="bi bi-inbox"></i> Demandes en attente</h3>
    
    <?php if (empty($demandes)): ?>
        <p class="text-muted mt-3">Aucune demande en attente.</p>
    <?php else: ?>
        <table class="table table-custom mt-3">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Type</th>
                    <th>Période</th>
                    <th>Jours</th>
                    <th>Motif</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($demandes as $d): ?>
                <tr>
                    <td><strong><?= esc($d['prenom']) ?> <?= esc($d['nom']) ?></strong></td>
                    <td><?= esc($d['type_conge']) ?></td>
                    <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?> au <?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                    <td><?= esc($d['nb_jours']) ?></td>
                    <td><?= esc($d['motif']) ?></td>
                    <td class="text-end">
                        <form action="/rh/traiter/<?= $d['id'] ?>" method="post" class="d-inline">
                            <button type="submit" name="action" value="approuver" class="btn btn-sm btn-success" title="Approuver"><i class="bi bi-check-lg"></i></button>
                            <button type="submit" name="action" value="refuser" class="btn btn-sm btn-danger" title="Refuser" onclick="return confirm('Refuser cette demande ?')"><i class="bi bi-x-lg"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>