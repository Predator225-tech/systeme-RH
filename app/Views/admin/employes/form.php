<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 1.75rem;">
  <a href="/admin/employes" style="color: var(--forest); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;">
    <i class="bi bi-arrow-left"></i> Retour
  </a>
</div>

<div class="form-section">
  <h3><?= esc($employe ? 'Modifier l\'Employé' : 'Créer un Employé') ?></h3>

  <form method="POST" action="<?= esc($employe ? '/admin/employes/update/' . $employe['id'] : '/admin/employes/store') ?>">
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
      <div class="f-group">
        <label class="f-label">Prénom <span style="color: var(--danger);">*</span></label>
        <input type="text" name="prenom" class="f-input" value="<?= esc(old('prenom', $employe['prenom'] ?? '')) ?>" required/>
      </div>

      <div class="f-group">
        <label class="f-label">Nom <span style="color: var(--danger);">*</span></label>
        <input type="text" name="nom" class="f-input" value="<?= esc(old('nom', $employe['nom'] ?? '')) ?>" required/>
      </div>

      <div class="f-group">
        <label class="f-label">Email <span style="color: var(--danger);">*</span></label>
        <input type="email" name="email" class="f-input" value="<?= esc(old('email', $employe['email'] ?? '')) ?>" required/>
      </div>

      <div class="f-group">
        <label class="f-label">Mot de passe <?= !$employe ? '<span style="color: var(--danger);">*</span>' : '<span style="color: var(--muted);">(vide pour ne pas modifier)</span>' ?></label>
        <input type="password" name="password" class="f-input" <?= !$employe ? 'required' : '' ?>/>
      </div>

      <div class="f-group">
        <label class="f-label">Département <span style="color: var(--danger);">*</span></label>
        <select name="departement_id" class="f-select" required>
          <option value="">Sélectionner un département</option>
          <?php foreach ($departements as $dept): ?>
            <option value="<?= esc($dept['id']) ?>" <?= (old('departement_id', $employe['departement_id'] ?? '') == $dept['id']) ? 'selected' : '' ?>>
              <?= esc($dept['nom']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="f-group">
        <label class="f-label">Rôle <span style="color: var(--danger);">*</span></label>
        <select name="role" class="f-select" required>
          <option value="employe" <?= (old('role', $employe['role'] ?? 'employe') === 'employe') ? 'selected' : '' ?>>Employé</option>
          <option value="rh" <?= (old('role', $employe['role'] ?? '') === 'rh') ? 'selected' : '' ?>>RH</option>
          <option value="admin" <?= (old('role', $employe['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
        </select>
      </div>

      <div class="f-group">
        <label class="f-label">Date d'embauche <span style="color: var(--danger);">*</span></label>
        <input type="date" name="date_embauche" class="f-input" value="<?= esc(old('date_embauche', $employe['date_embauche'] ?? '')) ?>" required/>
      </div>

      <div class="f-group">
        <label class="f-label">Statut</label>
        <select name="actif" class="f-select">
          <option value="1" <?= (old('actif', $employe['actif'] ?? 1) == 1) ? 'selected' : '' ?>>Actif</option>
          <option value="0" <?= (old('actif', $employe['actif'] ?? 1) == 0) ? 'selected' : '' ?>>Inactif</option>
        </select>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn-forest">
        <i class="bi bi-check-lg"></i> <?= $employe ? 'Mettre à jour' : 'Créer' ?>
      </button>
      <a href="/admin/employes" class="btn-secondary">
        <i class="bi bi-x-lg"></i> Annuler
      </a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
