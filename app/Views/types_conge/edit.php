<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="form-section">
    <h3>Modifier le type de congé</h3>
    <form method="post" action="/admin/types_conge/update/<?= $type['id'] ?>">
        <div class="form-grid-2">
            <div class="f-group">
                <label class="f-label">Libellé</label>
                <input class="f-input" name="libelle" required value="<?= esc($type['libelle']) ?>">
            </div>
            <div class="f-group">
                <label class="f-label">Jours annuels</label>
                <input class="f-input" type="number" name="jours_annuels" value="<?= esc($type['jours_annuels']) ?>">
            </div>
        </div>

        <div class="f-group">
            <label class="f-label">Déductible</label>
            <select class="f-select" name="deductible">
                <option value="1" <?= $type['deductible'] ? 'selected' : '' ?>>Oui</option>
                <option value="0" <?= !$type['deductible'] ? 'selected' : '' ?>>Non</option>
            </select>
        </div>

        <div class="form-actions">
            <button class="btn-forest" type="submit">Mettre à jour</button>
            <a class="btn-secondary" href="/admin/types_conge">Annuler</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
