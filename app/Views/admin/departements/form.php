<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 1.75rem;">
  <a href="/admin/departements" style="color: var(--forest); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;">
    <i class="bi bi-arrow-left"></i> Retour
  </a>
</div>

<div class="form-section">
  <h3><?= esc($departement ? 'Modifier le Département' : 'Créer un Département') ?></h3>

  <form method="POST" action="<?= esc($departement ? '/admin/departements/update/' . $departement['id'] : '/admin/departements/store') ?>">
    <?= csrf_field() ?>

    <?php if (session()->has('errors')): ?>
      <div class="flash flash-error" style="margin-bottom: 1rem;">
        <i class="bi bi-exclamation-circle-fill"></i>
        <div>
          <strong>Erreurs de validation :</strong>
          <ul style="margin: 0.5rem 0 0; padding-left: 1.5rem;">
            <?php foreach (session('errors') as $error): ?>
              <li><?= esc($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>

    <div class="form-grid-2">
      <div class="f-group" style="grid-column: 1 / -1;">
        <label class="f-label">Nom <span style="color: var(--danger);">*</span></label>
        <input type="text" name="nom" class="f-input" value="<?= esc(old('nom', $departement['nom'] ?? '')) ?>" required/>
        <div class="f-hint">Ex: Ressources Humaines, Développement, etc.</div>
      </div>
    </div>

    <div class="f-group">
      <label class="f-label">Description</label>
      <textarea name="description" class="f-textarea" placeholder="Description du département..."><?= esc(old('description', $departement['description'] ?? '')) ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn-forest">
        <i class="bi bi-check-lg"></i> <?= $departement ? 'Mettre à jour' : 'Créer' ?>
      </button>
      <a href="/admin/departements" class="btn-secondary">
        <i class="bi bi-x-lg"></i> Annuler
      </a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
