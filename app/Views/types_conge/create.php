<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="form-section">
    <h3>Ajouter un type de congé</h3>
    <form method="post" action="/admin/types_conge/store">
        <div class="form-grid-2">
            <div class="f-group">
                <label class="f-label">Libellé</label>
                <input class="f-input" name="libelle" required>
            </div>
            <div class="f-group">
                <label class="f-label">Jours annuels</label>
                <input class="f-input" type="number" name="jours_annuels" value="0">
            </div>
        </div>

        <div class="f-group">
            <label class="f-label">Déductible</label>
            <select class="f-select" name="deductible">
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>

        <div class="form-actions">
            <button class="btn-forest" type="submit">Enregistrer</button>
            <a class="btn-secondary" href="/admin/types_conge">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
