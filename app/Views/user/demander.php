<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="card-custom mx-auto" style="max-width: 600px;">
    <h3 class="mb-4">Poser un congé</h3>
    
    <form action="/user/store" method="post">
        <div class="mb-3">
            <label class="form-label">Type de congé</label>
            <select name="type_conge_id" class="form-select" required>
                <?php foreach ($typesConge as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= esc($t['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Date de début</label>
                <input type="date" name="date_debut" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date de fin</label>
                <input type="date" name="date_fin" class="form-control" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Motif (Optionnel)</label>
            <textarea name="motif" class="form-control" rows="3"></textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="/user" class="btn btn-outline-secondary">Annuler</a>
            <button type="submit" class="btn-forest">Envoyer la demande</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>