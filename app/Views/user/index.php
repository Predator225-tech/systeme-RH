<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-wallet2"></i> Mes Soldes & Demandes</h2>
    <a href="/user/demander" class="btn-forest"><i class="bi bi-plus-circle"></i> Poser un congé</a>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card-custom">
            <h4>Mes Soldes (<?= date('Y') ?>)</h4>
            <?php if (empty($soldes)): ?>
                <p class="text-muted">Aucun solde défini pour le moment.</p>
            <?php else: ?>
                <ul class="list-group list-group-flush mt-3">
                    <?php foreach ($soldes as $s): ?>
                        <?php 
                            $libelle = "Inconnu";
                            foreach($typesConge as $t) { if($t['id'] == $s['type_conge_id']) $libelle = $t['libelle']; }
                            $restant = $s['jours_attribues'] - $s['jours_pris'];
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= esc($libelle) ?>
                            <span class="badge bg-success rounded-pill"><?= $restant ?> jours restants</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card-custom">
            <h4>Historique des demandes</h4>
            <?php if (empty($historique)): ?>
                <p class="text-muted">Aucune demande.</p>
            <?php else: ?>
                <table class="table table-custom mt-3">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Période</th>
                            <th>Jours</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($historique as $h): ?>
                        <tr>
                            <td><?= esc($h['type_conge']) ?></td>
                            <td><?= date('d/m/Y', strtotime($h['date_debut'])) ?> au <?= date('d/m/Y', strtotime($h['date_fin'])) ?></td>
                            <td><?= esc($h['nb_jours']) ?></td>
                            <td>
                                <span class="statut-<?= esc($h['statut']) ?>">
                                    <?= ucfirst(str_replace('_', ' ', esc($h['statut']))) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>