<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
  <h2 style="margin: 0; font-size: 1.3rem; font-weight: 600;">Liste des Départements</h2>
  <a href="/admin/departements/create" class="btn-forest">
    <i class="bi bi-plus-lg"></i> Nouveau Département
  </a>
</div>

<?php if (!empty($departements)): ?>
  <div class="data-card">
    <table class="tbl">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($departements as $dept): ?>
          <tr>
            <td class="td-name"><?= esc($dept['nom']) ?></td>
            <td class="td-muted"><?= esc(substr($dept['description'] ?? '', 0, 50)) ?><?= strlen($dept['description'] ?? '') > 50 ? '...' : '' ?></td>
            <td>
              <div class="action-btns">
                <a href="/admin/departements/edit/<?= esc($dept['id']) ?>" class="btn-sm btn-edit">
                  <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="/admin/departements/delete/<?= esc($dept['id']) ?>" class="btn-sm btn-del" onclick="return confirm('Êtes-vous sûr?')">
                  <i class="bi bi-trash"></i> Supprimer
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <div class="data-card">
    <div class="empty">
      <i class="bi bi-inbox"></i>
      <p>Aucun département trouvé. <a href="/admin/departements/create" style="color: var(--forest); text-decoration: none; font-weight: 500;">Créer un département</a></p>
    </div>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
