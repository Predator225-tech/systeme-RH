<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="data-card">
    <div class="data-card-head">
        <h3><i class="bi bi-list-check"></i> Types de congé</h3>
        <a href="/admin/types_conge/create" class="btn-forest"><i class="bi bi-plus-lg"></i> Ajouter</a>
    </div>
    <div style="padding:1rem">
        <?php if (empty($types)): ?>
            <div class="empty"><i class="bi bi-card-list"></i><p>Aucun type de congé trouvé.</p></div>
        <?php else: ?>
            <table class="tbl">
                <thead>
                    <tr><th>ID</th><th>Libellé</th><th>Jours annuels</th><th>Déductible</th><th>Actions</th></tr>
                </thead>
                <tbody>
                <?php foreach ($types as $t): ?>
                    <tr>
                        <td class="td-muted"><?= esc($t['id']) ?></td>
                        <td class="td-name"><?= esc($t['libelle']) ?></td>
                        <td><?= esc($t['jours_annuels']) ?></td>
                        <td><?= $t['deductible'] ? 'Oui' : 'Non' ?></td>
                        <td class="action-btns">
                            <a href="/admin/types_conge/edit/<?= $t['id'] ?>" class="btn-sm btn-edit">Modifier</a>
                            <a href="/admin/types_conge/delete/<?= $t['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Supprimer?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
