<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="metrics">
  <div class="metric">
    <div class="metric-top">
      <div class="metric-icon mi-blue">
        <i class="bi bi-people-fill"></i>
      </div>
    </div>
    <div class="metric-val"><?= esc($totalEmployes) ?></div>
    <div class="metric-label">Total Employés</div>
  </div>

  <div class="metric">
    <div class="metric-top">
      <div class="metric-icon mi-forest">
        <i class="bi bi-diagram-3"></i>
      </div>
    </div>
    <div class="metric-val"><?= esc($totalDepartements) ?></div>
    <div class="metric-label">Départements</div>
  </div>

  <div class="metric">
    <div class="metric-top">
      <div class="metric-icon mi-green">
        <i class="bi bi-check-circle-fill"></i>
      </div>
    </div>
    <div class="metric-val"><?= esc($employesActifs) ?></div>
    <div class="metric-label">Employés Actifs</div>
  </div>
</div>

<div class="data-card">
  <div class="data-card-head">
    <h3><i class="bi bi-speedometer2"></i> Accès rapide</h3>
  </div>
  <div style="padding: 2rem; text-align: center;">
    <p style="color: var(--muted); margin-bottom: 1.5rem;">Bienvenue dans l'espace d'administration. Utilisez le menu latéral pour naviguer.</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
      <a href="/admin/employes" class="btn-forest">
        <i class="bi bi-plus-lg"></i> Gérer les Employés
      </a>
      <a href="/admin/departements" class="btn-secondary">
        <i class="bi bi-plus-lg"></i> Gérer les Départements
      </a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
