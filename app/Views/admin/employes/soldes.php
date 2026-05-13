<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="data-card">
  <div class="data-card-head">
    <h3><i class="bi bi-wallet2"></i> Soldes de congés (Année <?= $annee ?>)</h3>
    <a href="/admin/employes" class="btn-secondary"><i class="bi bi-arrow-left"></i> Retour</a>
  </div>
  
  <div class="form-section">
      <form action="/admin/employes/<?= $employe['id'] ?>/soldes/update" method="post">
        
        <table class="tbl">
            <thead>
                <tr>
                    <th>Type de congé</th>
                    <th>Jours Annuels (Par défaut)</th>
                    <th>Jours Attribués (Personnalisé)</th>
                    <th>Jours Pris</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typesConge as $type): ?>
                    <?php 
                        $typeId = $type['id'];
                        // Valeur par défaut si aucun solde n'existe
                        $joursAttribues = isset($soldes[$typeId]) ? $soldes[$typeId]['jours_attribues'] : $type['jours_annuels'];
                        $joursPris = isset($soldes[$typeId]) ? $soldes[$typeId]['jours_pris'] : 0;
                    ?>
                    <tr>
                        <td class="td-name"><?= esc($type['libelle']) ?></td>
                        <td class="td-muted"><?= esc($type['jours_annuels']) ?> jours</td>
                        <td>
                            <input type="number" name="soldes[<?= $typeId ?>]" value="<?= esc($joursAttribues) ?>" class="f-input" style="width:100px;">
                        </td>
                        <td class="td-muted"><?= esc($joursPris) ?> jours</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="form-actions" style="margin-top: 20px;">
            <button class="btn-forest" type="submit">Enregistrer les soldes</button>
        </div>
      </form>
  </div>
</div>

<?= $this->endSection() ?>