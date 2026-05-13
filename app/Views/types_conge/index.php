<h1>Types de congé</h1>
<p><a href="/types_conge/create">Ajouter un type</a></p>
<table>
    <thead>
        <tr><th>ID</th><th>Libellé</th><th>Jours annuels</th><th>Déductible</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($types as $t): ?>
        <tr>
            <td><?= esc($t['id']) ?></td>
            <td><?= esc($t['libelle']) ?></td>
            <td><?= esc($t['jours_annuels']) ?></td>
            <td><?= $t['deductible'] ? 'Oui' : 'Non' ?></td>
            <td>
                <a href="/types_conge/edit/<?= $t['id'] ?>">Modifier</a>
                <a href="/types_conge/delete/<?= $t['id'] ?>" onclick="return confirm('Supprimer?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
