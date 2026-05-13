<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
  <h2 style="margin: 0; font-size: 1.3rem; font-weight: 600;">Liste des Employés</h2>
  <a href="/admin/employes/create" class="btn-forest">
    <i class="bi bi-plus-lg"></i> Nouvel Employé
  </a>
</div>

<?php if (!empty($employes)): ?>
  <div class="data-card">
    <table class="tbl">
      <thead>
        <tr>
          <th>Nom & Prénom</th>
          <th>Email</th>
          <th>Département</th>
          <th>Rôle</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($employes as $emp): 
          $departements_map = [];
          foreach ($departements as $dept) {
            $departements_map[$dept['id']] = $dept['nom'];
          }
          $dept_name = $departements_map[$emp['departement_id']] ?? 'N/A';
        ?>
          <tr>
            <td class="td-name"><?= esc($emp['prenom']) ?> <?= esc($emp['nom']) ?></td>
            <td class="td-muted"><?= esc($emp['email']) ?></td>
            <td><?= esc($dept_name) ?></td>
            <td>
              <span style="font-size: .75rem; font-weight: 500; padding: 3px 8px; border-radius: 4px; background: var(--info-bg); color: var(--info);">
                <?= ucfirst(esc($emp['role'])) ?>
              </span>
            </td>
            <td>
              <span class="statut" style="<?= $emp['actif'] ? 'background: var(--success-bg); color: var(--success);' : 'background: #f1efe8; color: #7a8f80;' ?>">
                <?= $emp['actif'] ? 'Actif' : 'Inactif' ?>
              </span>
            </td>
            <td>
              <div class="action-btns">
                <a href="/admin/employes/edit/<?= esc($emp['id']) ?>" class="btn-sm btn-edit">
                  <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="/admin/employes/delete/<?= esc($emp['id']) ?>" class="btn-sm btn-del" onclick="return confirm('Êtes-vous sûr?')">
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
      <p>Aucun employé trouvé. <a href="/admin/employes/create" style="color: var(--forest); text-decoration: none; font-weight: 500;">Créer un employé</a></p>
    </div>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
